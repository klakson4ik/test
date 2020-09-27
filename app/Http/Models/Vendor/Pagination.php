<?php

namespace App\Http\Models\Vendor;

class Pagination
{
	private $perPage = 9;	
	private $array;
	private $currentPage = 1;
	private $items;
	private $countPage;
	private $countShowPage = 10;


	public function __construct($array, $page, $countShowPage){
		$this->currentPage = $page == 0 ? 1 : (int)$page;
		$this->array = $array;
		$this->items = count($array);
		$this->countPage = $this->getCountPage();
		$this->countShowPage = $this->countPage < $countShowPage ? $this->countPage : $countShowPage; 
	}

	public function getSliceArray(){
		$sliceArray= array_slice($this->array, ($this->currentPage - 1) * $this->perPage, $this->perPage);
		return $sliceArray;
	}
	
	public function getPaginationData(){
		$pagination = ['currentPage' => $this->currentPage, 'perPage' => $this->perPage, 'items' => $this->items, 'countPage' => $this->countPage, 'countShowPage' => $this->countShowPage]; 
	#	dd($pagination);
		return $pagination;
	}


	private function getCountPage(){
		return (int)ceil($this->items / $this->perPage);
	}

   private function getParams(){
       $url = $_SERVER['REQUEST_URI'];
       $url = explode('?', $url);
       $uri = $url[0] . '?';
       if(isset($url[1]) && $url[1] != ''){
           $params = explode('&', $url[1]);
           foreach($params as $param){
               if(!preg_match("#page=#", $param)) $uri .= "{$param}&amp;";
           }
       }
		 dd($uri);
       return $uri;
   }
}
