<?php

use App\ModelsDB\Mobile;
use Illuminate\Database\Seeder;

class MobilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents('database/data/mobile.json');
        $data = json_decode($json, true);

        foreach ($data['Products'] as $obj){
            if(!(Mobile::where('title', '=', $obj['title'])->exists())){

                preg_match_all('#[\w0-9]+#', $obj['title'], $matches);
                $arrWord = [];
                foreach ($matches[0] as $word ){
                    $arrWord[] = mb_strtolower($word);
                }
                $alias = implode('-', $arrWord);

                Mobile::create(array(
                    'title' => $obj['title'],
                    'alias' => $alias,
                    'price' =>  isset($obj['price']) ? (int)$obj['price'] : 0,
                    'quantity' =>  isset($obj['quantity']) ? (int)$obj['quantity'] : 0,
                    'description' => isset($obj['description']) ? $obj['description'] : null,
                    'brand' => isset($obj['brand']) ? $obj['brand'] : null
                ));
            }else{
                continue;
            };

        }
    }
}
