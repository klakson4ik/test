<?php

namespace App\ModelsDB;

use Illuminate\Database\Eloquent\Model;

class LargeTechnical extends Model
{
    protected $fillable = ['title', 'alias', 'price', 'quantity', 'description', 'brand'];


    public function categories()
    {
        return $this->belongsToMany('App\ModelsDB\Category');
    }
}
