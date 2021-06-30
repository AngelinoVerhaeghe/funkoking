<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    //
   /* use SoftDeletes;*/
    protected $fillable = [
        'name'
    ];

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
