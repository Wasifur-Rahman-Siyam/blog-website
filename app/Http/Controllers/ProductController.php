<?php

namespace App\Http\Controllers;


use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::all();
        return view('backend.product.manage', compact(['brands', 'categories', 'products']));
    }
    public function allProduct() {
        $products = Product::all();
        $categories = Category::all();
        return view('frontend.product.all-product', compact( 'categories','products'));
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
    public function edit($brand_id, $cat_id) {
        $brand = Brand::find($brand_id);
        $category = Category::find($cat_id);
        $categories = Category::all();
        return view('backend.brand.edit', compact(['brand','category','categories']));
    }
    public function update(Request $request, $brand_id) {
        $request->validate([
            'category_id'   => 'required',
            'name'          => 'required|max:60'
        ],[
            'category_id.required'  => 'The category field is required',
            'name.required'         => 'The Brand field is required.'
        ]);
        $brand = Brand::find($brand_id);
        $brand->category_id = $request->category_id;
        $brand->name = $request->name;
        $brand->save();
        return redirect()->route('brand-manage')->with('msg', 'brand Updated Successfully');
    }
    public function delete($product_id) {
        $product = Product::find($product_id);
        $product_del_img = $product->image;
        $product->delete();
        // if (File::exists($product_del_img)) {
        //     unlink($product_del_img);
        // }
        return redirect()->back()->with('msg', 'Brand deleted Successfully');
    }
}
