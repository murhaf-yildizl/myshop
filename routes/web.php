

<?php

use Illuminate\Support\Facades\Route;
use App\Models\Image;
use App\Models\Product;
use App\Models\Address;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\State;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Review;
use App\Models\Optionlist;
use App\Models\Option;

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


Auth::routes();


//... other routes


//Route::get('country', [App\Http\Controllers\CountryController::class, 'getcountries']);

Route::get('users',function()
{
  return User::with('billing_Address')->get();
}
);

Route::get('val',function(){
  //$pr=Product::with('units')->first();//get();
  $un1=Product::where('product_id','=','1')->with('units','categories','optionlists')->first();
  return $un1;
})->name('val');

  Route::get('countries',[App\Http\Controllers\CountryController::class,'get_countries']);
  Route::post('select_state',[App\Http\Controllers\CountryController::class,'select_state']);
  Route::post('select_city',[App\Http\Controllers\CountryController::class,'select_city']);

  Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  Route::group(["middleware"=>["auth","admin_auth"]],function(){

  Route::get('getunits',[App\Http\Controllers\UnitController::class,'get_units'])->name('show_units');
  Route::post('getunits',[App\Http\Controllers\UnitController::class,'get_units'])->name('show_units');
  Route::post('editunits',[App\Http\Controllers\UnitController::class,'edit_units']);
  Route::post('addunit',[App\Http\Controllers\UnitController::class,'add_unit'])->name('addunit');
  Route::delete('getunits',[App\Http\Controllers\UnitController::class,'delete_unit']);
  //Route::post('searchunit',[App\Http\Controllers\UnitController::class,'search_unit']);
  Route::PUT('getunits',[App\Http\Controllers\UnitController::class,'search_unit'])->name('search');


  Route::get('getoptions',[App\Http\Controllers\OptionController::class,'get_options'])->name('show_options');
  Route::post('getoptions',[App\Http\Controllers\OptionController::class,'get_options'])->name('show_options');
  Route::post('editoptions',[App\Http\Controllers\OptionController::class,'edit_options']);
  Route::post('addoption',[App\Http\Controllers\OptionController::class,'add_option'])->name('addoption');
  Route::delete('getoptions',[App\Http\Controllers\OptionController::class,'delete_option']);
  //Route::post('searchoption',[App\Http\Controllers\OptionController::class,'search_option']);
  Route::PUT('getoptions',[App\Http\Controllers\OptionController::class,'search_option'])->name('search');

  Route::get('getvalues/{id}',[App\Http\Controllers\OptionlistController::class,'get_values'])->name('show_values');
  //Route::post('getvalues/{id}',[App\Http\Controllers\OptionController::class,'get_values'])->name('show_values');
  Route::post('editvalue',[App\Http\Controllers\OptionlistController::class,'edit_value']);
  Route::post('addvalue',[App\Http\Controllers\OptionlistController::class,'add_value'])->name('addvalue');
  Route::delete('getvalues',[App\Http\Controllers\OptionlistController::class,'delete_value']);
  //Route::post('searchvalue',[App\Http\Controllers\OptionlistController::class,'search_value']);
  Route::PUT('getvalues/{id}',[App\Http\Controllers\OptionlistController::class,'search_value'])->name('search');

  Route::get('getcategories',[App\Http\Controllers\CategoryController::class,'get_categories'])->name('show_cats');
  Route::post('editcategory',[App\Http\Controllers\CategoryController::class,'edit_cats']);
  Route::post('getcategories',[App\Http\Controllers\CategoryController::class,'add_cat'])->name('addcat');
  Route::delete('getcategories',[App\Http\Controllers\CategoryController::class,'delete_cat']);
  Route::PUT('getcategories',[App\Http\Controllers\CategoryController::class,'search_cat'])->name('search');

  Route::get('getproducts',[App\Http\Controllers\ProductController::class,'get_products'])->name('show_products');
  Route::post('editproduct/{id}',[App\Http\Controllers\ProductController::class,'edit_product'])->name('edit_product');
  Route::post('addproduct',[App\Http\Controllers\ProductController::class,'add_product'])->name('add_product');
  Route::get('addproduct',[App\Http\Controllers\ProductController::class,'add_product'])->name('add_product');

  Route::post('save_product',[App\Http\Controllers\ProductController::class,'save_product'])->name('save_product');
  Route::post('delete_option',[App\Http\Controllers\ProductController::class,'delete_option']);
  Route::get('editproduct/{id}',[App\Http\Controllers\ProductController::class,'edit_product'])->name('edit_product');

  Route::post('select_option',[App\Http\Controllers\OptionlistController::class,'select_option']);

  Route::delete('getimages',[App\Http\Controllers\ImageController::class,'delete_image']);

  Route::get('gettags',[App\Http\Controllers\TagController::class,'get_tags'])->name('show_tags');
  Route::get('getreviews',[App\Http\Controllers\ReviewController::class,'get_reviews'])->name('show_reviews');
  Route::get('getcontacts',[App\Http\Controllers\ContactSupportController::class,'get_contacts'])->name('show_contacts');
  Route::get('getroles',[App\Http\Controllers\RoleController::class,'get_roles'])->name('show_roles');
});
