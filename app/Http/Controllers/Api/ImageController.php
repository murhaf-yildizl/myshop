<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Storage;
use Response;


class ImageController extends Controller
{

    public function get_image($url)
    {

      ob_end_clean();

    return response()->file(public_path('storage/public/'.$url));


}
}
