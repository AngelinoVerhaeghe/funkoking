<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaqCategory extends Model
{
    //
    /*use SoftDeletes;*/
    protected $fillable = [
        'name', 'slug'
    ];

    public function faqs(){
        return $this->belongsToMany('App\Faq');
    }
}
