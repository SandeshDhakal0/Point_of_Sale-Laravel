<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $role_list = array('user','admin','employee');
        if($request->ajax()){
            $return_data = array();
            $data = User::all();
            foreach($data as $d){
                if($d->id != 1){
                    $return_data['data'][] = array(
                        'id' => $d->id,
                        'name' => $d->name,
                        'email'=> $d->email,
                        'role'=> $role_list[$d->role],
                        'action' => '<button class="btn btn-sm btn-outline-success editBtn m-4" data-id="'.$d->id.'" data-toggle="modal" data-target="#user_modal"><i class="fas fa-edit" style="color:green;"></i></button><a class="btn btn-sm btn-outline-danger deleteBtn" href="'.route('users.delete',array('id'=>$d->id)).'"><i class="fas fa-trash-alt" style="color:red;"></i></a>',
                    );
                }

            }
            echo json_encode($return_data);
            exit;
        }

        return view('users.index');
    }

    public function add(Request $request){
        if($request->ajax() && $request->isMethod('GET')){

            $user_id = '';
            $catData['name'] = $request->input('name');
            $catData['role'] = intval($request->input('role'));
            $catData['email'] = $request->input('email');
            $repass = $request->input('re-pass');
            if($repass != $request->input('password')){
                echo json_encode(array('status'=>400,'message'=>'Password Mismatched'));
                exit;
            }
            $catData['password'] = Hash::make($request->input('password'));
            if($request->input('id') && ($request->input('id') != '')){
                $user_id = intval($request->input('id'));
            }

            if(isset($user_id) && $user_id != ''){
                $catData['updated_at'] = date('Y-m-d H:i:s');
                $res = User::where('id',$user_id)->update($catData);
            }else{
                $catData['created_at'] = date('Y-m-d H:i:s');
                $catData['updated_at'] = date('Y-m-d H:i:s');
                $res = User::insert($catData);

            }
            if($res){
                    echo json_encode(array('status'=>200,'message'=>'user updated successfully.'));
            }else{
                    echo json_encode(array('status'=>400,'message'=>'Unable to update User.'));
            }
            exit;
        }
    }

    public function find(Request $request){
        if($request->ajax() && $request->isMethod('GET')){
            $employee_id = $request->input('id');
            $catData = User::where('id',$employee_id)->get()[0];
            if($catData){
                echo json_encode(array('status'=>200,'data'=>$catData));
            }else{
                echo json_encode(array('status'=>400,'message'=>'Unable to find User'));
            }
            exit;
        }
    }

    public function delete($id){

        $id = intval($id);
        $cat = User::where('id',$id)->get()[0];
        if($cat){
            if(User::where('id',$id)->delete()){
                return back()->with('success','Successfully deleted User');
            }else{
                return back()->with('error','Unable to delete user');
            }
        }else{
            return back()->with('error','User not found.');
        }

    }
}
