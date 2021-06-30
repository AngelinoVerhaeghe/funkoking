<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    protected $fillable = [
        'name', 'slug'
    ];

    public function products(){
        return $this->hasMany('App\Product');
    }

    public function photos(){
        return $this->belongsToMany('App\Photo');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
