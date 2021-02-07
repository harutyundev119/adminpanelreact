<?php
// Currency new data info
namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;

class CurrencyUpdateController extends Controller {

    public function currencyUpdate() {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://cb.am/latest.json.php?currency=USD");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        $usdl = json_decode($output);
        foreach ($usdl as $keyusd => $valueusd) {
            $usd = $keyusd;
            $usdvalue = $valueusd;
        }
        $usd_currency = Currency::where('code', $usd)->first();
        if ($usd_currency->rate != $usdvalue) {
            Currency::where('code', $usd)->update([
                'rate' => $usdvalue,
            ]);
        }
        $chs = curl_init();
        curl_setopt($chs, CURLOPT_URL, "https://cb.am/latest.json.php?currency=RUB");
        curl_setopt($chs, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($chs, CURLOPT_HEADER, 0);
        $outputs = curl_exec($chs);
        $rubl = json_decode($outputs);
        foreach ($rubl as $keyrub => $valuerub) {
            $rub = $keyrub;
            $rubvalue = $valuerub;
            Currency::where('code', $rub)->update([
                'rate' => $rubvalue,
            ]);
        }
        $rub_currency = Currency::where('code', $rub)->first();
        if ($rub_currency->rate != $rubvalue) {
            Currency::where('code', $rub)->update([
                'rate' => $rubvalue,
            ]);
        }
    }
}

