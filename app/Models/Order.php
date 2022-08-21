<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey='order_id';

    protected $fillable=[
      'user_id',
      'cart_id',


    ];

    public function carts()
    {
      return $this->hasOne(Cart::class,'cart_id');
    }

    public function users()
    {
      return $this->belongsTo(User::class,'user_id');
    }

    public function payments()
    {
      return $this->hasOne(Payment::class,'order_id');
    }

    public function shipments()
    {
      return $this->hasOne(Shipment::class,'order_id');
    }

    public function contact_supports()
    {
      return $this->hasMany(ContactSupport::class,'order_id');
    }
}
