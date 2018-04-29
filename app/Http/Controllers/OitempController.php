<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Oitemp;
use App\Item;

class OitempController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function destroy($id)
    {
    	$oitemp = Oitemp::find($id);

    	$item = Item::find($oitemp->item_id);

    	$item->quantity = $item->quantity + $oitemp->quantity;

    	$item->save();
    	
        Oitemp::find($id)->delete();

        $items = DB::table('items')
                    ->join('itemtypes', 'itemtypes.id','=','items.itemtype_id')
                    ->join('oitemps','oitemps.item_id','=','items.id')
                    ->join('designs', 'oitemps.design_id', '=', 'designs.id')
                    ->select('items.size','items.color','oitemps.price','oitemps.quantity','designs.name as design_name','oitemps.remarks','itemtypes.type','itemtypes.gender','oitemps.id')
                    ->get();


        return $items;
    }


    public function store(Request $request){

    	
    
    	$item = Item::where([['itemtype_id',$request->itemtype],['color',$request->color],['size', $request->size]])->first();

    	if ($request->quantity < $item->quantity) {


    		$item->quantity = $item->quantity - $request->quantity;

    		$item->save();
  

	    	if ($request->remarks && $request->design) {

	    		Oitemp::create([
	    		'item_id' => $item->id,
	    		'quantity' => $request->quantity,
	    		'price' => $request->price,
	    		'remarks' => $request->remarks,
	    		'design_id' => $request->design,

	    	]);

	    	}elseif ($request->remarks) {
	    		
	    		Oitemp::create([
	    		'item_id' => $item->id,
	    		'price' => $request->price,
	    		'quantity' => $request->quantity,
	    		'remarks' => $request->remarks,

	    	]);

	    	}elseif ($request->design) {

	    		Oitemp::create([

	    		'item_id' => $item->id,
	    		'price' => $request->price,
	    		'quantity' => $request->quantity,
	      		'design_id' => $request->design,
	      	]);

	    	}else{

	    	Oitemp::create([
	    	
	    		'item_id' => $item->id,
	    		'price' => $request->price,
	    		'quantity' => $request->quantity,
	    	]);

	    }

	    	$items = DB::table('items')
	                    ->join('itemtypes', 'itemtypes.id','=','items.itemtype_id')
	                    ->join('oitemps','oitemps.item_id','=','items.id')
	                    ->join('designs', 'oitemps.design_id', '=', 'designs.id')
	                    ->select('items.size','items.color','oitemps.price','oitemps.quantity','designs.name as design_name','oitemps.remarks','itemtypes.type','itemtypes.gender','oitemps.id')
	                    ->get();


	        return $items;
	    }else{


	    	return response()->json(['error' => 'There is no enough quantity']);
	    }

    }
}
