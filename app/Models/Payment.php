<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
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

    public function shipments()
    {
      return $this->belongsTo(Shipment::class,'payment_id');
    }
}
