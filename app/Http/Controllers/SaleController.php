<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            $return_data = array();
            $data = Sale::all();
            foreach($data as $d){
                $return_data['data'][] = array(
                    'id' => $d->sales_id,
                    'to_user' => $d->sold_to_user_name,
                    'sold_quantity' => $d->sold_quantity,
                    'product'=> Product::where('product_id',$d->product_id)->get()[0]['product_name'],
                    'amount' => $d->sold_amount,
                    'action' => '<button class="btn btn-sm btn-outline-success editBtn m-4" data-id="'.$d->sales_id.'" data-toggle="modal" data-target="#sales_modal"><i class="fas fa-edit" style="color:green;"></i></button><a class="btn btn-sm btn-outline-danger deleteBtn" href="'.route('sale.delete',array('id'=>$d->sales_id)).'"><i class="fas fa-trash-alt" style="color:red;"></i></a>',
                );
            }
            echo json_encode($return_data);
            exit;
        }
        $data = Product::all();
        $users = User::where('role',0)->get();
        return view('sale.index',['product' => $data, 'users' => $users]);
    }

    public function add(Request $request){

        if($request->ajax() && $request->isMethod('GET')){

            $sales_id = '';
            $buyer_data = $request->input('buyer_data');
            $buyer_data = explode(',',$buyer_data);
            $sales['sold_to_user_id'] = intval($buyer_data[0]);
            $sales['sold_to_user_name'] = $buyer_data[1];
            $sales['sold_quantity'] = intval($request->input('sold_quantity'));
            $sales['sold_amount'] = intval($request->input('sold_amount'));
            $sales['product_id'] = intval($request->input('product_id'));
            if($request->input('sales_id') && ($request->input('sales_id') != '')){
                $sales_id = intval($request->input('sales_id'));
            }


            if(isset($sales_id) && $sales_id != ''){
                $sales['updated_at'] = date('Y-m-d H:i:s');
                $res = Sale::where('sales_id',$sales_id)->update($sales);
            }else{
                $sales['created_at'] = date('Y-m-d H:i:s');
                $sales['updated_at'] = date('Y-m-d H:i:s');
                $res = Sale::insert($sales);

            }
            if($res){
                    echo json_encode(array('status'=>200,'message'=>'Category updated successfully.'));
            }else{
                    echo json_encode(array('status'=>400,'message'=>'Unable to update Category.'));
            }

            exit;
        }
    }

    public function find(Request $request){
        if($request->ajax() && $request->isMethod('GET')){
            $sales_id = $request->input('sales_id');
            $sales = Sale::where('sales_id',$sales_id)->get()[0];
            if($sales){
                echo json_encode(array('status'=>200,'data'=>$sales));
            }else{
                echo json_encode(array('status'=>400,'message'=>'Unable to find Category'));
            }
            exit;
        }
    }

    public function delete($id){

        $id = intval($id);
        $del = Sale::where('sales_id',$id);
        if($del){
            if(Sale::where('sub_category_id',$id)->delete()){
                return back()->with('success','Successfully deleted Category');
            }else{
                return back()->with('error','Unable to delete category');
            }
        }else{
            return back()->with('error','Category not found.');
        }

    }
}
