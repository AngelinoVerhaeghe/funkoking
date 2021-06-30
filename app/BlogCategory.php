<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    //
   /* use SoftDeletes;*/
    protected $fillable = [
        'name', 'slug'
    ];

    public function blogs(){
        return $this->belongsToMany('App\Blog');
    }

}
