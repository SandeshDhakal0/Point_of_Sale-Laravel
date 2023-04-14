<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            $return_data = array();
            $data = SubCategory::all();
            foreach($data as $d){
                $return_data['data'][] = array(
                    'sub_cat_id' => $d->sub_category_id,
                    'sub_cat_name' => $d->sub_category_name,
                    'cat_id'=> $d->category_id,
                    'action' => '<button class="btn btn-sm btn-outline-success editBtn m-4" data-categoryname="'.$d->sub_category_name.'" data-id="'.$d->sub_category_id.'" data-toggle="modal" data-target="#sub_category_model"><i class="fas fa-edit" style="color:green;"></i></button><a class="btn btn-sm btn-outline-danger deleteBtn" href="'.route('subcategory.delete',array('id'=>$d->sub_category_id)).'"><i class="fas fa-trash-alt" style="color:red;"></i></a>',
                );
            }
            echo json_encode($return_data);
            exit;
        }
        $data = Category::all();
        return view('sub-category.index',['category' => $data]);
    }

    public function add(Request $request){
        if($request->ajax() && $request->isMethod('GET')){

            $sub_cat_id = '';
            $catData['sub_category_name'] = $request->input('sub_category_name');
            $catData['category_id'] = intval($request->input('category_id'));
            if($request->input('sub_category_id') && ($request->input('sub_category_id') != '')){
                $sub_cat_id = intval($request->input('sub_category_id'));
            }
            $query = Subcategory::where('sub_category_name',$catData['sub_category_name'])->get();
            if(!$query->isEmpty() && $sub_cat_id != ''){
                echo json_encode(array('status'=>400,'message'=>'Category already exists.'));
            }else{
                if(isset($sub_cat_id) && $sub_cat_id != ''){
                    $catData['updated_at'] = date('Y-m-d H:i:s');
                    $res = Subcategory::where('sub_category_id',$sub_cat_id)->update($catData);
                }else{
                    $res = Subcategory::insert($catData);

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
            $sub_cat_id = $request->input('sub_category_id');
            $catData = Subcategory::where('sub_category_id',$sub_cat_id)->get()[0];
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
        $cat = Subcategory::where('sub_category_id',$id)->get()[0];
        if($cat){
            if(Subcategory::where('sub_category_id',$id)->delete()){
                return back()->with('success','Successfully deleted Category');
            }else{
                return back()->with('error','Unable to delete category');
            }
        }else{
            return back()->with('error','Category not found.');
        }

    }
}
