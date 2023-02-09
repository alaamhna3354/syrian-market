<?php

namespace App\Http\Controllers;

use App\Models\ApiProvider;
use App\Models\Category;
use App\Models\Service;
use App\Services\AshabService;
use Dompdf\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ixudra\Curl\Facades\Curl;
use function Symfony\Component\String\b;

class CustomProviderController extends Controller
{
    private $provider;

    const getPlayerNameUrl = '/getPlayerName/';
    const getProductsUrl='/products/';
    /**
     * CustomProviderController constructor.
     * @param $provider
     */
    public function __construct()
    {
        $this->provider = ApiProvider::where('is_custom',1)->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $api_providers = ApiProvider::where('is_custom',1)->orderBy('id','DESC')->get();
        return view('admin.pages.api_providers.show', compact('api_providers'));
    }

    public function getPlayerName($playerId,$game)
    {
//        $apiLiveData = Curl::to($this->provider['url'].$this::getPlayerNameUrl)
//                ->withData(['key'=>$this->provider['api_key'], 'playerid'=>$playerId, 'game'=>$game])->post();
//
//        return json_decode($apiLiveData);
        $ashab = new AshabService();

        $header = array(
            "Content-Type: application/json",
            "Authorization: Bearer 79a6b08730b522938f8efb33e57018cb"
        );
        $ashabResponse = $ashab->as7abGetPlayerName('https://private-anon-3d2b1f1e39-as7abcard.apiary-mock.com/api/v1/getPlayerName/',$playerId,$game,$header);
        dd(json_decode($ashabResponse));
    }

    public function getApiServices(Request $request)
    {
        $rules = [
            'api_provider_id' => 'required|string|max:150'
        ];
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $provider = ApiProvider::find($request->api_provider_id);
        $categories = Category::orderBy('id', 'DESC')->where('status', 1)->get();

        $ashabService = new AshabService();

        $header = array(
            "Content-Type: application/json",
            "Authorization: Bearer 79a6b08730b522938f8efb33e57018cb"
        );
        $ashabResponse = $ashabService->as7abGetServices('https://private-anon-3d2b1f1e39-as7abcard.apiary-mock.com/api/v1/products',$header);


//        $apiLiveData = Curl::to($this->provider['url'].$this::getProductsUrl.$request->product)
//            ->withData(['key'=>$this->provider['api_key']])->get();
//        $apiServiceLists = json_decode($apiLiveData);
        $apiServiceLists = $ashabResponse;
//        dd($apiServiceLists);
        return view('admin.pages.services.show-custom-api-services', compact('apiServiceLists','provider','categories'));
    }

    public function importApiService(Request $request){
//        dd($request);
        try {
            $req = $request->all();
            $category = Category::find($req['category_id']);
            $services = Service::all();
            $insertCat = 1;
            $existService = 0;
//            dd($req);
            foreach($services as $service):
                if($service->api_provider_id == $req['provider'] && $service->api_service_id == $req['id']):
                    $existService = 1;
                endif;
            endforeach;
            if($existService != 1):
                $service = new Service();
                $service->service_title = $req['name'];
                $service->category_id =$category->id;
                $service->min_amount = $req['min_amount'];
                $service->max_amount = $req['max_amount'];
                $service->agent_commission_rate = $req['agent_commission_rate'];
                $service->price = $req['price'];
                $service->service_status = $req['service_status'];
                $service->is_available = $req['is_available'];
                $service->api_provider_id = $req['provider'];
                $service->api_service_id = $req['id'];
                $service->drip_feed = 0;
                $service->api_provider_price = $req['rate'];
                $service->description = $req['description'];
                $service->points = $req['points'];
                DB::beginTransaction();
                $service->save();
                DB::commit();
                return redirect()->route('admin.service.show')->with('success', 'Service Imported Successfully');;
            else:
                return redirect()->route('admin.service.show')->with('success', 'Already Have this service');
            endif;
        }catch (\Exception $exception){
            DB::rollBack();
            return back()->with('error', trans('Sorry There Are An Error'));
        }

    }

    public function getProducts()
    {
        $apiLiveData = Curl::to($this->provider['url'].$this::getProductsUrl)->withData(['key'=>$this->provider['api_key']])->get();
        $products = json_decode($apiLiveData);

        return view('admin.pages.services.show-api-services', compact('apiServiceLists','provider'));
    }
}
