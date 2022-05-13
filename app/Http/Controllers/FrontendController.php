<?php

namespace App\Http\Controllers;

use App\Http\Traits\Notify;
use App\Mail\SendMail;
use App\Models\Category;
use App\Models\Content;
use App\Models\ContentDetails;
use App\Models\Gateway;
use App\Models\Language;
use App\Models\Order;
use App\Models\Service;
use App\Models\Subscriber;
use App\Models\Template;
use Illuminate\Http\Request;
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
        $data['title'] = "Blog";
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

        return view($this->theme . 'blog', $data);
    }

    public function blogDetails($slug = null, $id)
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
        $templateSection = ['faq'];
        $data['templates'] = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');

        $contentSection = ['faq'];
        $data['contentDetails'] = ContentDetails::select('id', 'content_id', 'description', 'created_at')
            ->whereHas('content', function ($query) use ($contentSection) {
                return $query->whereIn('name', $contentSection);
            })
            ->with(['content:id,name',
                'content.contentMedia' => function ($q) {
                    $q->select(['content_id', 'description']);
                }])
            ->get()->groupBy('content.name');

        $data['increment'] = 1;
        return view($this->theme . 'faq', $data);
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

        return back()->with('success', 'Mail has been sent');
    }

    public function getLink($getLink = null, $id)
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
        return redirect(url()->previous() . '#subscribe')->with('success', 'Subscribe successfully');
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

            if (isset($service->api_provider_id)) {
                $apiproviderdata = $service->provider;
                $apiservicedata = Curl::to($apiproviderdata['url'])->withData(['key' => $apiproviderdata['api_key'], 'action' => 'status','order'=>$order->api_order_id])->post();

                $apidata = json_decode($apiservicedata);
                if (isset($apidata->order)) {
                    $order->status_description = "order: {$apidata->order}";
                    $order->api_order_id = $apidata->order;
                } else {
                    $order->status_description = "error: {$apidata->error}";
                }
                $order->save();
            }
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
}
