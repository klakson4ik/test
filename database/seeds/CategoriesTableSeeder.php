<?php

use App\ModelsDB\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/data/';
        $jsonBase =['LT.json', 'mobile.json', 'PC.json', 'TV.json'];
        foreach ($jsonBase as $value){
            $json = file_get_contents($path . $value);
            $data = json_decode($json, true);
//            var_dump($data);
            foreach($data['Products'] as $obj){

                $parent_id = null;
                foreach($obj as $key=>$cat)
                {
                    if(preg_match('#^cat[0-9]?#', $key))
                    {
                        $exists = Category::where('title', '=', $cat)->exists();
                        if (!$exists && is_null($parent_id) )
                        {
                            $alias = str_replace(' ', '-',mb_strtolower($cat));
                            Category::create(array(
                                'title' => $cat,
                                'alias' => $alias,
                                'parent_id' => null
                            ));
                            $parent_id = Category::where('title', '=', $cat)->first()->id;

                        }elseif(!$exists)
                        {
                            $alias = str_replace(' ', '-',mb_strtolower($cat));
                            Category::create(array(
                                'title' => $cat,
                                'alias' => $alias,
                                'parent_id' => $parent_id
                            ));
                            $parent_id = Category::where('title', '=', $cat)->first()->id;
                        }else{
                            $parent_id = Category::where('title', '=', $cat)->first()->id;
                        }
                    }

                }

            }

        }
    }
}
