<?php

namespace App\Http\Controllers;

use App\Models\WholesalePurchaseRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class WholesalePurchase extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $return_data = array();
            $data = WholesalePurchaseRecord::all();
            $index = 1;
            foreach($data as $d){
                $return_data['data'][] = array(
                    's_no' => $index,
                    'bill_no' => $d->bill_no,
                    'vat_no' => $d->vat_no,
                    'vendor_name' => $d->vendor_name,
                    'invoice_date' => $d->invoice_date,
                    'amount' => $d->amount,
                    'amount_with_vat' => $d->amount_with_vat,
                    'action' => '<button class="btn btn-sm btn-outline-success editBtn m-4" data-id="'.$d->id.'" data-toggle="modal" data-target="#category_model"><i class="fas fa-edit" style="color:green;"></i></button><a class="btn btn-sm btn-outline-danger deleteBtn" href="'.route('wholesale.delete',array('id'=>$d->id)).'"><i class="fas fa-trash-alt" style="color:red;"></i></a>',
                );
                $index++;
            }
            if(count($return_data) > 0){
                echo json_encode($return_data);
            }
            exit;
        }
        return view('wholesale.index');
    }

    public function add(Request $request){

        if($request->ajax() && $request->isMethod('GET')){
            $id = '';
            if($request->input('id') && ($request->input('id') != '')){
                $id = $request->input('id');
            }
            $wholesale = array();
            $wholesale['invoice_date'] = $request->input('invoice_date');
            $wholesale['vendor_name'] = $request->input('vendor_name');
            $wholesale['bill_no'] = $request->input('bill_no');
            $wholesale['vat_no'] = $request->input('vat_no');
            $wholesale['amount'] = $request->input('amount');
            $wholesale['amount_with_vat'] = $request->input('amount_with_vat');

            if(isset($id) && $id != ''){
                $res = WholesalePurchaseRecord::where('id',$id)->update($wholesale);
            }else{
                $res = WholesalePurchaseRecord::insert($wholesale);
            }
            if($res){
                    echo json_encode(array('status'=>200,'message'=>'Wholesale purchase record updated successfully.'));
            }else{
                    echo json_encode(array('status'=>400,'message'=>'Unable to update Wholesale purchase record .'));
            }
            exit;
        }
    }

    public function find(Request $request){
        if($request->ajax() && $request->isMethod('GET')){
            $id = $request->input('id');
            $catData = WholesalePurchaseRecord::where('id',$id)->get()[0];
            if($catData){
                echo json_encode(array('status'=>200,'data'=>$catData));
            }else{
                echo json_encode(array('status'=>400,'message'=>'Unable to find Category'));
            }
            exit;
        }
    }

    public function delete($id){

        $id = intval($id);
        $cat = WholesalePurchaseRecord::where('id',$id)->get()[0];
        // if($cat->subcategory){
        //     return back()->with('error','Please delete it\'s subcategory first');
        // }
        if($cat){
            if(WholesalePurchaseRecord::where('id',$id)->delete()){
                return back()->with('success','Successfully deleted Category');
            }else{
                return back()->with('error','Unable to delete category');
            }
        }else{
            return back()->with('error','Category not found.');
        }

    }
}
