<?php

namespace App\ModelsDB;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['title', 'alias', 'parent_id'];

    public function mobiles()
    {
        return $this->belongsToMany('App\ModelsDB\Mobile');
    }

    public function largeTechnicals()
    {
        return $this->belongsToMany('App\ModelsDB\LargeTechnical');
    }

    public function computers()
    {
        return $this->belongsToMany('App\ModelsDB\Computer');
    }

    public function televisions()
    {
        return $this->belongsToMany('App\ModelsDB\Television');
    }


}
