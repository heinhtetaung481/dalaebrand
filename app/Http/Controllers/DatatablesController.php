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

    			return '<button class="btn btn-warning" onclick="orderDetail('.$order->id.')">Details</button> <button class="btn btn-warning" onclick="orderDetail('.$order->id.')">Details</button> <button class="btn btn-warning" onclick="orderDetail('.$order->id.')">Details</button>';
    			})
    		->addColumn('customer_name', function($order) {

    			return $order->customer->name;

    			})
            ->addColumn('customer_phone', function($order) {
                return $order->customer->phone;
            })
            ->addColumn('customer_address', function($order) {
                return $order->customer->address;
            })
            ->editColumn('orderdate', function ($order) {
                return $order->orderdate->format('d/m/Y');
            })
    		->rawColumns(['button'])
    		->make(true);
    }
}
