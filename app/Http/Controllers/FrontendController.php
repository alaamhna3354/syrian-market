<?php

namespace App\Http\Controllers;

use App\Http\Traits\Notify;
use App\Mail\SendMail;
use App\Models\ApiProvider;
use App\Models\Category;
use App\Models\Content;
use App\Models\ContentDetails;
use App\Models\Gateway;
use App\Models\Language;
use App\Models\Order;
use App\Models\PriceRange;
use App\Models\Service;
use App\Models\Subscriber;
use App\Models\Template;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Ixudra\Curl\Facades\Curl;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    use Notify;

    public function __construct()
    {
        $this->theme = template();
    }

    public function index()
    {
//        $templateSection = ['hero', 'about-us', 'how-it-work', 'service', 'call-to-action', 'testimonial', 'blog'];
//        $data['templates'] = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');
//
//        $contentSection = ['feature', 'how-it-work', 'service', 'counter', 'testimonial', 'blog'];
//        $data['contentDetails'] = ContentDetails::select('id', 'content_id', 'description', 'created_at')
//            ->whereHas('content', function ($query) use ($contentSection) {
//                return $query->whereIn('name', $contentSection);
//            })
//            ->with(['content:id,name',
//                'content.contentMedia' => function ($q) {
//                    $q->select(['content_id', 'description']);
//                }])
//            ->get()->groupBy('content.name');
//
//        $data['gateways'] = Gateway::where('status', 1)->orderBy('sort_by')->get();
        $data['categories']= Category::with(['service' => function ($query) {
            $query->userRate()->where('service_status', 1);
        }])
            ->where('status', 1)
            ->get();
        return view($this->theme . 'home', $data);
    }

    public function blog()
    {
        $data['title'] = "Guide";
        $contentSection = ['blog'];
        $data['contentDetails'] = ContentDetails::select('id', 'content_id', 'description', 'created_at')
            ->whereHas('content', function ($query) use ($contentSection) {
                return $query->whereIn('name', $contentSection);
            })
            ->with(['content:id,name',
                'content.contentMedia' => function ($q) {
                    $q->select(['content_id', 'description']);
                }])
            ->get()->groupBy('content.name');
        $data['levels'] = PriceRange::all();
        $data['pointsSection']=Template::where('section_name','points')->first();

        return view($this->theme . 'blog', $data);
    }

    public function blogDetails($slug, $id)
    {
        $getData = Content::findOrFail($id);

        $contentSection = [$getData->name];
        $contentDetail = ContentDetails::select('id', 'content_id', 'description', 'created_at')
            ->where('content_id', $getData->id)
            ->whereHas('content', function ($query) use ($contentSection) {
                return $query->whereIn('name', $contentSection);
            })
            ->with(['content:id,name',
                'content.contentMedia' => function ($q) {
                    $q->select(['content_id', 'description']);
                }])
            ->get()->groupBy('content.name');


        $contentDetails = ContentDetails::select('id', 'content_id', 'description', 'created_at')
            ->where('content_id', '!=', $getData->id)
            ->whereHas('content', function ($query) use ($contentSection) {
                return $query->whereIn('name', $contentSection);
            })
            ->with(['content:id,name',
                'content.contentMedia' => function ($q) {
                    $q->select(['content_id', 'description']);
                }])
            ->get()->groupBy('content.name');


        $singleItem['title'] = @$contentDetail[$getData->name][0]->description->title;
        $singleItem['description'] = @$contentDetail[$getData->name][0]->description->description;
        $singleItem['d'] = dateTime(@$contentDetail[$getData->name][0]->created_at, 'd');
        $singleItem['M'] = dateTime(@$contentDetail[$getData->name][0]->created_at, 'M');
        $singleItem['image'] = getFile(config('location.content.path') . @$contentDetail[$getData->name][0]->content->contentMedia->description->image);

        $contentSectionPopular = ['blog'];
        $popularContentDetails = ContentDetails::select('id', 'content_id', 'description', 'created_at')
            ->whereHas('content', function ($query) use ($contentSectionPopular) {
                return $query->whereIn('name', $contentSectionPopular);
            })
            ->with(['content:id,name',
                'content.contentMedia' => function ($q) {
                    $q->select(['content_id', 'description']);
                }])
            ->get()->groupBy('content.name');
        return view($this->theme . 'blogDetails', compact('singleItem', 'contentDetails', 'popularContentDetails'));
    }

    public function apiDocs()
    {
        $title = 'API Docs';

        if (Auth::check()) {
            return redirect()->route('user.api.docs');
        }
        return view($this->theme . 'api-docs', compact('title'));
    }

    public function services()
    {
        $categories = Category::with(['service' => function ($query) {
            return $query->where('service_status', 1)->userRate();
        }])->where('status', 1)->get();

        return view($this->theme . 'services.show-service', compact('categories'));
    }

    public function serviceSearch(Request $request)
    {
        $categories = Category::with('service')->get();
        $search = $request->all();
        $services = Service::where('service_status', 1)->userRate()
            ->when(isset($search['service']), function ($query) use ($search) {
                return $query->where('service_title', 'LIKE', "%{$search['service']}%");
            })
            ->when(isset($search['category']), function ($query) use ($search) {
                return $query->where('category_id', $search['category']);
            })
            ->with(['category', 'provider'])
            ->get()
            ->groupBy('category.category_title');
        $user = Auth::user();
        if ($user != null){
            if ($user->is_special == 1){
                foreach ($services as $service){
                    if ($service->special_price != null){
                        $service->price = $service->special_price;
                    }

                }
            }
        }

        return view($this->theme . 'services.search-service', compact('services', 'categories'));
    }

    public function about()
    {

        $templateSection = ['about-us', 'service', 'testimonial'];
        $data['templates'] = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');


        $contentSection = ['feature', 'counter', 'testimonial'];
        $data['contentDetails'] = ContentDetails::select('id', 'content_id', 'description', 'created_at')
            ->whereHas('content', function ($query) use ($contentSection) {
                return $query->whereIn('name', $contentSection);
            })
            ->with(['content:id,name',
                'content.contentMedia' => function ($q) {
                    $q->select(['content_id', 'description']);
                }])
            ->get()->groupBy('content.name');

        $data['gateways'] = Gateway::where('status', 1)->orderBy('sort_by')->get();
        return view($this->theme . 'about', $data);

    }

    public function faq()
    {
        $msaderOrders = Order::whereNotNull('api_order_id')
            ->where('created_at', '>', now()->subMinutes(25))
            ->whereHas('service', function ($q) {
                $q->where('api_provider_id', 3);
            })
            ->get();
        $msaderOrders = $msaderOrders->pluck('api_order_id');
        if (isset($msaderOrders))
            $this->updateMsaderOrders($msaderOrders);
        Log::channel('cronjob')->info($msaderOrders);
        return true;
    }

    public function contact()
    {
        $templateSection = ['contact-us'];
        $templates = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');
        $title = 'Contact Us';
        $contact = @$templates['contact-us'][0]->description;
        return view($this->theme . 'contact', compact('title', 'contact'));
    }

    public function contactSend(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|max:91',
            'subject' => 'required|max:100',
            'message' => 'required|max:1000',
        ]);
        $requestData = Purify::clean($request->except('_token', '_method'));

        $basic = (object)config('basic');
        $basicEmail = $basic->sender_email;

        $name = $requestData['name'];
        $email_from = $requestData['email'];
        $requestMessage = $requestData['message'];
        $subject = $requestData['subject'];

        $email_body = json_decode($basic->email_description);

        $message = str_replace("[[name]]", 'Sir', $email_body);
        $message = str_replace("[[message]]", $requestMessage, $message);

        Mail::to($basicEmail)->send(new SendMail($email_from, $subject, $message, $name));

        return back()->with('success', trans('Mail has been sent'));
    }
