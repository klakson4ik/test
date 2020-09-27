<?php

namespace App\Http\Controllers;

use App\Http\Models\Category\CategoryNesting;
use App\Http\Models\Category\CategoryCreate;
use App\ModelsDB\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class CategoryController extends Controller
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
        $categoryNesting = CategoryNesting::getTree();

        return response()->view('pages.category.index', [
            'categories' => Category::get(),
            'categoryNesting' => $categoryNesting
        ]);



    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $array = $request->post();
        if(!empty($array)){
            CategoryCreate::getNewBranch( $array );
        }

        $categories = Category::all();

        return response()->json([
            'categories' => $categories
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ModelsDB\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ModelsDB\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ModelsDB\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $alias = str_replace(' ', '-',mb_strtolower($request['body']['title']));
        $body = $request['body'];
        $body['alias'] = $alias;
        $category->update($body);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ModelsDB\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
    }
}
