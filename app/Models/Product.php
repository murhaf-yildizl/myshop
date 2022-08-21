<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey='product_id';
    protected $fillable=['product_id','unit_id'];

    public function images()
    {
      return $this->hasMany(Image::class,'product_id');
    }

    public function units()
    {
      return $this->belongsTo(Unit::class,'unit_id');
    }

    public function categories()
    {
      return $this->belongsTo(Category::class,'cat_id');
    }

    public function reviews()
    {
      return $this->hasMany(Review::class,'product_id');
    }


    public function tags()
    {
      return $this->belongsToMany(Tag::class,'product_tag','product_id','tag_id');
    }

    public function optionlists()
    {
      return $this->belongsToMany(Optionlist::class,'option_product','product_id','option_id');
    }
}
