<?php


namespace App\Http\Models\Currency;
use App\ModelsDB\Currency;

class CurrencyModel
{
    public static function getAllCurrency(){
        $currencyCache =  CurrencyCache::getCurrency();
        $currencyArr = [];

        foreach ($currencyCache->Valute as $curr){
            $currencyArr[] = $curr;
        }

        return $currencyArr;
    }

    public static function getChangeCurrency($dataArray)
    {
        $changeArray = [];
        $currencyCache =  CurrencyCache::getCurrency();
        foreach ($dataArray as $curr){
            foreach ($currencyCache->Valute as $value ){
                if($curr == $value->CharCode){
                    $changeArray[] = $value;
                }
            }
        }
        return $changeArray;
    }

    public static function updateCurrency($curr){
        $currencyCache = CurrencyCache::getCurrency()->Valute;
        return $currencyCache->$curr;

    }
	
	 public static function getCurrency($curr){
        $currency = Currency::where('charCode', $curr)->first();
		  return $currency;
	 }
}
