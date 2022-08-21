<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Product;

class TagController extends Controller
{
  public function get_tags()
  {
     $products=Product::with(['categories','images','tags'])->paginate(env("PAGINATION_COUNT","16"));

    return  view('admin.tags.showtags',compact(['products']));
  }
}
