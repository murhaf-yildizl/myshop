<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Option;
use App\Models\Optionlist;
use App\Models\Image;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller
{


  public function get_products()
  {
      $currency_code=env("CURRENCY_CODE","$");
      $products=Product::with(['categories','images'])->paginate(env("PAGINATION_COUNT","16"));

      return view('admin.products.showproducts',compact('products','currency_code'));

    }  //

      public function edit_product($id)
      {
           $options=Option::All();
           $cats=Category::All();
           $units=Unit::All();

           $product=Product::where('product_id','=',$id)->with('units','categories','optionlists')->first();
           return view('admin.products.editproduct',compact('product','cats','units','options'));

      }

public function save_product(Request $req)
{
//dd($req);

 $req->validate([
    'product_name'=>'required',
  ],
  [
    'product_name.required'=>'the product name is required',
  ]
);
$product_id=$req['product_id'];

  if($product_id==0)
     $product=new Product();
else $product=Product::find($product_id);

  $product->name=$req['product_name'];
  $product->description=$req['product_discription'];
  $product->price=doubleval($req['product_price']);
  $product->available=doubleval($req['product_qnty']);
  $product->discount=doubleval($req['product_discount']);
  $product->unit_id=$req['unit_id'];
  $product->cat_id=$req['category_id'];
  $product->save();

    if($product_id==0)
     $product_id=Product::latest()->first()->product_id;

  $option_list=$req['optionList'];

    if($option_list!=null)
  {

  foreach ($option_list as $option) {
     $id=Option::where('name',$option)->first()->option_id;

   foreach ($req[$option] as $value) {
    $op_val=Optionlist::where([['option_id',$id],['value',$value]])->first();
    $op_val->products()->attach($product_id);
    }
  // code...
  }

}

if($req->hasFile('files'))
{
  $images=$req->file('files');
      foreach ($images as $image)
       {
        $path=$image->store('public');
        $img=new Image();

        $img->url=$path;
        $img->product_id=$product_id;
        $img->title="";
        $img->save();
                     // code...
      }

}


  Session::flash('message','the product has saved successfully');

  return redirect('getproducts');
}


public function add_product()
      {
         $product=new Product();
         $product->product_id=0;
         $product->name="";
         $product->description="";
         $product->price=0;
         $product->available=0;
         $product->discount=0.0;
         $options=Option::All();
         $cats=Category::All();
         $units=Unit::All();

        return view('admin.products.editproduct',compact(  'product','units','cats','options'));


      }



public function delete_option(Request $req)
{

  //return Request('product_id');
  $id=$req['delete_modal_option_id'];
  $op_val=optionList::find($id);
  $op_val->products()->detach($op_val->products->first()->product_id);
  Session::flash('message','the option has deleted successfully');
  return redirect()->back();

  // code...
}




}
