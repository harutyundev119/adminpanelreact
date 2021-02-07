<?php


namespace App\Services;

use App\Currency;

class CurrencyConversion
{
    protected static $container;

    public static function loadContainer() {
        if (is_null(self::$container)) {
            $currencies = Currency::get();
            foreach ($currencies as $currency) {
                self::$container[$currency->code] = $currency;
            }
        }
    }

    public static function getCurrencies()
    {
        self::loadContainer();
        return self::$container;
    }

    public static function convert($sum, $originCurrencyCode = 'AMD', $targetCurrencyCode = null) {
        self::loadContainer();
        $originCurrency = self::$container[$originCurrencyCode];
        if(is_null($targetCurrencyCode)) {
            $targetCurrencyCode = session('currency', 'AMD');
        }
        $targetCurrency = self::$container[$targetCurrencyCode];

        return $sum * $originCurrency->rate / $targetCurrency->rate;
    }
    public static function getCurrencySymbol() {
        self::loadContainer();
        $currencyFromSession = session('currency', 'AMD');

        $currency = self::$container[$currencyFromSession];
        return $currency->code;
    }
}
