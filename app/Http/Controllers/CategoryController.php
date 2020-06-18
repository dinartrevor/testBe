<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
class CategoryController extends Controller
{
    //category
    public function index(){
        $categories = Category::orderBy('created_at', 'DESC')->get();
        return view('kategori.index', compact('categories'));
    }

    public function addCategory(Request $request){
        $category = new Category;
        $category->name = $request->name;
        $category->save();
        return response()->json($category);
    }
    public function deleteCategory($id){
        $categories = Category::find($id)->delete();
        return json_encode($categories);
    }

    // subcategory
    public function sub_category(){
        $categories = Category::all();
        $sub = SubCategory::orderBy('id', 'ASC')->get();
        return view('kategori.subcategory', compact('sub', 'categories'));
    }
    public function addSubcategory(Request $request){
        $sub = new SubCategory;
        $sub->category_id = $request->category_id;
        $sub->parent = $request->parent;
        $sub->save();
        $sub->load('category');
        return response()->json($sub);
        
    }

    public function deleteSubcategory($id){
        $sub = SubCategory::find($id)->delete();
        return json_encode($sub);
    }

}
