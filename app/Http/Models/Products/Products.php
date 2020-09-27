<?php

namespace App\Http\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\ModelsDB\Category;
use App\Http\Models\Category\CategoryNesting;

class Products extends Model
{
	private static $tableArray = ['computers' => 'компьютерная-техника', 'large_technicals' => 'крупная-бытовая-техника', 'mobiles' => 'мобильные-и-связь', 'televisions' => 'тв-и-видеотехника'];

	public static function getArrayProducts($requestUri){
		$array = [];
		$requestUri = mb_strtolower($requestUri);
		if($requestUri == '/products' || $requestUri == '/')
		{
  			foreach (self::$tableArray as $key=>$table){
   			$dataDB = DB::select("SELECT id,title,alias,price,quantity,description,brand FROM `$key`");
			}
		}
		else
		{
			$dataDB = self::getArraySubArray($requestUri);
		}	  
		foreach($dataDB as $product){
			$array[] = $product;
		}
		return $array;
	}

	public static function getArraySubArray($requestUri)
	{
		$dataDB = [];
		$uri = explode('/', $requestUri);
	#	dd($uri);
		$url = urldecode($uri[1]);
		if(in_array($url, self::$tableArray))
		{
			$DBName = array_search($url, self::$tableArray);
			if( 2 == count($uri))
			{
				$dataDB = DB::select("SELECT id,title,alias,price,quantity,description,brand FROM `$DBName`");
			}else
			{
				$alias = urldecode($uri[count($uri) - 1]);
				$catID = Category::where('alias', $alias)->first()->id;
				$IDItems = CategoryNesting::getIDsTree($catID);
				$array = implode(',', $IDItems);	
				$catRel = 'category_' . substr($DBName, 0, -1);
				$relID = $catRel . '.' . substr($DBName, 0, -1) . '_id';
				$sql = ("SELECT id, title, alias, price, quantity, description, brand
							 FROM `$DBName` 
							 INNER JOIN $catRel ON $DBName.id = $relID
							 WHERE $catRel.category_id IN ($array) 
							 ");

				$dataDB = DB::select($sql);
			}
		}
		return $dataDB;
	}	  
}
