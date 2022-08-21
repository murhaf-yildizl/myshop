<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Optionlist extends Model
{
    use HasFactory;
    protected $primaryKey='optionlist_id';

    public function options()
    {
      return $this->belongsTo(Option::class,'option_id');
    }

    public function products()
    {
      return $this->belongsToMany(Product::class,'option_product','option_id','product_id');
    }
}
