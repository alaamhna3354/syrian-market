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
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }



    public function as7abGetPlayerName($url,$playerid,$game, $headers)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$url.?playerid=.$playerid.&game=.$game");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        return json_decode($response,true)['playername'];
    }

    public function as7abGetServices($url,$headers){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result,true)['products'];

    }

    public function as7abGetServicesByCategory($url, $headers)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $result = curl_exec($ch);
        curl_close($ch);
        $services = collect();
        $category_name = json_decode($result,true)['name'];
        foreach (json_decode($result,true)['products'] as $item){
            $services->add($item);
        }
        $servicesForCategory = $services->map(function ($service) use ($category_name){
            return [
                'service' => $service['denomination_id'],
                'name' => $service['product_name'],
                'category' => $category_name,
                'dripfeed' => '0',
                'rate' => $service['product_price'],
                'min' => 0,
                'max' => 0,
                'is_available' => $service['product_available']
            ];
        });
        return $servicesForCategory;
    }
}
