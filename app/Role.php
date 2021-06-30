<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    //
   /* use SoftDeletes;*/
    protected $fillable = [
        'name'
    ];

    //Relatie leggen met de users
    public function users(){
        return $this->belongsToMany('App\User', 'user_role');
    }

   /* public function user(){
        return $this->belongsTo('App\User');
    }*/

}
