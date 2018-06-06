<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Item;
use App\Itemtype;

class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // return $dataTable->render('stock.home');
        $items = Item::get();
        $itemtypes = Itemtype::get();
        return view('stock.home',compact('items','itemtypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'size' => 'required|numeric',
            'color' => 'required',
            'quantity' => 'required|numeric',
            'type' => 'required'

        ]);

        $item = Item::where([['size', $request->size],['color', $request->color],['itemtype_id', $request->type]])->get();

        if (count($item)) {
            
            return redirect()->back()->withErrors(array('message' => 'This item is already added. Please try to edit the item'));

        }else{
            Item::create([

                'size' => $request->size,
                'color' => $request->color,
                'quantity' => $request->quantity,
                'itemtype_id' => $request->type,

            ]);

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
 
        $item = DB::table('itemtypes')
                    ->join('items', 'items.itemtype_id','=','itemtypes.id')
                    ->select('items.id','items.color','items.size','items.quantity','itemtypes.gender','itemtypes.type','itemtypes.name')
                    ->where('items.id','=',$id)
                    ->get();

        return response()->json($item); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'quantity' => 'required|numeric'
        ]);
        
        $item = Item::find($id);

        $item->quantity = request('quantity');
        $item->save();


        $items = Item::get();

        return redirect('/stock');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $item = Item::find($id);
        $orderitems = $item->orderitems;

            foreach($orderitems as $orderitem){
                $orderitem->delete();
            }

        $item->delete();
        return redirect()->back();
    }
}
