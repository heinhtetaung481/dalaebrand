<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itemtype extends Model
{
    protected $guarded = ['id'];

    public function items(){
        return $this->hasMany('App\Item');
    }
}
