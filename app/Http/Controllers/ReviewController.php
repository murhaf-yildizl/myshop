<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
 
class ReviewController extends Controller
{


    public function get_reviews()
    {
           $products=Product::with('reviews')->paginate(env('PAGINATION_COUNT',16));
          return view('admin.reviews.showreviews',compact('products'));

    }



}
