<?php

use App\ModelsDB\Television;
use Illuminate\Database\Seeder;

class TelevisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents('database/data/TV.json');
        $data = json_decode($json, true);

        foreach ($data['Products'] as $obj){
            if(!(Television::where('title', '=', $obj['title'])->exists())){

                preg_match_all('#[\w0-9]+#', $obj['title'], $matches);
                $arrWord = [];
                foreach ($matches[0] as $word ){
                    $arrWord[] = mb_strtolower($word);
                }
                $alias = implode('-', $arrWord);

                Television::create(array(
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
