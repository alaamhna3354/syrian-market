<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use App\Models\Language;
use App\Models\SmsControl;
use Validator;
use App\Models\SmsTemplate;
use Illuminate\Http\Request;
use Stevebauman\Purify\Facades\Purify;

class SmsControlController extends Controller
{
    public function smsConfig(Request $request)
    {

        if ($request->isMethod('GET')) {
            $smsControl = SmsControl::firstOrCreate(['id' => 1]);
            return view('admin.pages.smscontrols.index', compact('smsControl'));
        } elseif ($request->isMethod('POST')) {

            $purifiedData = Purify::clean($request->all());

            $validator = Validator::make($purifiedData, [
                'actionMethod' => 'required|min:3|max:4',
                'actionUrl' => 'required|url',
                'headerDataKeys.*' => 'nullable|string|min:2|required_with:headerDataValues.*',
                'headerDataValues.*' => 'nullable|string|min:2|required_with:headerDataKeys.*',
                'paramKeys.*' => 'nullable|string|min:2|required_with:paramValues.*',
                'paramValues.*' => 'nullable|string|min:2|required_with:paramKeys.*',
                'formDataKeys.*' => 'nullable|string|min:2|required_with:formDataValues.*',
                'formDataValues.*' => 'nullable|string|min:2|required_with:formDataKeys.*',
            ], [
                'min' => 'Field value must be at least :min characters.',
                'string' => 'Field value must be :string.',
                'required_with' => 'Field value empty not allowed',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $purifiedData = (object)$purifiedData;

            $headerData = array_combine($purifiedData->headerDataKeys, $purifiedData->headerDataValues);
            $paramData = array_combine($purifiedData->paramKeys, $purifiedData->paramValues);
            $formData = array_combine($purifiedData->formDataKeys, $purifiedData->formDataValues);

            $headerData = (empty(array_filter($headerData))) ? null : json_encode(array_filter($headerData));
            $paramData = (empty(array_filter($paramData))) ? null : json_encode(array_filter($paramData));
            $formData = (empty(array_filter($formData))) ? null : json_encode(array_filter($formData));

            $actionMethod = $purifiedData->actionMethod;
            $actionUrl = $purifiedData->actionUrl;

            $smsControl = SmsControl::firstOrCreate(['id' => 1]);
            $smsControl->actionUrl = $actionUrl;
            $smsControl->actionMethod = $actionMethod;
            $smsControl->formData = $formData;
            $smsControl->paramData = $paramData;
            $smsControl->headerData = $headerData;
            $smsControl->save();

            return back()->with('success', 'SMS configuration Saved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(SmsTemplate $smsTemplate)
    {
        $smstemplate = SmsTemplate::groupBy('template_key')->distinct()->orderBy('template_key')->get();
        return view('admin.pages.smstemplate.show',compact('smstemplate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(SmsTemplate $smsTemplate,$id)
    {
        $smstemplate = SmsTemplate::findOrFail($id);
        $languages = Language::orderBy('short_name')->get();

        foreach ($languages as $lang){
            $checkTemplate =  EmailTemplate::where('template_key',$smstemplate->template_key)->where('language_id',$lang->id)->count();

            if($lang->short_name == 'en' && ($smstemplate->language_id == null)){
                $smstemplate->language_id = $lang->id;
                $smstemplate->lang_code = $lang->short_name;
                $smstemplate->save();
            }

            if(0 == $checkTemplate){
                $template = new  EmailTemplate();
                $template->language_id = $lang->id;
                $template->template_key = $smstemplate->template_key;
                $template->name = $smstemplate->name;
                $template->subject = $smstemplate->subject;
                $template->template = $smstemplate->template;
                $template->sms_body = $smstemplate->sms_body;
                $template->short_keys = $smstemplate->short_keys;
                $template->mail_status = $smstemplate->mail_status;
                $template->sms_status = $smstemplate->sms_status;
                $template->lang_code = $lang->short_name;
                $template->save();
            }
        }


        $smsTemplates = EmailTemplate::where('template_key',$smstemplate->template_key)->with('language')->get();

        return view('admin.pages.smstemplate.edit',compact('smstemplate','smsTemplates'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmsTemplate $smsTemplate,$id)
    {
        $req  = Purify::clean($request->all());
        $smstemplate = SmsTemplate::findOrFail($id);
        $smstemplate->sms_status = $req['sms_status'];
        $smstemplate->sms_body = $req['sms_body'];
        $smstemplate->save();
        return back()->with('success','Successfully Updated');
    }
}
