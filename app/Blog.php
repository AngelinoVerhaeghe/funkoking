<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    //
   /* use SoftDeletes;*/
    protected $fillable = [
        'blog_category_id', 'user_id', 'title', 'slug', 'description', 'photo_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    public function blogCategory(){
        return $this->belongsTo('App\BlogCategory');
    }
}


