<?php

namespace App\Http\Controllers;

use App\Models\Configure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Stevebauman\Purify\Facades\Purify;
use App\Models\Language;
use App\Models\EmailTemplate;
use Validator;

class EmailTemplateController extends Controller
{
    /*
     * Email Control
     */
    public function emailControl(Request $request)
    {
        $control = Configure::firstOrNew();
        $email_description = $control->email_description;
        return view('admin.pages.email-controls', compact('control', 'email_description'));
    }

    public function emailConfigure(Request $request)
    {
        $request->validate([
            'email_method' => 'required',
            'sender_email' => 'required|email',
            'sender_email_name' => 'required',
            'email_description' => 'required',
            'smtp_host' => 'required_if:email_method,smtp',
            'smtp_port' => 'required_if:email_method,smtp',
            'smtp_username' => 'required_if:email_method,smtp',
            'smtp_password' => 'required_if:email_method,smtp'
        ]);

        $configure = Configure::firstOrNew();
        $reqData = Purify::clean($request->except('_token', '_method'));

        config(['basic.sender_email' => $reqData['sender_email']]);
        config(['basic.sender_email_name' => $reqData['sender_email_name']]);
        config([
            'basic.email_description' => json_encode($request['email_description'])
        ]);
        config(['basic.email_configuration.name' => $reqData['email_method']]);
        config(['basic.email_configuration.smtp_host' => $reqData['smtp_host']]);
        config(['basic.email_configuration.smtp_port' => $reqData['smtp_port']]);
        config(['basic.email_configuration.smtp_encryption' => $reqData['smtp_encryption']]);
        config(['basic.email_configuration.smtp_username' => $reqData['smtp_username']]);
        config(['basic.email_configuration.smtp_password' => $reqData['smtp_password']]);


        $configure->sender_email = $reqData['sender_email'];
        $configure->sender_email_name = $reqData['sender_email_name'];
        $configure->email_description = $request->email_description;
        $configure->email_configuration = [
            'name' => $reqData['email_method'],
            'smtp_host' => $reqData['smtp_host'],
            'smtp_port' => $reqData['smtp_port'],
            'smtp_encryption' => $reqData['smtp_encryption'],
            'smtp_username' => $reqData['smtp_username'],
            'smtp_password' => $reqData['smtp_password']
        ];
        $configure->save();
        $fp = fopen(base_path() . '/config/basic.php', 'w');
        fwrite($fp, '<?php return ' . var_export(config('basic'), true) . ';');
        fclose($fp);


        $envPath = base_path('.env');
        $env = file($envPath);
        $env = $this->set('MAIL_FROM_ADDRESS', '"' . config('basic.sender_email') . '"', $env);
        $env = $this->set('MAIL_FROM_NAME', '"' . config('basic.sender_email_name') . '"', $env);

        $env = $this->set('MAIL_MAILER', config('basic.email_configuration.name'), $env);

        if (config('basic.email_configuration.name') == 'smtp') {
            $env = $this->set('MAIL_HOST', '"' . config('basic.email_configuration.smtp_host') . '"', $env);
            $env = $this->set('MAIL_PORT', '"' . config('basic.email_configuration.smtp_port') . '"', $env);
            $env = $this->set('MAIL_USERNAME', '"' . config('basic.email_configuration.smtp_username') . '"', $env);
            $env = $this->set('MAIL_PASSWORD', '"' . config('basic.email_configuration.smtp_password') . '"', $env);
            $env = $this->set('MAIL_ENCRYPTION', '"' . config('basic.email_configuration.smtp_encryption') . '"', $env);
        }
        $fp = fopen($envPath, 'w');
        fwrite($fp, implode($env));
        fclose($fp);

        Artisan::call('config:clear');
        Artisan::call('view:clear');

        session()->flash('success', 'Email Configuration Has Been Updated');
        return back();
    }


    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function show(EmailTemplate $emailTemplate)
    {
        $emailTemplate = EmailTemplate::groupBy('template_key')->distinct()->orderBy('template_key')->get();
        return view('admin.pages.template.show', compact('emailTemplate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailTemplate $emailTemplate, $id)
    {
        $emailTemplate = EmailTemplate::findOrFail($id);
        $languages = Language::orderBy('short_name')->get();

        foreach ($languages as $lang) {
            $checkTemplate = EmailTemplate::where('template_key', $emailTemplate->template_key)->where('language_id', $lang->id)->count();

            if ($lang->short_name == 'en' && ($emailTemplate->language_id == null)) {
                $emailTemplate->language_id = $lang->id;
                $emailTemplate->lang_code = $lang->short_name;
                $emailTemplate->save();
            }
            if (0 == $checkTemplate) {
                $template = new  EmailTemplate();
                $template->language_id = $lang->id;
                $template->template_key = $emailTemplate->template_key;
                $template->email_from = $emailTemplate->email_from;
                $template->name = $emailTemplate->name;
                $template->subject = $emailTemplate->subject;
                $template->template = $emailTemplate->template;
                $template->sms_body = $emailTemplate->sms_body;
                $template->short_keys = $emailTemplate->short_keys;
                $template->mail_status = $emailTemplate->mail_status;
                $template->sms_status = $emailTemplate->sms_status;
                $template->lang_code = $lang->short_name;
                $template->save();
            }
        }

        $mailTemplates = EmailTemplate::where('template_key', $emailTemplate->template_key)->with('language')->get();
        return view('admin.pages.template.edit', compact('emailTemplate', 'languages', 'mailTemplates'));
    }

    /*
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailTemplate $emailTemplate, $id)
    {
        $templateData = Purify::clean($request->all());

        $rules = [
            'subject' => 'sometimes|required',
            'email_from' => 'sometimes|required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $emailtemplate = EmailTemplate::findOrFail($id);
        $emailtemplate->mail_status = $templateData['mail_status'];
        $emailtemplate->subject = $templateData['subject'];
        $emailtemplate->email_from = $templateData['email_from'];
        $emailtemplate->template = $templateData['template'];
        $emailtemplate->save();
        return back()->with('success', 'Update Successfully');
    }


    private function set($key, $value, $env)
    {
        foreach ($env as $env_key => $env_value) {
            $entry = explode("=", $env_value, 2);
            if ($entry[0] == $key) {
                $env[$env_key] = $key . "=" . $value . "\n";
            } else {
                $env[$env_key] = $env_value;
            }
        }
        return $env;
    }
}
