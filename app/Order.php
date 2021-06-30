<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    //
    protected $fillable = [
        'user_id', 'product_id', 'quantity', 'photo', 'total_price', 'payment_token'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function stocks(){
        return $this->belongsToMany('App\Stock');
    }

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function photo(){
        return $this->belongsTo('App\Photo');
    }

}
