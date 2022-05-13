<?php

namespace App\Http\Controllers;


use App\Models\EmailTemplate;
use App\Models\Language;
use App\Models\SmsTemplate;
use Illuminate\Http\Request;
use Stevebauman\Purify\Facades\Purify;

class SmsTemplateController extends Controller
{
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
     * @param  \App\SmsTemplate  $smsTemplate
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
