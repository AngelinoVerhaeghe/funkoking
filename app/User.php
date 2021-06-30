<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'photo_id', 'name', 'email', 'password', 'address_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relatie tussen User en Role -> 1 User kan meerdere roles hebben
    public function roles(){
        return $this->belongsToMany('App\Role', 'user_role')->withTimestamps();
    }
    //Relatie tussen User en Address -> 1 User kan meerdere adressen hebben
    public function address(){
        return $this->belongsTo('App\Address');
    }

    public function orders(){
        return $this->belongsToMany('App\Order');
    }

    public function contact(){
        return $this->belongsTo('App\Contact');
    }


    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    public function blogs(){
        return $this->belongsToMany('App\Blog');
    }

   /* public function wishlist(){
        return $this->belongsTo('App\Wishlist');
    }*/

    /**Controleren of de user wel degelijk Admin is.**/
    public function isAdmin(){
        /**Heeft deze user de role van Administrator en is deze user Status Active?**/
        foreach ($this->roles as $role){
            if ($role->name == 'Administrator' && $this->deleted_at == NULL){
                return true;
            }
        }
        return false;
    }
}

