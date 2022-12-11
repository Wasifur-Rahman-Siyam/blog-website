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
    public function create() {
        $brands = Brand::all();
        $categories = Category::all();
        return view('backend.product.create', compact('categories','brands'));
    }
    public function store(Request $request) {
        $request->validate([
            'category_id'   => 'required',
            'name'          => 'required|max:60',
            'price'         => 'required|max:10',
            'description'   => 'required',
            'image'         => 'required|image|mimes:jpg,png,jpeg,gif,svg'
        ],[
            'category_id.required'  => 'The category field is required',
            'name.required'         => 'The Brand field is required.'
        ]);
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $image = $request->image;
        $imageName = time().$image->getClientOriginalName();
        $folder = 'backend-assets/assets/img';
        if($image) {
            $image->move($folder, $imageName);
            $product->image = $folder .'/'. $imageName;
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
    public function delete($brand_id) {
        $brand = Brand::find($brand_id);
        $brand->delete();
        return redirect()->back()->with('msg', 'Brand deleted Successfully');
    }
}
