<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    //
   /* use SoftDeletes;*/

    protected  $fillable = [
        'name', 'file'
    ];

    public function getFileAttribute($photo){
        return $this->uploads . $photo;
    }

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function blog(){
        return $this->belongsTo('App\Blog');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function review(){
        return $this->belongsTo('App\Review');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function order(){
        return $this->belongsTo('App\Order');
    }

}
