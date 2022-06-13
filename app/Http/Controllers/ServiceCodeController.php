<?php

namespace App\Http\Controllers;

use App\Models\ApiProvider;
use App\Models\Category;
use App\Models\Service;
use App\Models\ServiceCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ixudra\Curl\Facades\Curl;
use Stevebauman\Purify\Facades\Purify;

class ServiceCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service_codes = ServiceCode::with('service')->paginate(config('basic.paginate'));
        $services = Service::with('service_code')->has('service_code')->paginate(config('basic.paginate'));
        return view('admin.pages.service_codes.show-service_codes', compact('service_codes','services'));
    }

    /*
     * search
     */
    public function search(Request $request)
    {

        $services = Service::with('service_code')->get();

        $search = $request->all();
        $service_codes = ServiceCode::with('service')
            ->when(isset($search['service_code']), function ($query) use ($search) {
                return $query->where('code', 'LIKE', "%{$search['service_code']}%");
            })
            ->when(isset($search['service']), function ($query) use ($search) {
                if($search['service'] == -1){
                    return $query->where('service_id','!=', '-1');
                }
                return $query->where('service_id', $search['service']);
            })
            ->when($search['status'] != -1, function ($query) use ($search) {
                return $query->where('is_active', $search['status']);
            })
            ->get()
            ->groupBy('service.service_title');
        return view('admin.pages.service_codes.search-service-code', compact('services', 'categories', 'apiProviders'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $services = Service::orderBy('id', 'DESC')->where('service_status', 1)->get();
        foreach ($services as $key=>$service){
            if($service->category->type != 'CODE'){
                $services->forget($key);
            }
        }
//        dd($services);
        return view('admin.pages.service_codes.add-service-code', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req = Purify::clean($request->all());
        $rules = [
            'code' => 'required|string|max:150',
            'service_id' => 'required',
        ];
        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $service_code = new ServiceCode();
        $service_code->code = $req['code'];
        $service_code->service_id = $req['service_id'];
        $service_code->is_active = $req['status'];


        $save = $service_code->save();
        if ($save){
            $success = 'Successfully Added';
            return back()->with('success', $success);
        }else{
            return back()->with('error', 'Please Check The Data')->withInput();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addMulti()
    {
        $services = Service::orderBy('id', 'DESC')->where('service_status', 1)->get();
        return view('admin.pages.service_codes.add-multi-service-code', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeMulti(Request $request)
    {

        $req = Purify::clean($request->all());
        $rules = [
            'code' => 'required',
            'service_id' => 'required',
        ];
        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $codes = explode("\r\n", $req['code']);

        foreach ($codes as $code) {

            $service_code = new ServiceCode();
            $service_code->code = $code;
            $service_code->service_id = $req['service_id'];
            $service_code->is_active = $req['status'];


            $service_code->save();
//            if ($save){
//                $success = 'Successfully Added';
//                return back()->with('success', $success);
//            }else{
//                return back()->with('error', 'Please Check The Data')->withInput();
//            }
        }

        return back()->with('success', 'Successfully Added');
    }

    public function serviceCodeActive(Request $request)
    {
        $service_code = ServiceCode::all();
        foreach ($service_code as $data) {
            $ser = ServiceCode::find($data->id);
            $ser->is_active = 1;
            $ser->save();
        }
        return back()->with('success', 'Successfully Updated');
    }

    public function serviceCodeDeActive(Request $request)
    {
        $service_code = ServiceCode::all();
        foreach ($service_code as $data) {
            $ser = ServiceCode::find($data->id);
            $ser->is_active = 0;
            $ser->save();
        }
        return back()->with('success', 'Successfully Updated');
    }

    public function edit($id)
    {
        $service_code = ServiceCode::find($id);
        $services = Service::orderBy('id', 'DESC')->where('service_status', 1)->get();
        return view('admin.pages.service_codes.edit-service-code', compact('services', 'service_code'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $req = Purify::clean($request->all());
        $rules = [
            'code' => 'required|string|max:150',
            'service_id' => 'required',
        ];
        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $service_code = ServiceCode::find($request->id);
        $service_code->code = $req['code'];
        $service_code->service_id = $req['service_id'];
        $service_code->is_active = $req['status'];

        $save = $service_code->save();
        if ($save){
            $success = 'Successfully Updated';
            return back()->with('success', $success);
        }else{
            return back()->with('error', 'Please Check The Data')->withInput();
        }
    }
}
