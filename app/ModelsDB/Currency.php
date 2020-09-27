<?php

namespace App\ModelsDB;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = ['numCode', 'charCode', 'name', 'value', 'previous'];
}
