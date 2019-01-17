<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\ProductsAttribute;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Session;
use Image;
use File;


class ProductsController extends Controller
{
    public function addProduct(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $product = new Product;
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];

            if(!empty($data['description'])){
                $product->description = $data['description'];
            } else {
                $product->description = '';
            }

            if(!empty($data['care'])){
                $product->care = $data['care'];
            } else {
                $product->care = '';
            }




            $product->price = $data['price'];

            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'public/adminpanel/uploads/products/large/'. $filename;
                    $medium_image_path = 'public/adminpanel/uploads/products/medium/'. $filename;
                    $small_image_path = 'public/adminpanel/uploads/products/small/'. $filename;
                    // Resize Image Code
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                    // Store image name in products table
                    $product->image = $filename;
                }
            }
            $product->save();
            return redirect()->back()->with('flash_message_success', 'Product Has Been Inserted');
          }

        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option value='' selected disabled>  Select </option>";
        foreach($categories as $cat){
            $categories_dropdown .= "<option value ='".$cat->id."'>".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                $categories_dropdown .= "<option value= '".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }
        return view ('admin.products.add_product', compact('categories_dropdown'));
    }

    public function viewProduct(){
        $products = Product::get();
        foreach($products as $key => $val){
            $category_name = Category::where(['id' => $val->category_id])->first();
            $products[$key]->category_name = $category_name->name;
        }
        return view('admin.products.view_products', compact('products'));
    }

    public function editProduct(Request $request, $id = null){

        if($request->isMethod('post')){

            $data = $request->all();
            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'public/adminpanel/uploads/products/large/'. $filename;
                    $medium_image_path = 'public/adminpanel/uploads/products/medium/'. $filename;
                    $small_image_path = 'public/adminpanel/uploads/products/small/'. $filename;
                    // Resize Image Code
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                }
            } else {
                $filename = $data['current_image'];
            }
            if(empty($data['description'])){
                $data['description'] = "";
            }


            if(empty($data['care'])){
                $data['care'] = "";
            }

            Product::where(['id' => $id])->update(['category_id' => $data['category_id'], 'product_name' => $data['product_name'], 'product_code' => $data['product_code'], 'product_color' => $data['product_color'] , 'description' => $data['description'], 'price' => $data['price'], 'image' => $filename, 'care' => $data['care']
                ]);
            return redirect()->back()->with('flash_message_success', 'Product Has been updated successfully');
        }



        $productDetails = Product::where(['id' => $id])->first();
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option value='' selected disabled>  Select </option>";
        foreach($categories as $cat){
            if($cat->id == $productDetails->category_id){
                $selected = "selected";
            } else {
                $selected = "";
            }
            $categories_dropdown .= "<option value='".$cat->id."' ".$selected.">" . $cat->name . " </option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach($sub_categories as $sub_cat){
                if($sub_cat->id == $productDetails->category_id){
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $categories_dropdown .= "<option value='".$sub_cat->id."' ".$selected."> &nbsp; --- &nbsp;" . $sub_cat->name . "</option>";
            }
        }
        return view ('admin.products.edit_product', compact('productDetails', 'categories_dropdown'));
    }


    public function deleteProductImage($id){

        $productImage = Product::where(['id' => $id])->first();

        $large_image_path = 'public/adminpanel/uploads/products/large/';
        $medium_image_path = 'public/adminpanel/uploads/products/medium/';
        $small_image_path = 'public/adminpanel/uploads/products/small/';

        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }

        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        }

        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }


        Product::where(['id' => $id])->update(['image' => ""]);
        return redirect()->back()->with('flash_message_success', 'Product Image Deleted Successfully');
    }

    public function deleteProduct($id = null){
        Product::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success', 'Product Has Been Deleted');
    }


    public function addAttributes(Request $request, $id = null){
        $productDetails = Product::with('attributes')->where(['id' => $id])->first();
        if($request->isMethod('post')){
            $data = $request->all();
//            echo "<pre>";  print_r($data); die;
            foreach($data['sku'] as $key => $val){
                if(!empty($val)){


//                    SKU Check
                    $attrCountSKU = ProductsAttribute::where('sku', $val)->count();
                    if($attrCountSKU > 0){
                        return redirect()->back()->with('flash_message_error', 'SKU Already Exists');
                    }


//                    Size Check
                    $attrCountSize = ProductsAttribute::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();
                    if($attrCountSize > 0){
                        return redirect()->back()->with('flash_message_error', 'Size Already Exists');

                    }




                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }
            }
            return redirect()->back()->with('flash_message_success', 'Attribute Added Successfully');
        }
        return view ('admin.products.add_attributes', compact('productDetails'));
    }

    public function deleteAttribute($id){
        ProductsAttribute::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success', 'Attribute Deleted Successfully');
    }


    public function products($slug = null){

//        show 404 error page if category slug does not exists
        $countCategory = Category::where(['slug' => $slug])->count();
        if($countCategory == 0){
            abort(404);
        }


//        Get all the categories and sub categories
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();
        $categoriesDetails = Category::where(['slug' => $slug])->first();

        if($categoriesDetails->parent_id == 0){
//            if slug is main category
            $subCategories = Category::where(['parent_id' => $categoriesDetails->id])->get();
            foreach($subCategories as $key => $subcat){
                    $cat_ids[] = $subcat->id;
                }
            $productsAll = Product::whereIn('category_id', $cat_ids)->get();
        } else {
//            if slug is subcategory
            $productsAll = Product::where(['category_id' => $categoriesDetails->id])->get();
        }

        return view ('products.listing', compact('categoriesDetails', 'productsAll', 'categories'));
    }


    public function product($id = null){
        $productDetails = Product::with('attributes')->where(['id' => $id])->first();
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();
        return view ('products.detail', compact('productDetails', 'categories'));
    }

    public function getProductPrice(Request $request){
        $data = $request->all();
        $proArr = explode("-", $data['idSize']);
        $proAttr = ProductsAttribute::where(['product_id' => $proArr[0], 'size' => $proArr[1]])->first();
        echo $proAttr->price;
    }
}
