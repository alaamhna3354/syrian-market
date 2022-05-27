<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
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
        return view('user.pages.services.show-service', compact('categories'));
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
            if ($user->is_special == 1){
                foreach ($services as $service){
                    if ($service->special_price != null){
                        $service->price = $service->special_price;
                    }

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

    public function getPlayerName($serviceid,$playerid)
    {
        $categoryapi='https://as7abcard.com/pubg-files/pubg.php?action=getPlayerName&game=pubg&playerID='.$playerid;

        $header= ["ct"=>"ql18TgDgBmsvEu5aAJkypBwDgyHyjV8iJYJSmq1E4Kf9DS20PBpkjx3kDwrkPLc9v7o2NJ0LnrkVQNCwC0FQ+4/VaGKGdk60NOtd7ExY8zI=","iv"=>"0f4e33d8213109fa64a412cb07b2659d","s"=>"c5f09a65b90f316a"];
        $getPlayer = Http::post($categoryapi,["ct"=>"ql18TgDgBmsvEu5aAJkypBwDgyHyjV8iJYJSmq1E4Kf9DS20PBpkjx3kDwrkPLc9v7o2NJ0LnrkVQNCwC0FQ+4/VaGKGdk60NOtd7ExY8zI=","iv"=>"0f4e33d8213109fa64a412cb07b2659d","s"=>"c5f09a65b90f316a"]);

        return $getPlayer->body();
    }
}
