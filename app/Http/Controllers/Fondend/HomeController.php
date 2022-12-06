<?php

namespace App\Http\Controllers\Fondend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('frontend.home.index', compact('categories'));
    }
}
