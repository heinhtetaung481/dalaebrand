<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = ['id'];

    public function itemtype(){
        return $this->belongsTo('App\Itemtype');
    }

    public function Orderitems(){
    	return $this->hasMany('App\Orderitem');
    }
}
