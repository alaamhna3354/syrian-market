<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\PriceRange;
use App\Models\Service;
use App\Models\ServicePriceRange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ixudra\Curl\Facades\Curl;
use Stevebauman\Purify\Facades\Purify;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('service', 'service.provider')->has('service')->paginate(config('basic.paginate'));
        return view('admin.pages.services.show-service', compact('categories'));
    }

    /*
     * search
     */
    public function search(Request $request)
    {
        $categories = Category::with('service')->get();
        $search = $request->all();
        $services = Service::with(['category'])
            ->when(isset($search['service']), function ($query) use ($search) {
                return $query->where('service_title', 'LIKE', "%{$search['service']}%");
            })
            ->when(isset($search['category']), function ($query) use ($search) {
                if ($search['category'] == -1) {
                    return $query->where('category_id', '!=', '-1');
                }
                return $query->where('category_id', $search['category']);
            })
            ->when($search['status'] != -1, function ($query) use ($search) {
                return $query->where('service_status', $search['status']);
            })
            ->get()
            ->groupBy('category.category_title');
        return view('admin.pages.services.search-service', compact('services', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $ranges = PriceRange::all();
        return view('admin.pages.services.add-service', compact('categories',  'ranges'));
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
        $ranges = PriceRange::all();
        $rules = [
            'service_title' => 'required|string|max:150',
            'category_id' => 'required|string',
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'price' => 'required|numeric',
            'agent_commission_rate' => 'required|numeric',
        ];
        foreach ($ranges as $range) {
            $rules['price_' . $range->id] = 'required|numeric';
            $rules['agent_commission_' . $range->id] = 'required|numeric';
        }
        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $service = new Service();
        $service->service_title = $req['service_title'];
        $service->category_id = $req['category_id'];
        $service->min_amount = $req['min_amount'];
        $service->max_amount = $req['max_amount'];
        $service->agent_commission_rate = $req['agent_commission_rate'];
        $service->price = $req['price'];
        $service->service_status = $req['service_status'];
        $service->is_available = $req['is_available'];
        $service->description = $req['description'];
        $service->points = $req['points'];
        if (isset($req['country']) && isset($req['product']))
            $service->api_service_params = $req['country'] . '/any/' . $req['product'];
        if ($service->save()) {
            foreach ($ranges as $range) {
                $service_price_range = new ServicePriceRange();
                $service_price_range->service_id = $service->id;
                $service_price_range->price_range_id = $range->id;
                $service_price_range->price = $req['price_' . $range->id];
                $service_price_range->agent_commission_rate = $req['agent_commission_' . $range->id];
                $service_price_range->save();
            }
            $success = trans("Created Successfully");
            return back()->with('success', $success);
        } else {
            return back()->with('error', trans('Sorry There Are An Error'));
        }

    }


    public function serviceActive(Request $request)
    {
        $service = Service::all();
        foreach ($service as $data) {
            $ser = Service::find($data->id);
            $ser->service_status = 1;
            $ser->save();
        }
        return back()->with('success', trans("Successfully Updated"));
    }

    public function serviceDeActive(Request $request)
    {
        $service = Service::all();
        foreach ($service as $data) {
            $ser = Service::find($data->id);
            $ser->service_status = 0;
            $ser->save();
        }
        return back()->with('success', trans("Successfully Updated"));
    }

    public function edit($id)
    {
        $service = Service::find($id);
//        dd();
        $categories = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $ranges = PriceRange::all();
        return view('admin.pages.services.edit-service', compact('service', 'ranges', 'categories'));
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
        $ranges = PriceRange::all();
        $rules = [
            'service_title' => 'required|string|max:150',
            'category_id' => 'required|string',
            'min_amount' => 'required',
            'price' => 'required',
            'max_amount' => 'required',
            'agent_commission_rate' => 'required|numeric',
        ];
        foreach ($ranges as $range) {
            $rules['price_' . $range->id] = 'required|numeric';
            $rules['agent_commission_' . $range->id] = 'required|numeric';
        }
        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $service = Service::find($request->id);
        $service->service_title = $req['service_title'];
        $service->category_id = $req['category_id'];
        $service->min_amount = $req['min_amount'];
        $service->max_amount = $req['max_amount'];
        $service->price = $req['price'];
        $service->service_status = $req['service_status'];
        $service->agent_commission_rate = $req['agent_commission_rate'];
        if (isset($req['country']) && isset($req['product']))
            $service->api_service_params = $req['country'] . '/any/' . $req['product'];
        $service->is_available = $req['is_available'];
        $service->description = $req['description'];
        $service->points = $req['points'];

        if ($service->save()) {
            foreach ($ranges as $range) {
                if ($service->service_price_ranges()->where('price_range_id', $range->id)->first() != null) {
                    $service_price_range = $service->service_price_ranges()->where('price_range_id', $range->id)->first();
                    $service_price_range->service_id = $service->id;
                    $service_price_range->price_range_id = $range->id;
                    $service_price_range->price = $req['price_' . $range->id];
                    $service_price_range->agent_commission_rate = $req['agent_commission_' . $range->id];
                    $service_price_range->save();
                } else {
                    $service_price_range = new ServicePriceRange();
                    $service_price_range->service_id = $service->id;
                    $service_price_range->price_range_id = $range->id;
                    $service_price_range->price = $req['price_' . $range->id];
                    $service_price_range->agent_commission_rate = $req['agent_commission_' . $range->id];
                    $service_price_range->save();
                }
            }
            $success = trans("Successfully Updated");
            return back()->with('success', $success);
        } else {
            return back()->with('error', trans('Sorry There Are An Error'));
        }
    }


    public function activeMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', "You didn't select any row");
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $services = Service::whereIn('id', $ids);
                $services->update([
                    'service_status' => 1,
                ]);
                session()->flash('success', trans("Successfully Updated"));
                return response()->json(['success' => 1]);
            }
        }
    }


    public function deactiveMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', trans("You didn't select any row"));
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $services = Service::whereIn('id', $ids);
                $services->update([
                    'service_status' => 0,
                ]);
                session()->flash('success', trans("Successfully Updated"));
                return response()->json(['success' => 1]);
            }
        }
    }

    /*
     * search drop
     */
    public function getService(Request $request)
    {
        $service = Service::where('service_title', 'LIKE', "%{$request->data}%")->get()->pluck('service_title');
        return response()->json($service);
    }

    public function statusChange(Request $request, $id)
    {
        $service = Service::findorfail($id);
        if ($service['service_status'] == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $service->service_status = $status;
        $service->save();
        return back()->with('success', trans('Successfully Updated'));
    }
}
