<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;
use Session;

class OptionController extends Controller
{

   public function get_options()
   {


        $options=Option::paginate(15);

         $showlinks=true;
       return view('admin.options.getoptions',compact(['options','showlinks']));

     }

     public function  search_option()
     {
        $word=Request('search_word');


        $options=Option::where('name','like','%'.$word.'%')->get();
       // return count($units);
          $showlinks=false;
      if($word!=null && count($options)==0)
         {
            session::flash('error-message',$word ." option is not found!!");
            return view('admin.options.getoptions',compact(['options','showlinks']));

         }
          return view('admin.options.getoptions',compact(['options','showlinks']));
     }

     public function add_option(Request $req)
     {

         $req->validate([
           'op_name'=>'required | min:3',

         ]);

       $name=Request('op_name');

        $res= $this->find($name,0);

        if($res!=null)
                return $res;//is exist

         $option=new Option();

        $option->name=$name;

      $option->save();

     Session::flash("message", "The option [  ". $option->name . "  ] has been added successfully!! ");


      return redirect()->back();




     }


     public function edit_options()
     {

       $name=Request('option_name');
       $id=Request('edit_modal_option_id');

       $res= $this->find($name,$id);

       if($res!=null)
               return $res;//is exist



      $option=Option::find($id);

      $option->name=$name;
       $option->save();

      $options=Option::paginate(15);
      Session::flash("message", "The Option [  ". $option->name . "  ] has been edited successfully!! ");

      return redirect()->back();

     }



     public function delete_option ()
     {

       $id=Request('delete_modal_option_id');
      
        Option::destroy($id);
       Session::flash("message", "The option has been deleted successfully!! ");

       return redirect()->back();
     }


 private function find($name,$id)
 {
   $option_name=Option::where([['name',$name],['option_id','!=',$id]])->first();

   if($option_name!=null)
     {
         Session::flash("error-message", "The Option Name [  ". $name . "  ] is already exist!! ");
          return redirect()->back();
      }


 }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        //
    }
}
