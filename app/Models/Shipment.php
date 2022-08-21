<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    public function users()
    {
      return $this->belongsTo(User::class,'user_id');
    }

    public function orders()
    {
      return $this->belongsTo(Order::class,'order_id');
    }

    public function payments()
    {
      return $this->hasOne(payments::class,'payment_id');
    }
}
