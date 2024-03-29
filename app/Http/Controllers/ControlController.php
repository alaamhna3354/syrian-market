<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Configure;
use Illuminate\Http\Request;

use App\Http\Traits\Upload;
use Illuminate\Support\Facades\Artisan;
use Image;
use Session;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Validator;

class ControlController extends Controller
{
    use Upload;


    public function index()
    {
        $timeZone = timezone_identifiers_list();
        $control =   Configure::firstOrNew();
        $control->time_zone_all = $timeZone;
        return view('admin.pages.basic-controls', compact('control'));
    }

    public function basicControls()
    {
        $timeZone = timezone_identifiers_list();
        $control =   Configure::firstOrNew();
        $control->time_zone_all = $timeZone;
        return view('admin.pages.basicControls', compact('control'));
    }

    public function updateConfigure(Request $request)
    {
        $configure = Configure::firstOrNew();
        $reqData = Purify::clean($request->except('_token', '_method'));
        $request->validate([
            'site_title' => 'required',
            'time_zone' => 'required',
            'currency' => 'required',
            'currency_symbol' => 'required',
            'fraction_number' => 'required|integer',
            'paginate' => 'required|integer',
            'min_balance' => 'required|numeric'
        ]);

        config(['basic.site_title' => $reqData['site_title']]);
        config(['basic.time_zone' => trim($reqData['time_zone'])]);
        config(['basic.currency' => $reqData['currency']]);
        config(['basic.currency_symbol' => $reqData['currency_symbol']]);
        config(['basic.fraction_number' => (int)$reqData['fraction_number']]);
        config(['basic.paginate' => (int)$reqData['paginate']]);
        config(['basic.sms_notification' => (int)$reqData['sms_notification']]);
        config(['basic.email_notification' => (int)$reqData['email_notification']]);
        config(['basic.sms_verification' => (int)$reqData['sms_verification']]);
        config(['basic.email_verification' => (int)$reqData['email_verification']]);
        config(['basic.min_balance' => $reqData['min_balance']]);
        config(['basic.points_rate_per_kilo' => $reqData['points_rate_per_kilo']]);
        config(['basic.min_points_allowed_to_replace' => (int)$reqData['min_points_allowed_to_replace']]);
        config(['basic.marketer_joining_fee' => (int)$reqData['marketer_joining_fee']]);
        config(['basic.golden_marketer_joining_fee' => (int)$reqData['golden_marketer_joining_fee']]);
        config(['basic.marketer_joining_points' => (int)$reqData['marketer_joining_points']]);
        config(['basic.marketer_invitation_number_each_join' => (int)$reqData['marketer_invitation_number_each_join']]);
        config(['basic.auto_generate_invitation_code' => $reqData['auto_generate_invitation_code']]);
        config(['basic.golden_refund' => $reqData['golden_refund']]);
        config(['basic.marketers_swap' => $reqData['marketers_swap']]);


        $fp = fopen(base_path() . '/config/basic.php', 'w');
        fwrite($fp, '<?php return ' . var_export(config('basic'), true) . ';');
        fclose($fp);


        $configure->fill($reqData)->save();

        session()->flash('success',trans('Updated Successfully') );

        Artisan::call('optimize:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');

        return back();
    }
    public function updateBasicControls(Request $request)
    {

        $configure = Configure::firstOrNew();
        $reqData = Purify::clean($request->except('_token', '_method'));
        $request->validate([
            'site_title' => 'required',
            'time_zone' => 'required',
            'currency' => 'required',
            'currency_symbol' => 'required',
            'fraction_number' => 'required|integer',
            'paginate' => 'required|integer',
            'min_balance' => 'required|numeric'
        ]);


        config(['basic.site_title' => $reqData['site_title']]);
        config(['basic.time_zone' => trim($reqData['time_zone'])]);
        config(['basic.currency' => $reqData['currency']]);
        config(['basic.currency_symbol' => $reqData['currency_symbol']]);
        config(['basic.fraction_number' => (int)$reqData['fraction_number']]);
        config(['basic.paginate' => (int)$reqData['paginate']]);
        config(['basic.min_balance' => $reqData['min_balance']]);
        config(['basic.points_rate_per_kilo' => $reqData['points_rate_per_kilo']]);
        config(['basic.min_points_allowed_to_replace' => (int)$reqData['min_points_allowed_to_replace']]);
        config(['basic.marketer_joining_fee' => (int)$reqData['marketer_joining_fee']]);
        config(['basic.golden_marketer_joining_fee' => (int)$reqData['golden_marketer_joining_fee']]);
        config(['basic.marketer_joining_points' => (int)$reqData['marketer_joining_points']]);
        config(['basic.marketer_invitation_number_each_join' => (int)$reqData['marketer_invitation_number_each_join']]);
        config(['basic.auto_generate_invitation_code' => $reqData['auto_generate_invitation_code']]);
        config(['basic.golden_refund' => $reqData['golden_refund']]);
        config(['basic.marketers_swap' => $reqData['marketers_swap']]);
        $fp = fopen(base_path() . '/config/basic.php', 'w');
        fwrite($fp, '<?php return ' . var_export(config('basic'), true) . ';');
        fclose($fp);


        $configure->fill($reqData)->save();

        session()->flash('success',trans('Updated Successfully'));

        Artisan::call('optimize:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');

        return back();
    }


