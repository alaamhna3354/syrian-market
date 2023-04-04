<?php

namespace App\Http\Controllers;

use App\Models\ApiProvider;
use App\Models\Category;
use App\Models\Service;
use App\Services\AshabService;
use Dompdf\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ixudra\Curl\Facades\Curl;
use Symfony\Component\Translation\Exception\ProviderException;
use function Symfony\Component\String\b;

class CustomProviderController extends Controller
{
    private $provider;

    const getPlayerNameUrl = '/getPlayerName/';
    const getProductsUrl = '/products/';

    /**
     * CustomProviderController constructor.
     * @param $provider
     */
    public function __construct()
    {
        $this->provider = ApiProvider::where('is_custom', 1)->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $api_providers = ApiProvider::where('is_custom', 1)->orderBy('id', 'DESC')->get();
        return view('admin.pages.api_providers.show', compact('api_providers'));
    }

    public function getPlayerName($playerId, $game)
    {
        $provider = ApiProvider::find(1);
        $header = array(
            "Content-Type: application/json",
            "Authorization: Bearer " . $provider->api_key
        );
        $url = $provider->url . self::getPlayerNameUrl . '?playerid=' . $playerId . '&game=' . $game;
        $ashabResponse = $this->ashabCurl($url, $header);
        if ($ashabResponse) {
            if ($ashabResponse['result'] == 'success') {
                return $ashabResponse['playername'];
            } else {
                return 'error';
            }
        } else {
            return 'error';
        }
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
    $categories =Category::all();
        $provider = ApiProvider::find($request->api_provider_id);
        if ($provider->is_custom == 1) {
            $categories = Category::orderBy('id', 'DESC')->where('status', 1)->get();
            $header = array(
                "Content-Type: application/json",
                "Authorization: Bearer " . $provider->api_key
            );
            $url = $provider->url . self::getProductsUrl;
            $ashabResponse = $this->ashabCurl($url, $header);
            if (isset($ashabResponse['result']) && $ashabResponse['result'] == 'success') {
                $apiServiceLists = $ashabResponse['products'];
                return view('admin.pages.services.show-custom-api-category', compact('apiServiceLists', 'provider', 'categories'));
            } else {
                return back()->with('error', trans(@$ashabResponse['message']))->withInput();
            }
        } else {
            $apiLiveData = Curl::to($provider['url'])->withData(['key' => $provider['api_key'], 'action' => 'services'])->post();
            $apiServiceLists = json_decode($apiLiveData);

            return view('admin.pages.services.show-api-services', compact('apiServiceLists', 'provider','categories'));
        }
    }

    public function getApiServicesByCategory($category_id, ApiProvider $provider, $min, $max)
    {
        $categories = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $url = $provider->url . self::getProductsUrl . $category_id;
        $header = array(
            "Content-Type: application/json",
            "Authorization: Bearer " . $provider->api_key
        );
        $result = $this->ashabCurl($url, $header);
        $services = collect();
        $category_name = $result['name'];
        foreach ($result['products'] as $item) {
            $services->add($item);
        }
        $servicesForCategory = $services->map(function ($service) use ($category_name, $min, $max) {
            return [
                'service' => $service['denomination_id'],
                'name' => $service['product_name'],
                'category' => $category_name,
                'dripfeed' => '0',
                'rate' => $service['product_price'],
                'min' => $min,
                'max' => $max,
                'is_available' => $service['product_available']
            ];
        });
        $apiServiceLists = $servicesForCategory;
        return view('admin.pages.services.show-custom-api-services', compact('apiServiceLists', 'provider', 'categories'));
    }

    public function importApiService(Request $request)
    {
        try {
            $req = $request->all();
            $category = Category::find($req['category_id']);
            $services = Service::all();
            $existService = 0;
            foreach ($services as $service):
                if ($service->api_provider_id == $req['provider'] && $service->api_service_id == $req['id']):
                    $existService = 1;
                endif;
            endforeach;
            if ($existService != 1):
                $service = new Service();
                $service->service_title = $req['name'];
                $service->category_id = $category->id;
                $service->min_amount = $req['min_amount'];
                $service->max_amount = $req['max_amount'];
                $service->agent_commission_rate = isset($req['agent_commission_rate']) ? $req['agent_commission_rate'] : 0;
                $service->price = $req['price'];
                $service->service_status = $req['service_status'];
                $service->is_available = $req['is_available'];
                $service->api_provider_id = $req['provider'];
                $service->api_service_id = $req['id'];
                $service->drip_feed = 0;
                $service->api_provider_price = $req['rate'];
                $service->description = $req['description'];
                $service->points = isset($req['points']) ? $req['points'] : 0;
                $service->api_service_params = $req['api_service_params'] ?? null;
                DB::beginTransaction();
                $service->save();
                DB::commit();
                return redirect()->route('admin.service.show')->with('success', 'Service Imported Successfully');;
            else:
                return redirect()->route('admin.service.show')->with('success', 'Already Have this service');
            endif;
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', trans('Sorry There Are An Error'));
        }

    }

    public function getProducts()
    {
        $apiLiveData = Curl::to($this->provider['url'] . $this::getProductsUrl)->withData(['key' => $this->provider['api_key']])->get();
        $products = json_decode($apiLiveData);

        return view('admin.pages.services.show-api-services', compact('apiServiceLists', 'provider'));
    }

    public function ashabCurl($url, $header)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }
}
