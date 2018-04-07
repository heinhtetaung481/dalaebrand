<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
	protected $guarded = ['id'];
	
    public function Orderitems(){
    	return $this->hasMany('App\Orderitem');
    }
}
