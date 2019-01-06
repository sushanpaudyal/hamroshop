<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//Route::get('/adminLogin', 'AdminController@login')->name('admin.login');
Route::match(['get', 'post'], '/adminLogin', 'AdminController@login')->name('admin.login');

Route::group(['middleware' => 'auth'], function(){
  Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
  Route::get('/admin/profile/{id}', 'AdminController@profile')->name('profile');
  Route::post('/admin/profile/update/{id}', 'AdminController@update_profile')->name('update.profile');

//   Catgeory Routes

   Route::match(['get', 'post'], '/admin/addCategory', 'CategoryController@addCategory')->name('category.add');
   Route::get('/admin/view-categories', 'CategoryController@viewCategories')->name('categories.view');
   Route::match(['get', 'post'], '/admin/edit-category/{id}', 'CategoryController@editCategory')->name('category.edit');
   Route::match(['get', 'post'], '/admin/delete-category/{id}', 'CategoryController@deleteCategory')->name('category.delete');

//   Products Routes
    Route::match(['get', 'post'], '/admin/add-product', 'ProductsController@addProduct')->name('product.add');
    Route::get('/admin/view_products', 'ProductsController@viewProduct')->name('product.view');
    Route::match(['get', 'post'], '/admin/edit-product/{id}', 'ProductsController@editProduct')->name('product.edit');
});




Route::get('/logout', 'AdminController@logout')->name('admin.logout');
