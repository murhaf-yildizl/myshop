<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use Session;
use Illuminate\Pagination\Paginator;

 class UnitController extends Controller
{




 public function index()
 {
  $units=  [

"AS"=>	"Assortment",
"BG"=>	"Bag",
"BA"=>	"Bale",
"BI"=>	"Bar",
"BR"=>	"Barrel",
"BL"=>	"Block",
"B8"=>	"Board",
"BF"=>	"Board Feet",
"BO"=>	"Bottle",
"BX"=>	"Box",
"BN"=>	"Bulk",
"BD"=>	"Bundle",
"BU"=>	"Bushel",
"CN"=>	"Can",
"CG"=>	"Card",
"CT"=>	"Carton",
"CQ"=>	"Cartridge",
"CA"=>	"Case",
"C3"=>	"Centigram",
"CM"=>	"Centiliter",
"1N"=>	"Count",
"CV"=>	"Cover",
"CC"=>	"Cubic Centimeter",
"C8"=>	"Cubic Decimeter",
"CF"=>	"Cubic Feet",
"CI"=>	"Cubic Inches",
"CR"=>	"Cubic Meter",
"CO"=>	"Cubic Meters (Net)",
"MMQ"=>	"Cubic Milimetre",
"CU"=>	"Cup",
"DA"=>	"Days",
"DG"=>	"Decigram",
"DL"=>	"Deciliter",
"DM"=>	"Decimeter",
"CE"=>	"Degrees Celsius (Centigrade)",
"FA"=>	"Degrees Fahrenheit",
"DS"=>	"Display",
"DO"=>	"Dollars, US",
"DZ"=>	"Dozen",
"DR"=>	"Drum",
"EA"=>	"Each",
"EV"=>	"Envelope",
"FT"=>	"Feet",
"UZ"=>	"Fifty Count",
"UY"=>	"Fifty Square Feet",
"FO"=>	"Fluid Ounce",
"GA"=>	"Gallon",
"GR"=>	"Gram",
"GT"=>	"Gross Kilogram",
"HD"=>	"Half Dozen",
"HC"=>	"Houndred Count",
"HL"=>	"Houndred Feet",
"CW"=>	"Houndred Pounds (CWT)",
"IN"=>	"Inches",
"JR"=>	"Jar",
"KE"=>	"Keg",
"KG"=>	"Kilogram",
"DK"=>	"Kilometer",
"KT"=>	"Kit",
"LR"=>	"Layer(s)",
"LF"=>	"Linear Foot",
"LM"=>	"Linear Meter",
"LK"=>	"Link",
"LT"=>	"Liter",
"MR"=>	"Meter",
"MP"=>	"Metric Ton",
"MC"=>	"Microgram",
"4G"=>	"Microliter",
"ME"=>	"Miligram",
"ML"=>	"Mililiter",
"MM"=>	"Milimeter",
"MX"=>	"Mod Pallet (Mixed)",
"58"=>	"Net Kilograms",
"OZ"=>	"Ounces",
"PH"=>	"Pack",
"PK"=>	"Package",
"PA"=>	"Pail",
"PR"=>	"Pair",
"PL"=>	"Pallet",
"PY"=>	"Peck, Dry U.S.",
"P1"=>	"Percent",
"PC"=>	"Piece",
"PT"=>	"Pint",
"PTN"=>	"Portion",
"V2"=>	"Pouch",
"LB"=>	"Pounds",
"PE"=>	"Pounds Equivalent",
"PG"=>	"Pounds Gross",
"PN"=>	"Pounds Net",
"QT"=>	"Quart",
"QS"=>	"Quart, Dry",
"RL"=>	"Roll",
"ST"=>	"Set",
"SH"=>	"Sheet",
"SX"=>	"Shipment",
"FJ"=>	"Sizing Factor",
"SF"=>	"Square Foot",
"SM"=>	"Square Meter",
"SY"=>	"Square Yard",
"15"=>	"Stick",
"TK"=>	"Tank",
"TM"=>	"Thousand Feet",
"TE"=>	"Tote",
"NT"=>	"Trailer",
"TY"=>	"Tray",
"Z25"=>	"Usage  (e.g. in laundry, 24 usage)",
"UN"=>	"Unit",
"YD"=>	"Yard",
   ];

   foreach ($units as $key => $value) {
     $un=new Unit();
     $un->unit_code=$key;
     $un->unit_name=$value;
     $un->save();

     // code...
   }
 }
  public function get_units()
  {


       $units=Unit::paginate(15);

        $showlinks=true;
      return view('admin.units.getunits',compact(['units','showlinks']));

    }

    public function  search_unit()
    {
       $word=Request('search_word');


       $units=Unit::where('unit_name','like','%'.$word.'%')->orWhere('unit_code','like','%'.$word.'%')->get();
      // return count($units);
         $showlinks=false;
     if($word!=null && count($units)==0)
        {
           session::flash('error-message',$word ." unit is not found!!");
           return view('admin.units.getunits',compact(['units','showlinks']));

        }
         return view('admin.units.getunits',compact(['units','showlinks']));
    }

    public function add_unit(Request $req)
    {

        $req->validate([
          'un_name'=>'required | min:3',
          'un_code'=>'required',

        ]);

      $name=Request('un_name');
      $code=Request('un_code');

       $res= $this->find($name,$code,0);

       if($res!=null)
               return $res;//is exist

        $unit=new Unit();

       $unit->unit_name=$name;
       $unit->unit_code=$code;

     $unit->save();

    Session::flash("message", "The Unit [  ". $unit->unit_name . "  ] has been added successfully!! ");


     return redirect()->back();




    }


    public function edit_units()
    {

      $name=Request('unit_name');
      $code=Request('unit_code');
      $id=Request('edit_modal_unit_id');

      $res= $this->find($name,$code,$id);

      if($res!=null)
              return $res;//is exist



     $unit=Unit::find($id);

     $unit->unit_name=$name;
     $unit->unit_code=$code;
     $unit->save();

     $units=Unit::paginate(15);
     Session::flash("message", "The Unit [  ". $unit->unit_name . "  ] has been edited successfully!! ");

     return redirect()->back();

    }



    public function delete_unit ()
    {

      $id=Request('delete_modal_unit_id');
       Unit::destroy($id);
      Session::flash("message", "The Unit has been deleted successfully!! ");

      return redirect()->back();
    }


private function find($name,$code,$id)
{
  $unit_name=Unit::where([['unit_name',$name],['id','!=',$id]])->first();
  $unit_code=Unit::where([['unit_code',$code],['id','!=',$id]])->first();

  if($unit_name!=null)
    {
        Session::flash("error-message", "The Unit Name [  ". $name . "  ] is already exist!! ");
         return redirect()->back();
     }

     if($unit_code!=null)
       {
           Session::flash("error-message", "The Unit code [  ". $code . "  ] is already exist!! ");
            return redirect()->back();
        }

}


}