    public function colorSettings()
    {
        $configure = Color::firstOrNew();
        $control = $configure;
        return view('admin.pages.colors', compact('control'));
    }


    public function colorSettingsUpdate(Request $request)
    {
        $configure = Color::firstOrNew();
        $reqData = Purify::clean($request->except('_token', '_method'));
        $request->validate([
            'primaryColor' => 'required',
            'subheading' => 'required',
            'bggrdleft' => 'required',
            'bggrdright' => 'required',
            'btngrdleft' => 'required',
            'bggrdleft2' => 'required',
            'copyrights' => 'required',
        ], [
            'primaryColor.required' => 'Primary color required',
            'subheading.required' => 'Subheading color required',
            'bggrdleft.required' => 'Background left color required',
            'bggrdright.required' => 'Background right color required',
            'btngrdleft.required' => 'Button gradient left color required',
            'bggrdleft2.required' => 'Background left 2 color required',
            'copyrights.required' => 'Copyrights Background color required',
        ]);


        config(['color.primaryColor' => str_replace('#','',$reqData['primaryColor']) ]);
        config(['color.subheading' => str_replace('#','',$reqData['subheading']) ]);
        config(['color.bggrdleft' => str_replace('#','',$reqData['bggrdleft']) ]);
        config(['color.bggrdright' =>str_replace('#','',$reqData['bggrdright']) ]);
        config(['color.bggrdleft2' => str_replace('#','',$reqData['bggrdleft2']) ]);
        config(['color.btngrdleft' =>str_replace('#','',$reqData['btngrdleft']) ]);
        config(['color.copyrights' =>str_replace('#','',$reqData['copyrights']) ]);


        $fp = fopen(base_path() . '/config/color.php', 'w');
        fwrite($fp, '<?php return ' . var_export(config('color'), true) . ';');
        fclose($fp);


        $configure->fill($reqData)->save();

        session()->flash('success', trans('Updated Successfully'));

        Artisan::call('optimize:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');

        return back();
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


    public function logoSeo()
    {
        $seo = (object)config('seo');
        return view('admin.pages.logo', compact('seo'));
    }

    public function logoUpdate(Request $request)
    {
        if ($request->hasFile('image')) {
            try {
                $old = 'logo.png';
                $this->uploadImage($request->image, config('location.logo.path'), null, $old, null, $old);
            } catch (\Exception $exp) {
                return back()->with('error',trans('Logo could not be uploaded.') );
            }
        }
        if ($request->hasFile('footer_image')) {
            try {
                $old = 'footer-logo.png';
                $this->uploadImage($request->footer_image, config('location.logo.path'), null, $old, null, $old);
            } catch (\Exception $exp) {
                return back()->with('error', trans('Footer logo could not be uploaded.'));
            }
        }

        if ($request->hasFile('favicon')) {
            try {
                $old = 'favicon.png';
                $this->uploadImage($request->favicon, config('location.logo.path'), null, $old, null, $old);
            } catch (\Exception $exp) {
                return back()->with('error', trans('favicon could not be uploaded.'));
            }
        }
        return back()->with('success', trans('Logo has been updated.'));
    }


    public function breadcrumb()
    {
        return view('admin.pages.banner');
    }

    public function breadcrumbUpdate(Request $request)
    {
        if ($request->hasFile('banner')) {
            try {
                $old = 'banner.jpg';
                $this->uploadImage($request->banner, config('location.logo.path'), null, $old, null, $old);
            } catch (\Exception $exp) {
                return back()->with('error',trans('Banner could not be uploaded.') );
            }
        }
        return back()->with('success', trans('Banner has been updated.'));
    }


    public function seoUpdate(Request $request)
    {

        $reqData = Purify::clean($request->except('_token', '_method'));
        $request->validate([
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'social_title' => 'required',
            'social_description' => 'required'
        ]);


        config(['seo.meta_keywords' => $reqData['meta_keywords']]);
        config(['seo.meta_description' => $request['meta_description']]);
        config(['seo.social_title' => $reqData['social_title']]);
        config(['seo.social_description' => $reqData['social_description']]);


        if ($request->hasFile('meta_image')) {
            try {
                $old = config('seo.meta_image');
                $meta_image = $this->uploadImage($request->meta_image, config('location.logo.path'), null, $old, null, $old);
                config(['seo.meta_image' => $meta_image]);
            } catch (\Exception $exp) {
                return back()->with('error', trans('favicon could not be uploaded.'));
            }
        }

        $fp = fopen(base_path() . '/config/seo.php', 'w');
        fwrite($fp, '<?php return ' . var_export(config('seo'), true) . ';');
        fclose($fp);

        Artisan::call('optimize:clear');
        return back()->with('success', trans('Favicon has been updated.'));

    }
    public function setExchangerate(Request $request)
    {
        $configure = Configure::firstOrNew();
        $reqData = Purify::clean($request->except('_token', '_method'));
        $request->validate([
            'rate' => 'required',

        ]);
        config(['basic.exchange_rate' => $reqData['rate']]);
        $fp = fopen(base_path() . '/config/basic.php', 'w');
        fwrite($fp, '<?php return ' . var_export(config('basic'), true) . ';');
        fclose($fp);
        $configure->exchange_rate=$reqData['rate'];
        $configure->save();
        return back()->with('success',trans('Exchange Rate has been updated.') );
    }
}
