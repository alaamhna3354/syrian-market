<?php

namespace App\Http\Traits;

use App\Mail\SendMail;
use App\Models\Admin;
use App\Models\EmailTemplate;
use App\Models\NotifyTemplate;
use App\Models\SiteNotification;
use App\Models\SmsControl;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use  Facades\App\Services\BasicCurl;

trait Notify
{

    public function sendMailSms($user, $templateKey, $params = [], $subject = null, $requestMessage = null)
    {
        $this->mail($user, $templateKey, $params, $subject, $requestMessage);
        $this->sms($user, $templateKey, $params, $requestMessage = null);
    }

    public function mail($user, $templateKey = null, $params = [], $subject = null, $requestMessage = null)
    {
        $basic = (object) config('basic');

        if ($basic->email_notification != 1) {
            return false;
        }
        $email_body = json_decode($basic->email_description);
        $templateObj = EmailTemplate::where('template_key', $templateKey)->where('language_id', $user->language_id)->where('mail_status', 1)->first();
        if (!$templateObj) {
            $templateObj = EmailTemplate::where('template_key', $templateKey)->where('mail_status', 1)->first();
        }
        $message = str_replace("[[name]]", $user->username, $email_body);

        if(!$templateObj && $subject == null){
           return false;
        }else{

            if ($templateObj) {
                $message = str_replace("[[message]]", $templateObj->template, $message);
                if (empty($message)) {
                    $message = $email_body;
                }
                foreach ($params as $code => $value) {
                    $message = str_replace('[[' . $code . ']]', $value, $message);
                }
            } else {
                $message = str_replace("[[message]]", $requestMessage, $message);
            }

            $subject = ($subject == null) ? $templateObj->subject : $subject;
            $email_from = ($templateObj) ? $templateObj->email_from : $basic->sender_email;

            @Mail::to($user)->send(new SendMail($email_from, $subject, $message));
        }


    }


    public function sms($user, $templateKey, $params = [], $requestMessage = null)
    {
        $basic = (object) config('basic');
        if ($basic->sms_notification != 1) {
            return false;
        }

        $smsControl =SmsControl::firstOrCreate(['id' => 1]);

        $templateObj = EmailTemplate::where('template_key', $templateKey)->where('language_id', $user->language_id)->where('sms_status', 1)->first();
        if (!$templateObj) {
            $templateObj = EmailTemplate::where('template_key', $templateKey)->where('sms_status', 1)->first();
        }

        if(!$templateObj && $requestMessage == null){
            return false;
        }else{
            if ($templateObj) {
                $template = $templateObj->sms_body;
                foreach ($params as $code => $value) {
                    $template = str_replace('[[' . $code . ']]', $value, $template);
                }
            } else {
                $template = $requestMessage;
            }
        }



        $paramData = is_null($smsControl->paramData) ? [] : json_decode($smsControl->paramData, true);
        $paramData = http_build_query($paramData);
        $actionUrl = $smsControl->actionUrl;
        $actionMethod = $smsControl->actionMethod;
        $formData = is_null($smsControl->formData) ? [] : json_decode($smsControl->formData, true);

        $headerData = is_null($smsControl->headerData) ? [] : json_decode($smsControl->headerData, true);
        if ($actionMethod == 'GET') {
            $actionUrl = $actionUrl . '?' . $paramData;
        }

        $formData = recursive_array_replace("[[receiver]]", $user->mobile, recursive_array_replace("[[message]]", $template, $formData));

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $actionUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $actionMethod,
            CURLOPT_POSTFIELDS => http_build_query($formData),
            CURLOPT_HTTPHEADER => $headerData,
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;

    }


    public function userPushNotification($user, $templateKey, $params = [], $action = [])
    {
        $basic = (object) config('basic');
        if ($basic->push_notification != 1) {
            return false;
        }

        $templateObj = NotifyTemplate::where('template_key', $templateKey)->where('language_id', $user->language_id)->where('status', 1)->first();
        if (!$templateObj) {
            $templateObj = NotifyTemplate::where('template_key', $templateKey)->where('status', 1)->first();
        }


        if ($templateObj) {
            $template = $templateObj->body;
            foreach ($params as $code => $value) {
                $template = str_replace('[[' . $code . ']]', $value, $template);
            }
            $action['text'] = $template;
        }
        $siteNotification = new SiteNotification();
        $siteNotification->description = $action;
        $user->siteNotificational()->save($siteNotification);
        event(new \App\Events\UserNotification($siteNotification, $user->id));
    }


    public function adminPushNotification($templateKey, $params = [], $action = [])
    {

        $basic = (object) config('basic');
        if ($basic->push_notification != 1) {
            return false;
        }

        $templateObj = NotifyTemplate::where('template_key', $templateKey)->where('status', 1)->first();

        if(!$templateObj){
            return false;
        }

        if ($templateObj) {
            $template = $templateObj->body;
            foreach ($params as $code => $value) {
                $template = str_replace('[[' . $code . ']]', $value, $template);
            }
            $action['text'] = $template;
        }

        $admins = Admin::all();
        foreach ($admins as $admin){
            $siteNotification = new SiteNotification();
            $siteNotification->description = $action;
            $admin->siteNotificational()->save($siteNotification);


            event(new \App\Events\AdminNotification($siteNotification, $admin->id));
        }
    }




}
