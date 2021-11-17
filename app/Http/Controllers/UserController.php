<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;

class UserController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function index() {
      
      $products = Product::paginate(4);
      return view('user.dashboard',compact('products'));
    }

    public function showprofile(){
      return view('user.profile');
    }

    public function showCart(Request $request){
      $customerId = $request->customerId;
      $carts = Cart::all()->where('customerId', $customerId);

      return view('user.cart', compact('carts'));

    }

    public function addCart(Request $request){
      $cart = new Cart;
      $cart->productId = htmlspecialchars($request->productId);
      $cart->customerId= htmlspecialchars($request->customerId);
      $cart->quantity = 1;
      $cart->payment = $request->quantity * $request->price; 
      $cart->payment_status = $request->payment_status;     
      $cart->save();
      return back();
    }

    public function showCheckout(){  
      return view('user.checkout');
    }
}
