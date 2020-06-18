<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\SubCategory;
use Illuminate\Support\Facades\Input; 
use PDF;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        $categories = Category::all();
        return view('products.index', compact('categories','products'));
    }
    public function addProduct(Request $request)
    {
       $products = new Product;
       $products->title = $request->title;
       $products->brands = $request->brands;
       $products->gender = $request->gender;
       $products->category_id = $request->category;
       $products->subcategory_id = $request->subcategory;
       $products->description = $request->description;
       $products->save();
       $products->load(['category', 'subcategory']);
    
       
       return response()->json($products);

    }

    public function subCategory(){
        $categories = Input::get('category_id');

        $sub = SubCategory::where('category_id', '=', $categories)->get();
        return response()->json($sub);
        
    }

    public function exportProduct(){
        $products = Product::orderBy('created_at', 'DESC')->get();
        $countProduct = Product::all();
        $pdf = PDF::loadView('Products.cetakpdf',compact('countProduct', 'products'));
        $pdf->setPaper('a4','potrait');

        return $pdf->stream();
    }

    public function deleteProduct($id){
        $products = Product::find($id)->delete();
        return json_encode($products);
    }

    public function detailProduct($id){
        $products = Product::where('id', $id)->first();
        return response()->json($products);
    }
}
