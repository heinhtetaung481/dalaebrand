<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \PDF;
use App\Order;

class PdfexportController extends Controller
{
    public function order($id){

    	$order = Order::find($id);

    	$pdf = PDF::loadView('pdf.order', compact('order'));
		return $pdf->download('order-'.$id.'.pdf');
    }
}
