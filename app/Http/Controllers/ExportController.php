<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Exports\ItemsExport;
use App\Exports\OrdersExport;
use App\Exports\OrderItemsExport;

class ExportController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	 public function items() {

	    return Excel::download(new ItemsExport, 'items.xlsx');
	}

	public function orders(){

        return Excel::download(new OrdersExport, 'orders.xlsx');
    }

    public function orderitems(){

    	return Excel::download(new OrderitemsExport, 'Orderitems.xlsx');
    }
}
