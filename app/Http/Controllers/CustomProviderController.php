<?php

namespace App\Http\Controllers;

use App\Models\ApiProvider;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

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
        $apiLiveData = Curl::to($this->provider['url'].$this::getPlayerNameUrl)
                ->withData(['key'=>$this->provider['api_key'], 'playerid'=>$playerId, 'game'=>$game])->post();

        return json_decode($apiLiveData);
    }

    public function getApiServices(Request $request)
    {
        $rules = [
            'product'=>'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

//        $provider = ApiProvider::find($request->api_provider_id);

        $apiLiveData = Curl::to($this->provider['url'].$this::getProductsUrl.$request->product)
            ->withData(['key'=>$this->provider['api_key']])->get();
        $apiServiceLists = json_decode($apiLiveData);

        return view('admin.pages.services.show-api-services', compact('apiServiceLists','provider'));
    }

    public function getProducts()
    {
        $apiLiveData = Curl::to($this->provider['url'].$this::getProductsUrl)->withData(['key'=>$this->provider['api_key']])->get();
        $products = json_decode($apiLiveData);

        return view('admin.pages.services.show-api-services', compact('apiServiceLists','provider'));
    }
}
