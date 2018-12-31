<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function addCategory(Request $request){
      if($request->isMethod('post')){
        $data = $request->all();

        $category = new Category;
        $category->name = ucwords(strtolower($data['name']));
        $category->description = $data['description'];
        $category->slug = str_slug($data['name']);
        $category->save();
      }
        return view ('admin.categories.add_category');
    }
}
