<?php

namespace App\Http\Controllers;

use App\Http\Models\Currency\CurrencyAdd;
use App\Http\Models\Currency\CurrencyModel;
use App\ModelsDB\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
	public function __construct() 
	{
  		$this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('pages.currency.index', [
            'currencies' => Currency::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $CurrencyAll = CurrencyModel::getAllCurrency();

        return response()->json([
            'currencyAll' => $CurrencyAll,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currencyChange = CurrencyModel::getChangeCurrency($request->post()['body']);
        if(!empty($currencyChange)){
            CurrencyAdd::addCategories($currencyChange);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $body = $request['body'];
        $updateCurr = CurrencyModel::updateCurrency($body);
        return response()->json($updateCurr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();
    }
}
