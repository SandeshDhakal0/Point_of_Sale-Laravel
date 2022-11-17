<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inventory = Inventory::all();
        // $inventory = Inventory::withTrashed()->find($inventory);
        // dd($inventory);
        if($request->has('view_deleted'))
        {
            $inventory = Inventory::onlyTrashed()->get();
        }
        return view('admin.inventory')->with('inventory',$inventory);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('inventory.create');
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
            'product_code'=>'required',
            'product_name'=>'required',
            'tag_number'=>'required',
            'marked_price'=>'required',
            'quantity'=>'required'
        ]);
        Inventory::create($request->all());
        return redirect()->back()->with('success','Data inserted successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventory = Inventory::find($id);
        return view('admin.inventory',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $inventory = Inventory::all();
        $data = Inventory::find($id);
        return view('admin.inventory',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $update = [
            "product_code"=>$request->product_code,
            "product_name"=>$request->product_name,
            "tag_number"=>$request->tag_number,
            "marked_price"=>$request->marked_price,
            "quantity"=>$request->quantity
        ];
        Inventory::where('id',$request->product_id)->update($update);
        return redirect()->back()->with('success','The product is updated.');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        Inventory::where('id', $id)->delete();
        return redirect()->back()->with('success','The product is deleted.');
    }

    public function restore($id)
    {
        Inventory::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','The product is restored successfully.');
    }
}
