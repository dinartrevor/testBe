<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
class DashboardController extends Controller
{
    public function index(){
        $countProduct = Product::all();
        $countCategory = Category::all();
        return view('dashboard', compact('countProduct', 'countCategory') );
    }
}
