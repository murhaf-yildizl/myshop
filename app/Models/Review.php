<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    public function users()
    {
      return $this->belongsTo(User::class,'user_id');
    }

    public function products()
    {
      return $this->belongsTo(Product::class,'product_id');
    }


    public function print_stars()
    {
      $star="";
      $a=0;
      while ($a < $this->stars) {
            $star="* ".$star;
            $a++;
        // code...
      }

      return $star;;
    }

}
