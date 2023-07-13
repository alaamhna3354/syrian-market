<?php

namespace App\Console\Commands;

use App\Http\Controllers\User\OrderController as OrderController;
use App\Models\ApiProvider;
use App\Models\Order;
use App\Models\Transaction;
use App\Services\PointsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Str;

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
        if (isset($ashabOrdersIDs))
            $this->updateAs7abOrders($ashabOrdersIDs);
        $lordOrders = Order::whereNotNull('api_order_id')
            ->where('created_at', '>', now()->subMinutes(10))
            ->whereHas('service', function ($q) {
                $q->where('api_provider_id', 2);
            })
            ->get();
        $lordOrdersIDs = $lordOrders->pluck('api_order_id');
        if (isset($lordOrdersIDs))
            $this->updateLordOrders($lordOrdersIDs);

        $msaderOrders = Order::whereNotNull('api_order_id')
            ->where('created_at', '>', now()->subMinutes(10))
            ->whereHas('service', function ($q) {
                $q->where('api_provider_id', 3);
            })
            ->get();
        $msaderOrders = $msaderOrders->pluck('api_order_id');
        if (isset($msaderOrders))
            $this->updateMsaderOrders($msaderOrders);
        Log::channel('cronjob')->info($ashabOrdersIDs . '  ' . $lordOrdersIDs. '  '.$msaderOrders);
        return true;
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
    }

    public function updateMsaderOrders($msaderOrdersIDs)
    {
        $msaderProvider = ApiProvider::find(3);
        $this->base_url = $msaderProvider->url;
        $params = [
            'key' => $msaderProvider->api_key,
            'action' => 'orders',
            'orders' => json_encode($msaderOrdersIDs)
        ];
        //  Log::channel('cronjob')->info($params[orders]);
        $response=Curl::to($this->base_url)->withData($params)->post();
        $orderStatus = json_decode($response, true);
//        Log::channel('cronjob')->info($response);
        if (isset($orderStatus[0]['order'])) {
            foreach ($orderStatus as $remoteOrder) {
                $order = Order::where('api_order_id', '=', $remoteOrder['order'])->first();
                if ($order && $remoteOrder['status'] != $order->status ) {
                   if ($order->category->type != "NUMBER")
                        $this->statusChange($order, $remoteOrder['status']);
                    else {
                         Log::channel('cronjob')->info($remoteOrder['status']. " number ".$order->id );
                        if ($remoteOrder['status'] == 'completed')
                           { if (Str::contains($remoteOrder['description'], 'smscode'))
                                $res = (new OrderController(new PointsService()))
                                    ->finish5SImOrder($order->id, ['smsCode' =>  $remoteOrder['description']]);}
                            else
                                $this->statusChange($order, $remoteOrder['status']);
                    }

                }
            }
        }
    }
}
