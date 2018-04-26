<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Order;

class DatatablesController extends Controller
{

    public function orderData(){

    	$orders = Order::get();

    	return Datatables::of($orders)
    		->addColumn('button', function($order) { 

    			return '<button class="btn btn-warning" onclick="orderDetail('.$order->id.')">Details</button>';
    			})
    		->addColumn('customer', function($order) {

    			return $order->customer->name;

    			})
    		->rawColumns(['button'])
    		->make(true);
    }
}
