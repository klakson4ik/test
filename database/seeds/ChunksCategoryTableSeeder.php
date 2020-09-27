<?php

use App\ModelsDB\Category;
use Illuminate\Database\Seeder;

class ChunksCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/data/';
        $jsonBase =[1 => 'LT.json', 2 => 'mobile.json', 3 => 'PC.json', 4 => 'TV.json'];
        $models = [ 1 => 'LargeTechnical', 2 => 'Mobile', 3 => 'Computer', 4 => 'Television'];

        foreach ($jsonBase as $key=>$value)
        {
            $json = file_get_contents($path . $value);
            $data = json_decode($json, true);

            foreach ($data['Products'] as $obj)
            {
                $keys = array_keys($obj);
                $cat =  preg_grep('#^cat[0-9]?#', $keys);
                $endKey = end($cat);

                $temp = 'App\ModelsDB\\' .$models[$key];
                $class = new $temp();
                $value = $class::where('title', $obj['title'])->first()->id;
                $category = Category::where('title', $obj[$endKey])->first()->id;

                if(isset($value) && isset($category)){
                    $class::find($value)->categories()->sync($category);
                }
            }
        }
    }
}
