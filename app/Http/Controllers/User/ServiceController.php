<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AgentCommissionRate;
use App\Models\Category;
use App\Models\Fund;
use App\Models\Order;
use App\Models\Service;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $categories = Category::with(['service' => function ($query) {
            $query->userRate()->where('service_status', 1);
        }])
            ->where('status', 1)
            ->get();
        $user = Auth::user();
        if ($user->is_agent == 1 && $user->is_approved == 1){
            $transactions = Transaction::where('user_id',$user->id)->orderBy('id','desc')->get();
            $commissions = AgentCommissionRate::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))
                ->where('user_id', $user->id)
                ->get();
//            $children = $user->children;
//            $users_ids = [];
//            if (count($children) > 0){
//                foreach ($children as $key=>$child){
//                    $users_ids[$key] = $child->id;
//                }
//            }
            $totalCommissionsThisMonth = AgentCommissionRate::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', date('Y'))
                ->where('user_id', $user->id)
                ->get();
            $totalUnPaidCommissionsThisMonth = AgentCommissionRate::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', date('Y'))
                ->where('user_id', $user->id)
                ->where('is_paid',0 )
                ->get();
            $totalThis_month_commission_rate = 0;
            $total_un_paid_commission_rate = 0;
            foreach ($totalCommissionsThisMonth as $key1 => $commissionThisMonth) {
//                $agent = $commissionThisMonth->user;
//                if ($agent->parent->id == $user->id) {
                    $totalThis_month_commission_rate += $commissionThisMonth->commission_rate;
//                } else {
//                    $totalCommissionsThisMonth->forget($key1);
//                }
            }
            foreach ($totalUnPaidCommissionsThisMonth as $key2 => $commissionThisMonthUnPaid) {
//                $agent = $commissionThisMonth->user;
//                if ($agent->parent->id == $user->id) {
                $total_un_paid_commission_rate += $commissionThisMonthUnPaid->commission_rate;
//                } else {
//                    $totalCommissionsThisMonth->forget($key1);
//                }
            }
//            dd($commissions);
            $commission_rate = 0;
            foreach ($commissions as $commission){
                $commission_rate +=  $commission->commission_rate;
            }
            $total = Fund::where('user_id', $user->id)->where('status', 1)->sum('amount');
            return view('agent.pages.dashboard',compact('total_un_paid_commission_rate','totalThis_month_commission_rate','transactions','commission_rate','total'));
        }elseif ($user->is_agent == 1 && $user->is_approved == 0){
            return view('user.pages.waitForApproved', compact('categories'));
        }else{
            return view('user.pages.services.show-service', compact('categories'));
        }

    }

    public function show()
    {
        $categories = Category::with(['service' => function ($query) {
            $query->userRate()->where('service_status', 1);
        }])
            ->where('status', 1)
            ->get();
        $user = Auth::user();
        if ($user->is_agent == 1 && $user->is_approved == 1){

            return view('agent.pages.services.show-service',compact('categories'));
        }elseif ($user->is_agent == 1 && $user->is_approved == 0){
            return view('user.pages.services.show-service', compact('categories'));
        }else{
            return view('user.pages.services.show-service', compact('categories'));
        }

    }


    public function search(Request $request)
    {
        $search = $request->all();
        $categories = Category::with('service')->where('status', 1)
            ->when(isset($search['service']), function ($query) use ($search) {
                return $query->where('category_title', 'LIKE', "%{$search['service']}%");
            })
            ->get();
        return view('user.pages.services.show-service', compact( 'categories'));
    }
    public function service($id)
    {
        $category=Category::find($id);
        $services=Service::where('category_id', $id)->where('service_status',1)->get();
        $user = Auth::user();
        if ($user != null){
            foreach ($services as $service){
                if (!($service->price != null && $service->price !=0)){
                    $user_range = $user->priceRange;
                    $range = $service->service_price_ranges()->where('price_range_id',$user_range->id)->first();
                    $service->price = $range->price;
                    $service->agent_commission_rate = $range->agent_commission_rate;

                }
            }
        }


        return view('user.pages.services.show-services', compact('services','category'));
    }
    public function servicesearch(Request $request)
    {
        $categories = Category::with('service')->where('status', 1)->get();
        $search = $request->all();
        $services = Service::where('service_status', 1)
            ->userRate()
            ->when(isset($search['service']), function ($query) use ($search) {
                return $query->where('service_title', 'LIKE', "%{$search['service']}%");
            })
            ->when(isset($search['category']), function ($query) use ($search) {
                return $query->where('category_id', $search['category']);
            })
            ->with(['category'])
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
        return view('user.pages.services.search-service', compact('services', 'categories'));
    }

    public function getPlayerName($category,$playerid)
    {
        $key=env('player_key', 'null');
        $category=Category::find($category);
        $url="http://www.m7-system.com/match?key=".$key."&id=".$playerid."&product=".$category->slug;
        $getPlayer=Http::get($url);
        return   $result = json_decode($getPlayer, True);
    }

}
