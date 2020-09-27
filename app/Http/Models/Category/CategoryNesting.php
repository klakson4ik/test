<?php


namespace App\Http\Models\Category;


use App\ModelsDB\Category;

class CategoryNesting
{
	 private static $idArray = [];

    public static function getTree()
    {
        $tree = [];
        $data = Category::all()->toArray();
        foreach ($data as $id=>&$node) {
            if (empty($node['parent_id']))
                $tree[$id] = &$node;
            else
                $data[$node['parent_id'] - 1]['children'][$id] = &$node;
        }
        return $tree;
    }
	 public static function getIDsTree($id)
	 {
			$tree = self::getTree();

			self::getBranch($tree, $id);
			return self::$idArray;
	 }

	 private static function getBranch($branch, $id)
	 {
			foreach($branch as $value)
			{	
				if($value['id'] != $id)
				{
					if(isset($value['children']))
					{	
						self::getBranch($value['children'], $id);	  		
					}
				}
				else
				{
					if(isset($value['children']))
						self::isId($value['children']);			
					else
						self::$idArray[] = $value['id'];	  
				}	
			}
	 }

	 private static function isId($branch)
	 {
			foreach($branch as $value)
			{
				if(isset($value['children']))
				{
					self::isId($value['children']);
				}
				else
				{

					if(isset($value['children']))
						self::isId($value['children']);			
					else
						self::$idArray[] = $value['id'];	  
				}
			}
	 }
}
