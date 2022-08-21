<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
      return ProductResource::collection(Product::paginate());
      // code...
    }

  public function get_product($id)
    {
      return new ProductResource(Product::find($id));
      // code...
    }



}
