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
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){

    	$pendingOrdersCount = Order::where('status','=','pending')->get()->count();

    	$itemsCount = Item::get()->count();

    	$salesCount = Orderitem::query()->join('orders','orders.id','=','orderitems.order_id')
    		->where('orders.status','!=','pending')
    		->sum('orderitems.quantity');

    	$customersCount = Customer::get()->count();

    	$leastItems = Item::where('quantity','<','10')->orderBy('quantity','ASC')->get();

    	$latestOrders = Order::orderBy('created_at','desc')->limit(5)->get();

    	$popularItems = Orderitem::query()
    		->join('items', 'items.id','=','orderitems.item_id')
    		->join('itemtypes','itemtypes.id','=','items.itemtype_id')
	    	->groupBy('orderitems.item_id')
	    	->selectRaw('itemtypes.gender,itemtypes.type,items.color,items.size,sum(orderitems.quantity) as quantity')
	    	->orderBy('quantity','DESC')
	    	->limit(5)
	    	->get();

    	return view('dashboard.index',compact('pendingOrdersCount','itemsCount','salesCount','customersCount','leastItems','latestOrders','popularItems'));
    }
}
