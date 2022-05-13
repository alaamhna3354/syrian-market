<?php

namespace App\Http\Controllers\Auth;

use App\Http\Traits\Notify;
use App\Models\Template;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    use Notify;

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $info = json_decode(json_encode(getIpInfo()), true);

        $country_code  = null;
        if(!empty($info['code'])){
            $country_code = @$info['code'][0];
        }
        $countries = config('country');
        $templateSection = ['register'];
        $templates = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');
        return view(template().'auth.register',compact('country_code','countries','templates'));
    }

    public function sponsor($sponsor)
    {
        session()->put('sponsor', $sponsor);
        return view(template() . 'auth.register', compact('sponsor'));

    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $country_code = "AF,AL,DZ,AS,AD,AO,AI,AG,AR,AM,AW,AU,AZ,BH,BD,BB,BY,BE,BZ,BJ,BM,BT,BO,BA,BW,BR,IO,VG,BN,BG,BF,MM,BI,KH,CM,CA,CV,KY,CF,ID,CL,CN,CO,KM,CK,CR,CI,HR,CU,CY,CZ,CD,DK,DJ,DM,DO,EC,EG,SV,GQ,ER,EE,ET,FK,FO,FM,FJ,FI,FR,GF,PF,GA,GE,DE,GH,GI,GR,GL,GD,GP,GU,GT,GN,GW,GY,HT,HN,HK,HU,IS,IN,IR,IQ,IE,IL,IT,JM,JP,JO,KZ,KE,KI,XK,KW,KG,LA,LV,LB,LS,LR,LY,LI,LT,LU,MO,MK,MG,MW,MY,MV,ML,MT,MH,MQ,MR,MU,YT,MX,MD,MC,MN,ME,MS,MA,MZ,NA,NR,NP,NL,AN,NC,NZ,NI,NE,NG,NU,NF,KP,MP,NO,OM,PK,PW,PS,PA,PG,PY,PE,PH,PL,PT,PR,QA,CG,RE,RO,RU,RW,BL,SH,KN,MF,PM,VC,WS,SM,ST,SA,SN,RS,SC,SL,SG,SK,SI,SB,SO,ZA,KR,ES,LK,LC,SD,SR,SZ,SE,CH,SY,TW,TJ,TZ,TH,BS,GM,TL,TG,TK,TO,TT,TN,TR,TM,TC,TV,UG,UA,AE,GB,US,UY,VI,UZ,VU,VA,VE,VN,WF,YE,ZM,ZW";
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:91'],
            'lastname' => ['required', 'string', 'max:91'],
            'username' => ['required', 'alpha_dash', 'min:5', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone_code' => ['required'],
            'phone' => ['required'],
            'password' => ['required', 'string', 'confirmed'],
        ], [
            'firstname.required' => 'First Name Field is required',
            'lastname.required' => 'Last Name Field is required',
            'phone' => 'The :attribute field contains an invalid number.'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $basic = (object) config('basic');


        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone_code' => $data['phone_code'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(60),
            'email_verification' => ($basic->email_verification) ? 0 : 1,
            'sms_verification' => ($basic->sms_verification) ? 0 : 1,
        ]);


    }

    public function register(Request $request)
    {

        $this->validator($request->all())->validate();

        $user = $this->create($request->all());
        $msg = [
            'username' => $user->username,
        ];
        $action = [
            "link" => route('admin.user-edit', $user->id),
            "icon" => "fas fa-user text-white"
        ];

        $this->adminPushNotification('ADDED_USER', $msg, $action);

        $this->guard()->login($user);


        session()->forget('sponsor');

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        if ($request->ajax()) {
            return route('user.home');
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }


    /**
     * The user has been registered.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $user->last_login = Carbon::now();
        $user->save();
    }

    protected function guard()
    {
        return Auth::guard();
    }

}
