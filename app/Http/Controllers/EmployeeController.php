<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            $return_data = array();
            $data = Employee::all();
            foreach($data as $d){
                $return_data['data'][] = array(
                    'employee_id' => $d->employee_id,
                    'name' => $d->employee_name,
                    'role'=> Role::where('role_id',$d->role_id)->get()[0]['role_name'],
                    'join_date'=> $d->join_date,
                    'action' => '<button class="btn btn-sm btn-outline-success editBtn m-4" data-joindate="'.$d->join_date.'" data-role="'.$d->role_id.'" data-name="'.$d->employee_name.'" data-id="'.$d->employee_id.'" data-toggle="modal" data-target="#employee_modal"><i class="fas fa-edit" style="color:green;"></i></button><a class="btn btn-sm btn-outline-danger deleteBtn" href="'.route('employee.delete',array('id'=>$d->employee_id)).'"><i class="fas fa-trash-alt" style="color:red;"></i></a>',
                );
            }
            echo json_encode($return_data);
            exit;
        }
        $data = Role::all();
        return view('employee.index',['role' => $data]);
    }

    public function add(Request $request){
        if($request->ajax() && $request->isMethod('GET')){

            $employee_id = '';
            $catData['employee_name'] = $request->input('employee_name');
            $catData['role_id'] = intval($request->input('role_id'));
            $catData['join_date'] = $request->input('join_date');
            if($request->input('employee_id') && ($request->input('employee_id') != '')){
                $employee_id = intval($request->input('employee_id'));
            }

            if(isset($employee_id) && $employee_id != ''){
                $catData['updated_at'] = date('Y-m-d H:i:s');
                $res = Employee::where('employee_id',$employee_id)->update($catData);
            }else{
                $catData['created_at'] = date('Y-m-d H:i:s');
                $catData['updated_at'] = date('Y-m-d H:i:s');
                $res = Employee::insert($catData);

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
            $employee_id = $request->input('employee_id');
            $catData = Employee::where('employee_id',$employee_id)->get()[0];
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
        $cat = Employee::where('employee_id',$id)->get()[0];
        if($cat){
            if(EMployee::where('employee_id',$id)->delete()){
                return back()->with('success','Successfully deleted Category');
            }else{
                return back()->with('error','Unable to delete category');
            }
        }else{
            return back()->with('error','Category not found.');
        }

    }
}
