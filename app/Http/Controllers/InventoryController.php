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
        $inventory = Inventory::latest()->paginate(5);
        // $inventory = Inventory::withTrashed()->find($inventory);
        // dd($inventory);
        if($request->has('view_deleted'))
        {
            $inventory = Inventory::onlyTrashed()->get();
        }
        return view('admin.inventory',compact('inventory'));
        // ->with('i',(request()->input('page',1)-1)*5);
        // ->with('inventory',$inventory);
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
    public function show(Inventory $inventory )
    {
        // $inventory = Inventory::find($id);
        return view('admin.inventory',compact('inventory'));
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

    public function search(Request $request)
    {
        //Get the search value from the input
        $search = $request->input('search');
        //Search in the table
        $inventory = Inventory::query()->where('product_name','LIKE',"%{$search}%")->orWhere('product_code','LIKE',"%{$search}%")->get();
        // if(request('search')){
        //     $inventory = Inventory::where('name','like','%'.request('search').'%')->get();

        // } else {
        //     $inventory = Inventory::all();
        // }
        // $search_text = $_GET('query');
        // $inventory = Inventory::where('title','LIKE','%'.$search_text.'%')->get();

        // $inventory = Inventory::where([
        //     ['product_name', '!=',Null ]
        //     [function($query) use ]
        // ]);

        return view('admin/search',compact('inventory'));
    }
}