//$2y$10$fI4stKwL9RqRUOVai8vKm.3XWE.xrvjEmuBiQGn.Md3chHG78.PvO
    public function getLink($getLink, $id)
    {
        $getData = Content::findOrFail($id);

        $contentSection = [$getData->name];
        $contentDetail = ContentDetails::select('id', 'content_id', 'description', 'created_at')
            ->where('content_id', $getData->id)
            ->whereHas('content', function ($query) use ($contentSection) {
                return $query->whereIn('name', $contentSection);
            })
            ->with(['content:id,name',
                'content.contentMedia' => function ($q) {
                    $q->select(['content_id', 'description']);
                }])
            ->get()->groupBy('content.name');


        $title = @$contentDetail[$getData->name][0]->description->title;
        $description = @$contentDetail[$getData->name][0]->description->description;
        return view($this->theme . 'getLink', compact('contentDetail', 'title', 'description'));
    }

    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255|unique:subscribers'
        ]);

        $data = new Subscriber();
        $data->email = $request->email;
        $data->save();
        return redirect(url()->previous() . '#subscribe')->with('success', trans('Subscribe successfully'));
    }

    public function language($code)
    {
        $language = Language::where('short_name', $code)->first();
        if (!$language) $code = 'en';
        session()->put('trans', $code);
        session()->put('rtl', $language ? $language->rtl : 0);
        return redirect()->back();
    }

    public function cron()
    {
        return Order::with(['service', 'service.provider'])->whereNotIn('status', ['completed', 'refunded', 'canceled'])->whereHas('service', function ($query) {
            $query->whereNotNull('api_provider_id')->orWhere('api_provider_id', '!=', 0);
        })->get()->map(function ($order) {

            $service = $order->service;

//            if (isset($service->api_provider_id)) {
//                $apiproviderdata = $service->provider;
//                $apiservicedata = Curl::to($apiproviderdata['url'])->withData(['key' => $apiproviderdata['api_key'], 'action' => 'status','order'=>$order->api_order_id])->post();
//
//                $apidata = json_decode($apiservicedata);
//                if (isset($apidata->order)) {
//                    $order->status_description = "order: {$apidata->order}";
//                    $order->api_order_id = $apidata->order;
//                } else {
//                    $order->status_description = "error: {$apidata->error}";
//                }
//                $order->save();
//            }
        });

    }

    public function shop()
    {
        $data['title'] = "Shop";
        $contentSection = ['Shop'];
        $data['categories']= Category::with(['service' => function ($query) {
            $query->userRate()->where('service_status', 1);
        }])
            ->where('status', 1)
            ->paginate(12);
        return view($this->theme . 'shop', $data);
    }

    public function updateAs7abOrders($ashabOrdersIDs)
    {
        $as7abprovider = ApiProvider::find(1);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $as7abprovider->url . "/bulkOrderStatus/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: Bearer " . $as7abprovider->api_key
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["orderIds" => $ashabOrdersIDs]));
        $response = curl_exec($ch);

        $info = curl_getinfo($ch);
        curl_close($ch);
        $orderStatus = json_decode($response, true);
        if (isset($orderStatus['orders'])) {
            foreach ($orderStatus['orders'] as $remoteOrder) {
                $order = Order::where('api_order_id', '=', $remoteOrder['ID'])->first();
                if ($order && $this->mapAs7abOrderStatus($remoteOrder['order_status']) != $order->status) {
                    $this->statusChange($order,$this->mapAs7abOrderStatus($remoteOrder['order_status']));
                }
            }
        }
    }

    public function updateLordOrders($lordOrdersIDs)
    {
        $lordProvider = ApiProvider::find(2);
        foreach ($lordOrdersIDs as $OrderId) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_URL, $lordProvider->url . "OrderStatus?API=" . $lordProvider->api_key . "&orderId=" . $OrderId);
            $response = curl_exec($ch);
            $info = curl_getinfo($ch);
            curl_close($ch);
            $remoteOrder = json_decode($response, true);
            if(isset($remoteOrder['status']) && isset($remoteOrder['code']) && $remoteOrder['code'] ==1)
            {
                $order = Order::where('api_order_id', $OrderId)->first();
                if ($order && $this->mapLordOrderStatus($remoteOrder['status']) != $order->status)
                    $this->statusChange($order,$this->mapLordOrderStatus($remoteOrder['status']));
            }
        }
    }

    public function mapLordOrderStatus($status)
    {
        if ($status == 0)
            return "processing";
        elseif ($status == 3)
            return "completed";
        elseif ($status == 1)
            return "refunded";
        else
            return "canceled";
    }

    public function mapAs7abOrderStatus($status)
    {
        if ($status == 'processing')
            return "processing";
        elseif ($status == 'completed')
            return "completed";
        elseif ($status == 1)
            return "canceled";
        else
            return "refunded";
    }

    public function statusChange(Order $order, $status)
    {
        $user = $order->users;
        if ($status == 'refunded') {
            if ($order->status != 'refunded') {
                $user->balance += $order->price;
                $transaction1 = new Transaction();
                $transaction1->user_id = $user->id;
                $transaction1->trx_type = '+';
                $transaction1->amount = $order->price;
                $transaction1->remarks = 'استرجاع الرصيد بعد تحويل حالة الطلب الى مسترجع';
                $transaction1->trx_id = strRandom();
                $transaction1->charge = 0;
                if ($order->service->points > 0)
                    $user = $this->pointsService->refundPoints('Refund Order', $order->id, $user);
                if ($user->save()) {
                    $transaction1->save();
                }
            }
        }
        if ($status == 'completed' && $order->status == 'processing')
            $order->execution_time = $order->created_at->diffInSeconds(now());
        $order->status = $status;
        $order->updated_by = $order->service->api_provider->name ?? trans('Remote provider');
        $order->save();
        // Log::channel('cronjob')->info($order->id);
    }

    public function updateMsaderOrders($msaderOrdersIDs)
    {
        $msaderProvider = ApiProvider::find(3);
        $this->base_url = $msaderProvider->url;
        $params = [
            'key' => $msaderProvider->api_key,
            'action' => 'orders',
            'orders' => $msaderOrdersIDs->implode(',')
        ];
        $response=Curl::to($this->base_url)->withData($params)->post();
        $orderStatus = json_decode($response, true);
        if (isset($orderStatus[0]['order'])) {
            foreach ($orderStatus as $remoteOrder) {
                $order = Order::where('api_order_id', '=', $remoteOrder['order'])->first();
                if ($order && $remoteOrder['status'] != $order->status && $order->category->type !="NUMBER") {
                    if($order->category->type =="SMM" && $remoteOrder["status"] == "canceled")
                        $remoteOrder["status"] = "refunded";
                    $this->statusChange($order,$remoteOrder['status']);
                }
            }
        }
    }
}
