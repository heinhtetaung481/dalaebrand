<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Order;
use App\Item;
use App\Customer;
use App\Itemtype;

class DatatablesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function orderData(){

    	$orders = Order::get();

    	return Datatables::of($orders)
    		->addColumn('button', function($order) {

                $detail = '<button class="btn btn-warning" onclick="orderDetail('.$order->id.')">Details</button>';

                $edit = '';

                if ($order->status == "pending" || $order->status == "confirm") {

                   $edit = '<a href="/order/'. $order->id .'/edit" class="btn btn-info">Edit</a>';

                }

                $delete = '<form action="/order/'.$order->id.'" method="post" style="display:inline;">

                                                <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>';

    			return $detail." ".$edit.$delete;

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

    public function stockData(){

        $stocks = Item::get();

        return Datatables::of($stocks)

            ->addColumn('button', function($stock) {

                $edit = '<button onclick="stockEdit('.$stock->id.')" class="btn btn-info">Edit</button>';

                $delete = '<form action="/stock/'.$stock->id.'" method="post" style="display:inline;" onsubmit="return confirmDelete()">

                                                <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger" >Delete</button>
                                        </form>';

                return $edit.$delete;


            })
            ->addColumn('type', function($stock) {

                return $stock->itemtype->gender .' '. $stock->itemtype->type;
            })
            ->rawColumns(['button'])
            ->make(true);



    }

    public function customerData(){

        $customers = Customer::get();

        return Datatables::of($customers)->make(true);
    }

    public function itemtypeData(){

        $itemtypes = Itemtype::get();

        return Datatables::of($itemtypes)
            ->addColumn('button', function($itemtype) {

                    $delete = '<form action="/itemtype/'.$itemtype->id.'" method="post" style="display:inline;" onsubmit="return confirmDelete()">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger" >Delete</button>
                                            </form>';

                    return $delete;


                })
            ->rawColumns(['button'])
            ->make(true);
    }
}
