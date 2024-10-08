<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {


        $ret = array();
        $categories = Category::all();
        if($categories != null && !empty($categories)){
            foreach($categories as $cat){
                $ret['category'][] = $cat;

                $product = Product::where(['category_id'=>$cat->category_id])->get();
                if($product != null && !empty($product)){
                    $finalprod = array();
                    foreach($product as $p){
                        $finalprod[] = array(
                            'product_id' => $p->product_id,
                            'product_name' => $p->product_name,
                            'category_id' => $p->category_id,
                            'price' => $p->sales_price,
                            'prod_uniq' => $p->prod_uniq,
                            'images' => Image::where('product_id',$p->product_id)->get()
                        );
                    }
                    $finalprod['cat_id'] = $cat->category_id;
                    $ret['product'][] = $finalprod;
                }else{
                    $ret['product'] = array();
                }

            }
        }else{
            $ret['category'] = array();
            $ret['product'][] = array();
        }
        return view('user.dashboard')->with('response',$ret);
    }




    public function myprofile(Request $request){

        $role = array('user','admin','employee');
        $user_id = Auth::user()->id;

        if($request->isMethod('GET') && count($request->input()) > 0){
            $res = array();
            $res['name'] = $request->input('name');
            $res['email'] = $request->input('email');
            User::where('id',$user_id)->update($res);

            return redirect()->route('profile')->with('success', 'Successfully Changed User Profile !');

        }

        $users = User::where('id',$user_id)->get()[0];
        return view('profile')->with(array('user'=>$users,'role'=>$role));
    }


    public function changepass(Request $request){

        $user_id = Auth::user()->id;

        if($request->isMethod('GET') && count($request->input()) > 0){
            $res = array();
            if(Hash::check($request->input('old_pass'),Auth::user()->password)){
                $new_pass = $request->input('new_pass');
                $re_pass = $request->input('re_pass');
                if($new_pass == $re_pass){
                    $res['password'] = Hash::make($new_pass);
                    User::where('id',$user_id)->update($res);
                    Session::flush();

                    Auth::logout();

                    return redirect('login');
                }else{
                    return redirect()->route('password.change')->with('error', 'Password Mismatch');
                }
            }else{
                return redirect()->route('password.change')->with('error', 'Wrong Password');
            }


        }

        $users = User::where('id',$user_id)->get()[0];
        return view('changepass');

    }

    public function sales(Request $request){
        if($request->isMethod('POST')){
            if($request->input('_token') && $request->input('_token') != ''){
                $total_amt = $request->input('total_amt');
                $disc_amt = $request->input('disc_amt');
                $payable_amt = $total_amt - $disc_amt;

                $product_ids = explode(',',$request->input('product_ids'));
                $product_quantity = explode(',',$request->input('product_quantity'));
                $product_price = explode(',',$request->input('product_price'));
                $ids = array();
                $quantity = array();
                $amount = array();
                foreach($product_ids as $key => $id){
                    if(empty($ids)){
                        $ids[] = $id;
                        $quantity[] = (int) $product_quantity[$key];
                        $amount[] = (int) $product_price[$key];
                    }else{
                        if(in_array($id,$ids)){
                            $k = array_search($id,$ids);
                            $quantity[$k] += (int) $product_quantity[$key];
                            $amount[$k] += (int) $product_price[$key];
                        }else{
                            $ids[] = $id;
                            $quantity[] = (int) $product_quantity[$key];
                            $amount[] = (int) $product_price[$key];
                        }
                    }
                }
                foreach($ids as $key=>$id){
                    $res = Sale::create(array(
                        'sold_to_user_id' => Auth::user()->id,
                        'sold_to_user_name' => Auth::user()->name,
                        'sold_quantity' => $quantity[$key],
                        'sold_amount' => $amount[$key],
                        'product_id' => $id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ));
                    if(!$res){
                        dd('Something went wrong !!!');
                    }
                }

                return view('user.sales')->with('payable',$payable_amt);
            }
        }
        echo 'Invalid Credentials';die;

    }

    public function dailysales(Request $request){
        if($request->ajax()){
            $return_data = array();
            $data = Sale::orderBy('updated_at', 'desc')->get();

            foreach($data as $d){
                $return_data['data'][] = array(
                    'id' => $d->sales_id,
                    'to_user' => $d->sold_to_user_name,
                    'sold_quantity' => $d->sold_quantity,
                    'product'=> Product::where('product_id',$d->product_id)->get()[0]['product_name'],
                    'amount' => $d->sold_amount,
                );
            }
            echo json_encode($return_data);
            exit;
        }
        $data = Product::all();
        $users = User::where('role',0)->get();
        return view('user.dailysales',['product' => $data, 'users' => $users]);
    }

    public function getProduct(Request $request){
        if($request->ajax()){
            $prod_uniq = $request->input('prod_uniq');
            $product_detail = array();
            $product = Product::where('prod_uniq',$prod_uniq)->first();
            if($product != null){
                $product_detail = $product;
            }
            echo json_encode($product_detail);die;
        }
    }
}
