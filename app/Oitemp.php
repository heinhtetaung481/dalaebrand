<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oitemp extends Model
{
    protected $guarded = ['id'];

    public function item(){
    	return $this->belongsTo('App\Item');
    }

    public function design(){
    	return $this->belongsTo('App\Design');
    }
}
