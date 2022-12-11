<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index() {
        $brands = Brand::all();
        $categories = Category::all();
        return view('backend.brand.manage', compact(['brands','categories']));
    }
    public function create() {
        $categories = Category::all();
        return view('backend.brand.create', compact('categories'));
    }
    public function store(Request $request) {
        $request->validate([
            'category_id'   => 'required',
            'name'          => 'required|max:40'
        ],[
            'category_id.required'  => 'The category field is required',
            'name.required'         => 'The Brand field is required.'
        ]);
        $brand = new Brand();
        $brand->category_id = $request->category_id;
        $brand->name = $request->name;
        $brand->save();
        return redirect()->back()->with('msg', 'Brand Add Successfully');
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
            'name'          => 'required|max:40'
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
        DB::table('products')->where('brand_id', $brand_id)->delete();
        return redirect()->back()->with('msg', 'Brand deleted Successfully');
    }
}
