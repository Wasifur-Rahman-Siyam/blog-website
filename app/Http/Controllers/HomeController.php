<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index () {
        $categories = Category::all();
        return view('frontend.home.index', compact('categories'));
    }
}
