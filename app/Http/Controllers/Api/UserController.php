<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\User_all_info_Resource;

class UserController extends Controller
{
  public function index()
  {
    return User_all_info_Resource::collection(User::paginate());
    // code...
  }
}
