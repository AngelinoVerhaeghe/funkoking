<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //
    protected $fillable = [
        'photo_id', 'product_id', 'quantity'
    ];

    public function orders(){
        return $this->belongsToMany('App\Order');
    }

    public function photo(){
        return $this->belongsTo(Photo::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
