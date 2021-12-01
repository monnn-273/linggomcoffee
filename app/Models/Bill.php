<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CartDetail;
use App\Models\Expedition;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_phone',
        'bill_name',
        'payment',
        'ongkir',
        'customerId',
        'shippingAddress',
        'shipping_status',
        'payment_status',
    ];


    public function customer(){
        return $this->belongsTo(User::class,'customerId');
    }

    public function cartDetail(){
        return $this->hasMany(CartDetail::class);
    }

    public function expedition(){
        return $this->hasOne(Expedition::class);
    }


}
