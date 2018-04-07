<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $guarded = ['id'];

	protected $dates = ['orderdate'];
	
    public function orderitems(){
    	return $this->hasMany('App\Orderitem');
    }

    public function customer(){
    	return $this->belongsTo('App\Customer');
    }
}
