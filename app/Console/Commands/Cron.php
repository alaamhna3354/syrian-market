<?php

namespace App\Console\Commands;

use App\Models\Order;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Console\Command;

class Cron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Cron:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron for Order Status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Order::with(['service', 'service.provider'])->whereNotIn('status', ['completed', 'refunded', 'canceled'])->whereHas('service', function ($query) {
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

        $this->info('status');
    }
}
