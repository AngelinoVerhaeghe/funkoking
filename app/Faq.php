<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'faq_category_id', 'question', 'answer'
    ];

    public function faqCategory(){
        return $this->belongsTo('App\FaqCategory');
    }

}
