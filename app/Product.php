<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'category_id', 'photo_id', 'title', 'slug', 'price', 'subtitle', 'name', 'description', 'subcategory'

    ];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    public function subcategory(){
        return $this->belongsTo('App\SubCategory');
    }

    public function review(){
        return $this->belongsTo('App\Review');
    }

    public function stock(){
        return $this->belongsTo('App\Stock');
    }

    public function order(){
        return $this->belongsTo("App\Order");
    }

    public function getRouteKeyName(){
        return 'slug';
    }


}

