<?php

namespace App\Providers;


use App\Models\ContentDetails;
use App\Models\Language;
use App\Models\Notice;
use App\Models\Template;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $data['basic'] = (object)config('basic');
        $data['theme'] = template();
        $data['themeTrue'] = template(true);
        View::share($data);


        try {
            DB::connection()->getPdo();



            view()->composer(['admin.pages.ticket.nav', 'dashboard'], function ($view) {
                $view->with('pending', Ticket::whereIn('status', [0, 2])->latest()->with('user')->limit(10)->with('lastReply')->get());
            });


            view()->composer('user.layouts.side-notify', function ($view) {
                $view->with('notices', Notice::where('status', 1)->get());
            });

            view()->composer($data['theme'] . 'partials.footer', function ($view) {
                $view->with('languages', Language::orderBy('name')->where('is_active', 1)->get());

                $templateSection = ['contact-us'];
                $view->with('templates', Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name'));

                $contentSection = ['support','social'];
                $view->with('contentDetails', ContentDetails::select('id', 'content_id', 'description')
                    ->whereHas('content', function ($query) use ($contentSection) {
                        return $query->whereIn('name', $contentSection);
                    })
                    ->with(['content:id,name',
                        'content.contentMedia' => function ($q) {
                            $q->select(['content_id', 'description']);
                        }])
                    ->get()->groupBy('content.name'));

            });

        } catch (\Exception $e) {

        }


    }
}
