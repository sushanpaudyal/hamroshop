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
        $category->parent_id = $data['parent_id'];
        $category->save();
        return redirect()->route('categories.view')->with('flash_message_success', 'Category Inserted Successfully');
      }
      $levels = Category::where(['parent_id' => 0])->get();
        return view ('admin.categories.add_category', compact('levels'));
    }

    public function viewCategories(){
      $categories = Category::all();
      return view ('admin.categories.view_categories', compact('categories'));
    }

    public function editCategory(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();
            Category::where(['id' => $id])->update(['name' => $data['name'], 'parent_id' => $data['parent_id'] , 'description' => $data['description'], 'slug' => str_slug($data['name'])
            ]);
            return redirect()->route('categories.view')->with('flash_message_success', 'Category Updated');
        }
        $category = Category::where(['id' => $id])->first();
        $levels = Category::where(['parent_id' => 0])->get();
        return view ('admin.categories.edit_category')->with(compact('category', 'levels'));
    }

    public function deleteCategory($id = null){
        if(!empty($id)){
           Category::where(['id' => $id])->delete();
           return redirect()->route('categories.view')->with('flash_message_warning', 'Catgeory Deleted');
        }
    }
}
