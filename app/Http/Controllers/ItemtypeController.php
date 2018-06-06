<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Itemtype;

class ItemtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('type.index');
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

            'name' => 'required',
            'type' => 'required',
            'gender' => 'required'

        ]);

        $itemtype = Itemtype::where([['name', $request->name],['type', $request->type],['gender', $request->gender]])->get();

        if (count($itemtype)) {
            
            return redirect()->back()->withErrors(array('message' => 'This item is already added.'));

        }else{
            Itemtype::create([

                'name' => $request->name,
                'type' => $request->type,
                'gender' => $request->gender

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itemtype = Itemtype::find($id);

        $items = $itemtype->items;

            foreach($items as $item){

                $item->delete();

                foreach($item->orderitems as $orderitem){

                    $orderitem->delete();
                }

            }

        $itemtype->delete();

        return redirect()->back();

    }
}
