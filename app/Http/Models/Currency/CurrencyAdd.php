<?php


namespace App\Http\Models\Currency;


use App\ModelsDB\Currency;

class CurrencyAdd
{
    public static function addCategories($array){
        foreach ($array as $value){
            if(Currency::where('charCode', '=', $value->CharCode)->first()){
                return false;
            }
            Currency::create([
                'numCode' => $value->NumCode,
                'charCode' => $value->CharCode,
                'name' => $value->Name,
                'value' => $value->Value,
                'previous'  => $value->Previous
            ]);
        }

    }
}
