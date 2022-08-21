<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

   protected $primaryKey='user_id';

   protected $fillable=[
     'user_id',
     'first_name',
     'last_name',
     'email',
     'phone',
     'email_verified',
     'phone_verified',
     'billing_Address_id',
     'shipping_Address_id',
     'password'
   ];

    public function billingAddresses()
    {
      return $this->hasOne(Address::class,'address_id');
    }

    public function shippingAddresses()
    {
      return $this->hasOne(Address::class,'address_id');
    }

    public function orders()
    {
      return $this->hasMany(Order::class,'user_id');
    }

    public function payments()
    {
      return $this->hasMany(Payment::class,'user_id');
    }


    public function shipments()
    {
      return $this->hasMany(Shipment::class,'user_id');
    }


    public function wishlists()
    {
      return $this->hasOne(WichList::class,'user_id');
    }

    public function reviews()
    {
      return $this->hasMany(Review::class,'user_id');
    }

    public function contact_supports()
    {
      return $this->hasMany(ContactSupport::class,'user_id');
    }

    public function roles()
    {
      return $this->belongsToMany(Role::class,'role_user','user_id','role_id');
    }


    public function getFullName()
    {
      return $this->first_name.'  '.$this->last_name;
    }

    /**
     * The attributes that are mass assignable.
     *
     */


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
