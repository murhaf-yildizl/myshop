<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use DB;
class UserController extends Controller
{

 public function __construct()
 {
     $this->middleware('email_verified_auth');
 }

 /**
  * Show the application dashboard.
  *

  */
 public function index()
 {
     $users = DB::table('users')
               ->join('addresses', 'users.billing_Address_id', '=', 'addresses.address_id')
                ->select('users.first_name', 'addresses.country','users.shipping_Address_id')
               ->get();
     return $users;



 }
}
