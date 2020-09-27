<?php


namespace App\Http\Models\Category;


use App\ModelsDB\Category;

class CategoryCreate
{
    public static function getNewBranch($array)
    {
        $lastId = null;
        foreach($array['body'] as $value){
            if(!empty($value['text'])) {
               Category::create(array(
                    'title' => $value['text'],
                    'alias' => mb_strtolower($value['text']),
                    'parent_id' => $lastId
                ));
                $lastId = Category::where('title', $value['text'])->first()->id;
            }
        }
    }
}
