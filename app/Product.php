<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    protected function section()
    {

        return $this->belongsTo('App\sections');
    }
}
