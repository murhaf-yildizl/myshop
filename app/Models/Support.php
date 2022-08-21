<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;
    protected $primaryKey='support_id';

    protected $fillable=[
      'type',
    ];

    public function contact_supports()
    {
      return $this->hasMany(ContactSupport::class,'support_id');
    }
}
