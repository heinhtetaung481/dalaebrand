<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Item;
use App\Orderitem;
use App\Customer;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){

    	$pendingOrdersCount = Order::where('status','=','pending')->get()->count();

    	$itemsCount = Item::get()->count();

    	$salesCount = Orderitem::query()->join('orders','orders.id','=','orderitems.order_id')
    		->where('orders.status','!=','pending')
    		->sum('orderitems.quantity');

    	$customersCount = Customer::get()->count();

    	$leastItems = Item::where('quantity','<','10')->get();

    	$latestOrders = Order::orderBy('created_at','desc')->limit(5)->get();

    	return view('dashboard.index',compact('pendingOrdersCount','itemsCount','salesCount','customersCount','leastItems','latestOrders'));
    }
}
