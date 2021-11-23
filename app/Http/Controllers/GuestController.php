<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
        $products = Product::paginate(4);
        return view('guest.main-home', compact('products'));
    }

    
    public function profile(){
        return view('guest.profile');
    }

    public function showProduct(){  
        $products = DB::table('products')
                  ->orderBy('nama_produk')
                  ->get();
        return view('guest.products',compact('products'));
      }

}
