<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'user_id', 'street', 'number', 'city', 'postalcode', 'country', 'postbox'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
