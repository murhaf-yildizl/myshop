<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactSupport;
 

class ContactSupportController extends Controller
{
     public function get_contacts()
     {
        $contacts=ContactSupport::with(['users','orders','supports'])->paginate(env('PAGINATION_COUNT',16));
       return view('admin.contacts.getcontacts',compact('contacts'));

          }
}
