<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TagResource;
use App\Models\Tag;

class TagController extends Controller
{
  public function index()
  {
    return TagResource::collection(Tag::paginate());
    // code...
  }

  public function get_tag($id)
  {
     return new TagResource(Tag::find($id));  
    // code...
  }
}
