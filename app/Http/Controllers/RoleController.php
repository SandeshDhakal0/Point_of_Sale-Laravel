<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            $return_data = array();
            $data = Role::all();
            foreach($data as $d){
                $return_data['data'][] = array(
                    'role_id' => $d->role_id,
                    'role_name' => $d->role_name,
                    'action' => '<button class="btn btn-sm btn-outline-success editBtn m-4" data-role_name="'.$d->role_name.'" data-id="'.$d->role_id.'" data-toggle="modal" data-target="#role_modal"><i class="fas fa-edit" style="color:green;"></i></button><a class="btn btn-sm btn-outline-danger deleteBtn" href="'.route('role.delete',array('id'=>$d->role_id)).'"><i class="fas fa-trash-alt" style="color:red;"></i></a>',
                );
            }
                echo json_encode($return_data);
            exit;
        }
        return view('role.index');
    }

    public function add(Request $request){
        if($request->ajax() && $request->isMethod('GET')){
            $role_id = '';
            $roleData['role_name'] = $request->input('role_name');
            if($request->input('role_id') && ($request->input('role_id') != '')){
                $role_id = $request->input('role_id');
            }
            if(Role::where('role_name',$roleData['role_name'])->get()[0]){
                echo json_encode(array('status'=>400,'message'=>'Role already exists.'));
            }else{
                if(isset($role_id) && $role_id != ''){
                    $res = Role::where('role_id',$role_id)->update($roleData);
                }else{
                    $res = Role::insert($roleData);
                }
                if($res){
                        echo json_encode(array('status'=>200,'message'=>'Role updated successfully.'));
                }else{
                        echo json_encode(array('status'=>400,'message'=>'Unable to update Role.'));
                }
            }
            exit;
        }
    }

    public function find(Request $request){
        if($request->ajax() && $request->isMethod('GET')){
            $role_id = $request->input('role_id');
            $roleData = Role::where('role_id',$role_id);
            if($roleData){
                echo json_encode(array('status'=>400,'data'=>$roleData));
            }else{
                echo json_encode(array('status'=>400,'message'=>'Unable to find Category'));
            }
            exit;
        }
    }

    public function delete($id){

        $id = intval($id);
        $role = Role::where('role_id',$id)->get()[0];
        // if($role->employee()->get()){
        //     return back()->with('error','Please delete it\'s employee first');
        // }
        if($role){
            if(Role::where('role_id',$id)->delete()){
                return back()->with('success','Successfully deleted Role');
            }else{
                return back()->with('error','Unable to delete role');
            }
        }else{
            return back()->with('error','ROle not found.');
        }

    }
}
