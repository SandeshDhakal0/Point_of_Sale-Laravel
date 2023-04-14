<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            $return_data = array();
            $data = Category::all();
            foreach($data as $d){
                $return_data['data'][] = array(
                    'cat_id' => $d->category_id,
                    'cat_name' => $d->category_name,
                    'action' => '<button class="btn btn-sm btn-outline-success editBtn m-4" data-categoryname="'.$d->category_name.'" data-id="'.$d->category_id.'" data-toggle="modal" data-target="#category_model"><i class="fas fa-edit" style="color:green;"></i></button><a class="btn btn-sm btn-outline-danger deleteBtn" href="'.route('category.delete',array('id'=>$d->category_id)).'"><i class="fas fa-trash-alt" style="color:red;"></i></a>',
                );
            }
            if(count($return_data) > 0){
                echo json_encode($return_data);
            }
            exit;
        }
        return view('category.index');
    }

    public function add(Request $request){
        if($request->ajax() && $request->isMethod('GET')){
            $cat_id = '';
            $catData['category_name'] = $request->input('category_name');
            if($request->input('category_id') && ($request->input('category_id') != '')){
                $cat_id = $request->input('category_id');
            }
            if(Category::where('category_name',$catData['category_name'])->get()[0]){
                echo json_encode(array('status'=>400,'message'=>'Category already exists.'));
            }else{
                if(isset($cat_id) && $cat_id != ''){
                    $catData['updated_at'] = date('Y-m-d H:i:s');
                    $res = Category::where('category_id',$cat_id)->update($catData);
                }else{
                    $res = Category::insert($catData);
                }
                if($res){
                        echo json_encode(array('status'=>200,'message'=>'Category updated successfully.'));
                }else{
                        echo json_encode(array('status'=>400,'message'=>'Unable to update Category.'));
                }
            }
            exit;
        }
    }

    public function find(Request $request){
        if($request->ajax() && $request->isMethod('GET')){
            $cat_id = $request->input('category_id');
            $catData = Category::where('category_id',$cat_id)->get()[0];
            if($catData){
                echo json_encode(array('status'=>400,'data'=>$catData));
            }else{
                echo json_encode(array('status'=>400,'message'=>'Unable to find Category'));
            }
            exit;
        }
    }

    public function delete($id){

        $id = intval($id);
        $cat = Category::where('category_id',$id)->get()[0];
        // if($cat->subcategory){
        //     return back()->with('error','Please delete it\'s subcategory first');
        // }
        if($cat){
            if(Category::where('category_id',$id)->delete()){
                return back()->with('success','Successfully deleted Category');
            }else{
                return back()->with('error','Unable to delete category');
            }
        }else{
            return back()->with('error','Category not found.');
        }

    }
}
