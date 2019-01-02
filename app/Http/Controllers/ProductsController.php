<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function addProduct(Request $request){
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option selected disabled> Select </option>";
           foreach($categories as $cat){
               $categories_dropdown .= "<option value=".$cat->id.">" . $cat->name . "</option>";
               $sub_categories = Category::where(['parent_id' => $cat->id])->get();
                foreach($sub_categories as $sub_cat){
                    $categories_dropdown .= "<option value=".$sub_cat->id."> &nbsp; --- &nbsp;" . $sub_cat->name ."</option>";
                }
           }
        return view ('admin.products.add_product', compact('categories_dropdown'));
    }
}
