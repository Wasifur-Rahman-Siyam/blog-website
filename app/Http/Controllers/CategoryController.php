<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create() 
    {
        return view('backend.category.create');
    }
    public function store(Request $r) {

        $r->validate([
            'name' => 'max:40'
        ]);
        $category = new Category();
        $category->name = $r->name;
        $category->save();
        return redirect()->back()->with('msg', 'Category Add Successfully');
    }
}
