<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    //Hier zeggen tegen model dat er een andere primarykey is!
    protected $primaryKey = 'iso';
    //Standaard niet autonummeren
    public $incrementing = false;
    protected $fillable = [
        'iso'
    ]; //USD, EUR.....
}
