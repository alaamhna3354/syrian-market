<?php

namespace App\Services;

class AshabService
{
    public function curlPostRequestWithHeaders($url, $headers, $postParam = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postParam));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        // dd($ch);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }



    public function as7abGetPlayerName($url,$playerid,$game, $headers)
    {


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "$url.?playerid=.$playerid.&game=.$game");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        var_dump($info["http_code"]);
        var_dump($response);
    }

    public function as7abGetServices($url,$headers){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = collect([
            (object) ['id'=> '6','name' => 'بطاقات iTunes أميركية','slug' => '%d8%a8%d8%b7%d8%a7%d9%82%d8%a7%d8%aa-itunes-%d8%a3%d9%85%d9%8a%d8%b1%d9%83%d9%8a%d8%a9','image' => 'https://as7abcard.com/wp-content/uploads/2019/08/10-itunes-digital-gift-card-email-delivery-2x.png','group_order'=> '0'],
            (object) ['id'=> '7','name' => 'بطاقات Pubg أميركية','slug' => '%d8%a8%d8%b7%d8%a7%d9%82%d8%a7%d8%aa-itunes-%d8%a3%d9%85%d9%8a%d8%b1%d9%83%d9%8a%d8%a9','image' => 'https://as7abcard.com/wp-content/uploads/2019/08/10-itunes-digital-gift-card-email-delivery-2x.png','group_order'=> '0'],
            (object) ['id'=> '8','name' => 'بطاقات freefire أميركية','slug' => '%d8%a8%d8%b7%d8%a7%d9%82%d8%a7%d8%aa-itunes-%d8%a3%d9%85%d9%8a%d8%b1%d9%83%d9%8a%d8%a9','image' => 'https://as7abcard.com/wp-content/uploads/2019/08/10-itunes-digital-gift-card-email-delivery-2x.png','group_order'=> '0'],
            (object) ['id'=> '9','name' => 'بطاقات yaho أميركية','slug' => '%d8%a8%d8%b7%d8%a7%d9%82%d8%a7%d8%aa-itunes-%d8%a3%d9%85%d9%8a%d8%b1%d9%83%d9%8a%d8%a9','image' => 'https://as7abcard.com/wp-content/uploads/2019/08/10-itunes-digital-gift-card-email-delivery-2x.png','group_order'=> '0'],
            (object) ['id'=> '10','name' => 'بطاقات jawaker أميركية','slug' => '%d8%a8%d8%b7%d8%a7%d9%82%d8%a7%d8%aa-itunes-%d8%a3%d9%85%d9%8a%d8%b1%d9%83%d9%8a%d8%a9','image' => 'https://as7abcard.com/wp-content/uploads/2019/08/10-itunes-digital-gift-card-email-delivery-2x.png','group_order'=> '0'],
        ]);
        $services = collect();

        foreach ($result as $category){
            $categoryUrl = 'https://private-anon-3d2b1f1e39-as7abcard.apiary-mock.com/api/v1/products/'.$category->id;
            $servicesByCategory = $this->as7abGetServicesByCategory($categoryUrl,$headers);
            foreach ($servicesByCategory as $item){
                $services->add($item);
            }
        }
        $result = $services->map(function ($service){
            return [
                'service' => $service->denomination_id,
                'name' => $service->product_name,
                'category' => $service->category_name,
                'dripfeed' => '0',
                'rate' => $service->product_price,
                'min' => 0,
                'max' => 0,
                'is_available' => $service->product_available
            ];
        });
//        dd($result);
        return $result;
    }

    public function as7abGetServicesByCategory($url, $headers)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = collect([
            (object) ['category_name'=>'بطاقات أمازون','denomination_id'=> '55445','product_name' => 'بطاقة أمازون $10','handler' => '','product_available' => 'true','product_price'=> '10.25'],
            (object) ['category_name'=>'بطاقات أمازون','denomination_id'=> '55446','product_name' => 'بطاقة أمازون $15','handler' => '','product_available' => 'true','product_price'=> '10.25'],
            (object) ['category_name'=>'بطاقات أمازون','denomination_id'=> '55447','product_name' => 'بطاقة أمازون $20','handler' => '','product_available' => 'true','product_price'=> '10.25'],
            (object) ['category_name'=>'بطاقات أمازون','denomination_id'=> '55448','product_name' => 'بطاقة أمازون $25','handler' => '','product_available' => 'true','product_price'=> '10.25'],
            (object) ['category_name'=>'بطاقات أمازون','denomination_id'=> '55449','product_name' => 'بطاقة أمازون $30','handler' => '','product_available' => 'true','product_price'=> '10.25'],

        ]);
        return $result;
//        dd();
    }
}
