<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Session;
use Illuminate\Pagination\Paginator;

 class CategoryController extends Controller
{


  public function get_categories()
  {


       $cats=Category::paginate(15);

        $showlinks=true;
      return view('admin.categories.showcategories',compact(['cats','showlinks']));

    }

    public function  search_cat()
    {
       $word=Request('search_word');


       $cats=Category::where('name','like','%'.$word.'%')->get();
      // return count($units);
         $showlinks=false;
     if($word!=null && count($cats)==0)
        {
           session::flash('error-message',$word ." category is not found!!");
           return view('admin.categories.showcategories',compact(['cats','showlinks']));

        }
         return view('admin.categories.showcategories',compact(['cats','showlinks']));
    }

    public function add_cat(Request $req)
    {

        $req->validate([
          'cat_name'=>'required | min:3',
           ]);

      $name=Request('cat_name');

       $res= $this->find($name,0);

       if($res!=null)
               return $res;//is exist

        $cat=new Category();

       $cat->name=$name;

       $cat->save();

    Session::flash("message", "The category [  ". $name . "  ] has been added successfully!! ");


     return redirect()->back();




    }


    public function edit_cats()
    {

      $name=Request('cat_name');
      $id=Request('edit_modal_cat_id');

      $res= $this->find($name,$id);

      if($res!=null)
              return $res;//is exist



     $cat=Category::find($id);

     $cat->name=$name;
     $cat->save();

     $cats=Category::paginate(15);
     Session::flash("message", "The Category [  ". $cat->name . "  ] has been edited successfully!! ");

     return redirect()->back();

    }



    public function delete_cat ()
    {

      $id=Request('delete_modal_cat_id');
      Category::destroy($id);
      Session::flash("message", "The Category has been deleted successfully!! ");

      return redirect()->back();
    }


private function find($name,$id)
{
  $cat_name=Category::where([['name',$name],['cat_id','!=',$id]])->first();

  if($cat_name!=null)
    {
        Session::flash("error-message", "The Category [  ". $name . "  ] is already exist!! ");
         return redirect()->back();
     }



}


}
