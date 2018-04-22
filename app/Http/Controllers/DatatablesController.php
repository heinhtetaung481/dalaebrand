<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Order;

class DatatablesController extends Controller
{

    public function orderData(){

    	$orders = Order::get();

    	return Datatables::of($orders)->make(true);
    }
}
