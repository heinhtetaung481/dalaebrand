<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderitem extends Model
{
	protected $guarded = ['id'];
	
    public function order(){
    	return $this->belongsTo('App\Order');
    }

    public function item(){
    	return $this->belongsTo('App\Item');
    }

    public function design(){
    	return $this->belongsTo('App\Design');
    }
}
