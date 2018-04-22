<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Orderitem;
use App\Order;
use App\Item;
use App\Itemtype;
use App\Customer;
use App\Oitemp;
use App\Design;


class OrderItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::get();

        return view('order.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Oitemp::truncate();

        $designs = Design::get();

        return view('order.create', compact('designs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $cusLastInsertedId = Customer::create([
            'name' => $request->cusName,
            'phone' => $request->cusPhone,
            'address' => $request->cusAddress,
            'email' => $request->cusEmail,
        ]);

        $orderLastInsertedId = Order::create([
            'orderdate' => $request->date,
            'discount' => $request->discount,
            'remarks' => $request->remarks,
            'customer_id' => $cusLastInsertedId->id,
            'status' => "pending",
        ]);

        $oitemps = Oitemp::get();

        foreach ($oitemps as $oitemp) {
            
            Orderitem::create([

                'order_id' => $orderLastInsertedId->id,
                'price' => $oitemp->price,
                'item_id' => $oitemp->item_id,
                'quantity' => $oitemp->quantity,
                'remarks' => $oitemp->remarks,
                'design_id' => $oitemp->design_id,

                ]);
        }

        $orders = Order::get();

        return view('order.index', compact('orders'));
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $order = DB::table('orders')
                    ->join('customers', 'orders.customer_id','=','customers.id')
                    ->select('orders.id','orders.orderdate','customers.name','customers.phone','orders.status','customers.address','customers.email','orders.discount','orders.remarks')
                    ->where('orders.id','=',$id)
                    ->get();

        
        $items = DB::table('items')
                    ->join('itemtypes', 'itemtypes.id','=','items.itemtype_id')
                    ->join('orderitems','orderitems.item_id','=','items.id')
                    ->join('designs', 'orderitems.design_id', '=', 'designs.id')
                    ->select('items.size','items.color','orderitems.price','orderitems.quantity','designs.name as design_name','orderitems.remarks','itemtypes.type','itemtypes.gender')
                    ->where('orderitems.order_id','=',$id)
                    ->get();
        $orderitems = $order->merge($items);

        return response()->json($orderitems);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $order = Order::find($id);

        $designs = Design::get();

        Oitemp::truncate();

        $orderitems = $order->orderitems;

        foreach($orderitems as $orderitem) {
            
            Oitemp::create([
            'item_id' => $orderitem->item_id,
            'price' => $orderitem->price,
            'quantity' => $orderitem->quantity,
            'remarks' => $orderitem->remarks,
            'design_id' => $orderitem->design_id,
        ]);

        }

        $oitemps = Oitemp::get();


        return view('order.update', compact('order','oitemps','designs'));
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


        $order = Order::find($id);

        $order->orderdate = $request->date;

        $order->status = $request->status;

        $order->save();

        $customer = $order->customer;

        $customer->name = $request->cusName;

        $customer->phone = $request->cusPhone;

        $customer->address = $request->cusAddress;

        $customer->email = $request->cusEmail;

        $customer->save();

        Orderitem::where('order_id',$id)->delete();

        $oitemps = Oitemp::get();

        foreach ($oitemps as $oitemp) {
            
            Orderitem::create([

                'order_id' => $id,
                'item_id' => $oitemp->item_id,
                'price' => $oitemp->price,
                'quantity' => $oitemp->quantity,
                'design_id' => $oitemp->design_id,
                'remarks' => $oitemp->remarks,

                ]);
        }

        $orders = Order::get();

        return redirect('/order');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orderitems = Orderitem::where('order_id', $id)->get();

        foreach ($orderitems as $orderitem) {
            
            $item = Item::find($orderitem->item_id);

            $item->quantity = $item->quantity + $orderitem->quantity;

            $item->save();
        }

        Orderitem::where('order_id', $id)->delete();

        Order::find($id)->delete();

        return redirect()->back();
    }


    public function checkGender($gender){
        
        $itemtypes = Itemtype::where('gender','=', $gender)->get();

        return response()->json($itemtypes);
    }

    public function checkSize($itemType){

        

        $sizes = Item::where('itemtype_id', '=', $itemType)->get();

        return response()->json($sizes);
    }

    public function checkColor($itemtype,$size){

        

        $colors = Item::where([['itemtype_id', '=', $itemtype],['size','=',$size],])->get();


        return response()->json($colors);
    }
}
