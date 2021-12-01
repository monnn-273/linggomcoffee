<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Bill;

class Expedition extends Model
{
    use HasFactory;

    public function bills(){
        return $this->belongsTo(Bill::class,'bill_id');
    }
}
