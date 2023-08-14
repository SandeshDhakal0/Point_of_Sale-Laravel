<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorJPG;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {

        $redColor = [0, 0, 0];


        if ($request->ajax()) {
            $return_data = array();
            $data = Product::all();
            foreach ($data as $d) {
                $return_data['data'][] = array(
                    'product_id' => $d->product_id,
                    'product_name' => $d->product_name,
                    'sales_price' =>  $d->sales_price,
                    'bar_code' => '<img src="' . $d->bar_code . '"><a class="btn btn-sm btn-primary m-3 print-bar" data-img="' . $d->bar_code . '">print</a>',
                    'action' => '<a class="btn btn-sm btn-outline-success m-4" href="'.route('product.edit', ['id' => $d->product_id]).'"><i class="fas fa-edit" style="color:green;"></i></a><a class="btn btn-sm btn-outline-danger m-4" href="'.route('product.delete', ['id' => $d->product_id]).'"><i class="fas fa-trash-alt" style="color:red;"></i></a>',
                );
            }
            echo json_encode($return_data);die;
            exit;
         }
        return view('product.index');
    }

    public function add()
    {
        $data = Category::all();
        $subcat = SubCategory::all();
        return view('product.add')->with(array('categories' => $data, 'subcategory' => $subcat));
    }

    public function edit($id)
    {
        $product = Product::where('product_id', $id)->get()[0];
        $images = Image::where('product_id',$product['product_id'])->get();
        $quantity = json_decode($product->stock_quantity);
        $data = Category::all();
        $subcat = SubCategory::all();
        return view('product.edit')->with(array('images' => $images, 'product'=>$product,'categories' => $data, 'subcategory' => $subcat,'quantity' => $quantity));
    }


    public function addproduct(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'product_name' => 'required',
                'particulars' => 'required',
                'category_id' => 'required',
                'sales_price' => 'required',
                'cost_price' => 'required',
                'sub_category_id' => 'required',
                'product_description' => 'required',
            ], [
                'product_name.required' => 'Product Name is required',
                'particulars.required' => 'Particulars is required',
                'category_id.required' => 'Product Category is required',
                'sales_price.required' => 'Price is required',
                'cost_price.required' => 'Cost Price is required',
                'sub_category_id.required' => 'Sub Category is required',
                'product_description.required' => 'Description is required'
            ]);

            $quantity = array();

            $quantity['meter'] = $request->input('meter');
            $quantity['sqmt'] = $request->input('sqmt');
            $quantity['perpiece'] = $request->input('perpiece');
            $quantity['sqft'] = $request->input('sqft');
            $quantity['kg'] = $request->input('kg');
            $quantity['cm'] = $request->input('cm');
            $quantity['gram'] = $request->input('gram');
            $quantity['litre'] = $request->input('litre');
            $quantity['gallons'] = $request->input('gallons');

            if($request->input('product_id') && $request->input('product_id') != ''){
                $res = Product::where('product_id', $request->input('product_id'))->update(array(

                    'product_name' => $request->input('product_name'),
                    'cost_price' => $request->input('cost_price'),
                    'category_id' => $request->input('category_id'),
                    'particulars' => $request->input('particulars'),
                    'sales_price' => $request->input('sales_price'),
                    'stock_quantity' => json_encode($quantity),
                    'remarks' => $request->input('remarks'),
                    'product_sub_category' => $request->input('sub_category_id'),
                    'product_description' => $request->input('product_description'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ));

            }else{
                $color = [0, 0, 0];

                $generator = new BarcodeGeneratorJPG();
                $path = 'storage/barcode';
                if (!is_dir($path))
                {
                    @mkdir($path, 0777, true);
                }
                $filename =time().'.jpg';
                $prod_uniq = time();

                file_put_contents($path.'/'.$filename, $generator->getBarcode($prod_uniq, $generator::TYPE_CODE_128, 3, 50, $color));


                $res = Product::create(array(
                    'product_name' => $request->input('product_name'),
                    'cost_price' => $request->input('cost_price'),
                    'category_id' => $request->input('category_id'),
                    'particulars' => $request->input('particulars'),
                    'sales_price' => $request->input('sales_price'),
                    'stock_quantity' => json_encode($quantity),
                    'remarks' => $request->input('remarks'),
                    'product_sub_category' => $request->input('sub_category_id'),
                    'product_description' => $request->input('product_description'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'bar_code' => '/'. $path . '/' . $filename,
                    'prod_uniq' => $prod_uniq
                ));
            }

            if ($request->hasFile('image')) {

                if($request->input('product_id') && $request->input('product_id') != ''){
                    $imgs = Image::where('product_id',$request->input('product_id'))->get();
                    foreach($imgs as $i){
                        Storage::delete('public/products/' . $i['image_path']);
                        Image::where('id',$i['id'])->delete();

                    }

                }

                $images = $request->file('image');

                foreach ($images as $key => $image) {
                    $filename = rand(0,100).'_'.time().'.'.$image->extension();
                    $request->validate([
                        'image['.$key.']' => 'image|mimes:jpeg,png,jpg,svg|max:2000',
                    ]);
                    Storage::putFileAs('public/products/', new File($image), $filename);
                    if($request->input('product_id') && $request->input('product_id') != ''){
                        Image::create(['product_id'=>$request->input('product_id'),'image_path'=>$filename]);
                    }else{
                        $res->image()->create(['image_path'=>$filename]);
                    }
                }


            }
            if ($res) {
                return redirect()->route('product.list')->with('success', 'Successfully Added to the List.');
            } else {
                return redirect()->back()->with('error', 'Unable to added to the List.');
            }
        }
    }

    public function find(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $cat_id = $request->input('category_id');
            $catData = Category::where('category_id', $cat_id);
            if ($catData) {
                echo json_encode(array('status' => 400, 'data' => $catData));
            } else {
                echo json_encode(array('status' => 400, 'message' => 'Unable to find Category !!'));
            }
            exit;
        }
    }

    public function delete($id)
    {

        try {
            $id = intval($id);
            $imgs = Image::where('product_id', $id)->get();
            foreach ($imgs as $i) {
                Storage::delete('public/products/' . $i['image_path']);
                Image::where('id', $i['id'])->delete();
            }
            $del = Product::where('product_id', $id)->delete();
            if ($del) {
                return back()->with('success', 'Successfully deleted Product');
            } else {
                return back()->with('error', 'Unable to delete product');
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('error', 'Unable to delete product. The product has associated sales.');
        }
    }
}
