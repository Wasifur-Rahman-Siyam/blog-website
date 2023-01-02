<?php

namespace App\Http\Controllers;


use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File; 
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::all();
        return view('backend.product.manage', compact('brands', 'categories', 'products'));
    }
    public function allProduct() {
        $products = Product::all();
        $categories = Category::all();
        $title = 'All products';
        return view('frontend.product.all-product', compact( 'categories','products','title'));
    }
    public function categoryProduct ($cat_id) {
        $products = Product::where('category_id',"=",$cat_id)->get();
        $categories = Category::all();
        $category = Category::find($cat_id);
        $title = $category->name;
        return view('frontend.product.all-product', compact( 'categories','products','title'));
    }
    public function create() {
        $brands = Brand::all();
        $categories = Category::all();
        return view('backend.product.create', compact('categories','brands'));
    }

    public function store(Request $request) {
        $request->validate([
            'category_id'   => 'required',
            'brand_id'      => 'required',
            'name'          => 'required|max:60',
            'price'         => 'required|max:10',
            'description'   => 'required',
            'image'         => 'required|image|mimes:jpg,png,jpeg,gif,svg'
        ],[
            'category_id.required'  => 'The category field is required',
            'brand_id.required'  => 'The brand field is required',
            'name.required'         => 'The Product name field is required.'
        ]);
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $image = $request->image;
        if($image) {
            $folder = 'db-images/product-images/';
            $imageName = 'product_image'.time(). '.' .$image->getClientOriginalExtension();
            $image->move($folder, $imageName);
            $product->image = $folder . $imageName;
        }
        $product->save();

        return redirect()->back()->with('msg', 'Product Add Successfully');
    }
    public function status($product_id) {
        $product = Product::find($product_id);
        $status = $product->status;
        if(1 == $status){
            $status = 0;
        }
        else{
            $status = 1;
        }
        $product->status = $status;
        $product->save();
        return redirect()->back()->with('msg', 'Product Add Successfully');
    }

    public function edit($cat_id, $brand_id, $product_id) {
        $brand = Brand::find($brand_id);
        $category = Category::find($cat_id);
        $product = Product::find($product_id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('backend.product.edit', compact('brand','category','product', 'categories', 'brands'));
    }
    public function update(Request $request, $product_id) {
        $request->validate([
            'category_id'   => 'required',
            'brand_id'      => 'required',
            'name'          => 'required|max:60',
            'price'         => 'required|max:10',
            'description'   => 'required',
            'image'         => 'image|mimes:jpg,png,jpeg,gif,svg'
        ],[
            'category_id.required'  => 'The category field is required',
            'brand_id.required'  => 'The brand field is required',
            'name.required'         => 'The Product name field is required.'
        ]);
        $product = Product::find($product_id);
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $image = $request->image;
        if($image) {
            $deleteImage = $product->image;
            $folder = 'db-images/product-images/';
            $imageName = 'product_image'.time(). '.' .$image->getClientOriginalExtension();
            $image->move($folder, $imageName);
            $product->image = $folder . $imageName;
            if(File::exists($deleteImage)){
                unlink($deleteImage);
            }
        }
        $product->save();

        return redirect()->route('product-manage')->with('msg', 'Product updated Successfully');
    }
    public function delete($product_id) {
        $product = Product::find($product_id);
        $productDeleteImage = $product->image;
        $product->delete();
        if(File::exists($productDeleteImage)){
            unlink($productDeleteImage);
        }
        return redirect()->back()->with('msg', 'Brand deleted Successfully');
    }
}
