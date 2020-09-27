<?php


namespace App\Http\Controllers\Widgets;


use App\Http\Models\Currency\CurrencyCookie;
use App\ModelsDB\Currency;
use Illuminate\Http\Request;

class CurrencyWidgetController
{
    public static function getCurrency(Request $request){
        $curr = $request->get('curr');
        if(preg_match('#^[A-Z]{3}$#', $curr)){
            if(Currency::where('charCode', $curr)->first()){
                setcookie('Currency', $curr , time()+3600*24*7);
            }
        }
    }
}
