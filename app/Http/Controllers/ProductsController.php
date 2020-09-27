<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Products\Products;
use App\Http\Models\Vendor\Pagination;
use App\Http\Models\Currency\CurrencyModel;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		 if(isset($_GET['curr']))	
			 $curr = $_GET['curr'];
		 else			  
			 $curr = isset($_COOKIE['Currency']) ? $_COOKIE['Currency'] : 'EUR';
		 $currency = CurrencyModel::getCurrency($curr);
		 $requestUri = \Request::path();	        //
		 $page = $request->get('page');
       $arrayProducts = Products :: getArrayProducts($requestUri);
		 $paginationClass = new Pagination($arrayProducts, $page, 10);
		 $sliceProducts = $paginationClass->getSliceArray();
		 $pagination = $paginationClass->getPaginationData();
		 return response()->view('pages.products.index',[
					'products' => $sliceProducts,
					'pagination' => $pagination,
					'currency' => $currency,
           ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
