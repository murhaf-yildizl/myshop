<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\option;
use App\Models\Optionlist;

use Session;

class OptionlistController extends Controller
{




  public function get_values($id)
  {

     $oplist=Option::where('option_id',$id)->first()->optionlists;
     $op_name=Option::find($id)->name;
      $showlinks=false;


     return view('admin.options.getvalues',compact(['oplist','op_name','showlinks','id']));

  }

    public function  search_value($id)
    {
       $word=Request('search_word');


       $oplist=Optionlist::where([['value','like','%'.$word.'%'],['option_id','=',$id]])->get();

       $op_name=Option::find($id)->name;

      // return count($units);
         $showlinks=false;
     if($word!=null && count($oplist)==0)
        {
           session::flash('error-message',$word ." value is not found!!");

        }

         return view('admin.options.getvalues',compact(['oplist','showlinks','id','op_name']));
    }

    public function add_value(Request $req)
    {

        $req->validate([
          'val_name'=>'required',

        ]);

      $name=Request('val_name');

      $option_id=Request('option_id');

       $res= $this->find($name,0,$option_id);

       if($res!=null)
               return $res;//is exist

        $value=new Optionlist();

       $value->value=$name;
       $value->option_id=$option_id;

       $value->save();

    Session::flash("message", "The option [  ". $value->value . "  ] has been added successfully!! ");


     return redirect()->back();




    }


    public function edit_value()
    {

      $name=Request('value_name');
      $oplist_id=Request('edit_modal_value_id');
      $option_id=Request ('option_id');

      $res= $this->find($name,$oplist_id,$option_id);

      if($res!=null)
              return $res;//is exist


      $value=Optionlist::find($oplist_id);

     $value->value=$name;
      $value->save();

  Session::flash("message", "The Option [  ". $value->value . "  ] has been edited successfully!! ");

     return redirect()->back();

    }



    public function delete_value ()
    {

      $id=Request('delete_modal_value_id');
       Optionlist::destroy($id);
       Session::flash("message", "The value has been deleted successfully!! ");

      return redirect()->back();
    }


private function find($name,$oplist_id,$option_id)
{

   if($oplist_id>0)
     $value=Optionlist::where([['value',$name],['option_id','=',$option_id],['optionlist_id','!=',$oplist_id]])->first();
else
    $value=Optionlist::where([['value',$name],['option_id','=',$option_id]])->first();

  if($value!=null)
    {
        Session::flash("error-message", "The value [  ". $name . "  ] is already exist!! ");
         return redirect()->back();
     }


}

public function select_option(Request $req)
{
  // code...
  $option_id= $req->input('option_id');
  $valuelist=optionlist::where('option_id',$option_id)->get();
  return $valuelist;

}

}
