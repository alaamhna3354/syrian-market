<?php

namespace App\Console\Commands;

use App\Models\ApiProvider;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateApiOrdersStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:order_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update remote orders status';

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
        $ashabOrders = Order::whereNotNull('api_order_id')
            ->where('created_at', '>', now()->subMinutes(10))
            ->whereHas('service', function ($q) {
                $q->where('api_provider_id', 1);
            })
            ->get();
        $ashabOrdersIDs = $ashabOrders->pluck('api_order_id');
        if(isset($ashabOrdersIDs))
        $this->updateAs7abOrders($ashabOrdersIDs);
        $lordOrders = Order::whereNotNull('api_order_id')
            ->where('created_at', '>', now()->subMinutes(10))
            ->whereHas('service', function ($q) {
                $q->where('api_provider_id', 2);
            })
            ->get();
        $lordOrdersIDs = $lordOrders->pluck('api_order_id');
        if(isset($lordOrdersIDs))
        $this->updateLordOrders($lordOrdersIDs);
        Log::channel('cronjob')->info($ashabOrdersIDs . '  ' . $lordOrdersIDs);
        return true;
    }

    public function updateAs7abOrders($ashabOrdersIDs)
    {
        $as7abprovider = ApiProvider::find(1);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $as7abprovider->url . "bulkOrderStatus/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: Bearer " . $as7abprovider->api_key
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode('"orderIds":' . $ashabOrdersIDs));
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        $orderStatus = json_decode($response, true);
        if (isset($orderStatus['orders'])) {
            foreach ($orderStatus['orders'] as $order) {
                $order = Order::where('api_order_id', '=', $order['ID'])->get();
                if ($order && $order->status != $order['order_status'])
                    $order->update(['status' => $order['order_status']]);
            }
        }
    }

    public function updateLordOrders($lordOrdersIDs)
    {
        $lordProvider = ApiProvider::find(2);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        foreach ($lordOrdersIDs as $OrderId) {
            curl_setopt($ch, CURLOPT_URL, $lordProvider->url . "OrderStatus?API=" . $lordProvider->api_key . "&orderId=" . $OrderId);
            $response = curl_exec($ch);
            $info = curl_getinfo($ch);
            curl_close($ch);
            $orderStatus = json_decode($response, true);
            $order = Order::where('api_order_id', '=', $OrderId)->get();
            if ($order && $this->mapLordOrderStatus($order->status) != $orderStatus['Status'])
                $order->update(['status' => $this->mapLordOrderStatus($order->status)]);
        }
    }

    public function mapLordOrderStatus($status)
    {
        if ($status == 0)
            return "processing";

        elseif ($status == 3)
            return "completed";

        elseif ($status == 1)
            return "canceled";

        else
            return "canceled";
    }
}
