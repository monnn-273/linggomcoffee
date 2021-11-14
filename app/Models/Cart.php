<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Cart extends Model
{
    use HasFactory;

    public function customer(){
        return $this->belongsTo(User::class,'customerId');
    }

    public function product(){
        return $this->belongsTo(Product::class,'productId');
     }
}
