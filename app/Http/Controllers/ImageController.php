<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Image;

class ImageController extends Controller
{

    public function delete_image()
    {
      $image_id=Request('delete_modal_image_id');
      Image::destroy($image_id);

      Session::flash("message", "The image has been deleted successfully!! ");
      return redirect()->back();


    }
}
