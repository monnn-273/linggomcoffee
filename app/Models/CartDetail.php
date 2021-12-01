<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CartDetail;
use App\Models\Bill;
use App\Models\Product;

class CartDetail extends Model
{
    use HasFactory;

    protected $table = 'cart_details';

    public function customer(){
        return $this->belongsTo(User::class,'customerId');
    }

    public function products(){
        return $this->belongsTo(Product::class,'productId');
    }

    public function bills(){
        return $this->belongsTo(Bill::class,'bill_id');
    }
}
