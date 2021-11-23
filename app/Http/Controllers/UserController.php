<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

    public function addToCart(Request $request){
      $cart = new Cart;
      $cart->productId = htmlspecialchars($request->productId);
      $cart->customerId= htmlspecialchars($request->customerId);
      $cart->quantity = 1;
      $cart->payment =  htmlspecialchars($request->price); 
  
      $cart->save();

      return back()->with('status','success');
    }

    public function showCheckout(){  
      return view('user.checkout');
    }

    public function showProduct(){  
      $products = DB::table('products')
                ->orderBy('nama_produk')
                ->get();
      return view('user.product',compact('products'));
    }

    public function showMyProfile(){  
      return view('user.myprofile');
    }

    //fungsi update profile user
    public function updateProfile(Request $request)
    {
      // $user = User::find($request->user_id);

      //  ddd($user);

        //memeriksa validasi inputan
        $this->validate($request, [
            'name' => 'required|string|max:30|min:3',
            'email' => 'required|string|email|max:255',
            'address'=> 'string|min:10|max:100',
            'no_telp'=> 'string|min:10|max:100',
        ]);

        User::where('id', $request->user_id)->update([
            'name' => htmlspecialchars($request->name),
            'email' => htmlspecialchars($request->email),
            'address' =>htmlspecialchars($request->address),
            'no_telp' => htmlspecialchars($request->no_telp),
            'role'=> "user",
        ]);

        return redirect('/user/dashboard')->with('status', 'Your profile has been updated!');
    }

    public function updateQuantity(Request $request){
      $cart = Cart::find($request->cart_id);

      Cart::where('id', $request->cart_id)->update([
        'quantity' => htmlspecialchars($request->quantity),
        'payment' => htmlspecialchars($request->quantity * $request->price),
      ]);

      return back()->with('status','update success');
    }

    public function deleteCart(Request $request) {
      // Memilih data dari database berdasarkan id dan menghapusnya dengan fungsi delete()
      // lalu kembali ke halaman data produk
      $cart = Cart::find($request->id);
      $cart->delete();

      return back()->with('status', 'success');
  }

}
