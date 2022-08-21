<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Optionlist;

class Option extends Model
{
    use HasFactory;
   protected $primaryKey='option_id';

   public function optionlists()
   {
     return $this->hasMany(Optionlist::class,'option_id');
   }

}
