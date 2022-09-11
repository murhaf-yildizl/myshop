<?php

namespace App\Http\Controllers\Api;

use http\Env\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserApiResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

  public function register(Request $req)
  {
     $req->validate( [
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8'],
    ]);

    $user=new User();

    $user->first_name=$req->input('first_name');
    $user->last_name=$req->input('last_name');
    $user->email=$req->input('email');
    $user->password=Hash::make($req->input('password'));
    $user->api_token=bin2Hex(openssl_random_pseudo_bytes(30));
    $user->save();

    return new UserApiResource($user);

  }
public function login(Request $req)
{
   $req->validate( [
       'email'=>'required',
       'password'=>'required'

   ]);

      $email=$req->input('email');
      $password=$req->input('password');

      $credential=$req->only('email','password');

      if(Auth::attempt($credential))
      {
        $user=User::where('email',$email)->first();
        return new UserApiResource($user);

      }


    $message=[
    'message'=>' error!! the user credentials are not found!  '
    ];
      return  \response($message,401);

  // code...
}

}
