<?php

namespace App\Services;

class PriceService
{

    static function prices($curc = 'USD')
    {
        //COIN LATEST PRICES
        $url = "https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,LTC,ETH,USDT&tsyms=$curc";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $curl_response = curl_exec($curl);
        curl_close($curl);
        $curl_jason = json_decode($curl_response, true);
        $curl_jason['JEI']['USD'] = 1.00;
        return (object) $curl_jason;
    }
}
