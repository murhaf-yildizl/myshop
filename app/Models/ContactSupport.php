<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSupport extends Model
{
    use HasFactory;

    protected $primaryKey='contact_id';
    protected $fillable=[
      'title',
      'content',
      'user_id',
      'order_id',
      'support_id',

    ];

    public function supports()
    {
      return $this->belongsTo(Support::class,'support_id');
    }

    public function users()
    {
      return $this->belongsTo(User::class,'user_id');
    }

    public function orders()
    {
      return $this->belongsTo(Order::class,'order_id');
    }

}
