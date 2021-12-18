<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Models\Bill;
use App\Models\CartDetail;
use App\Models\Province;
use App\Models\City;
use App\Models\Courier;
use App\Models\Expedition;

class UserController extends Controller
{
    public function __construct() 
    {
      $this->middleware('auth');
    }

    public function index()
    {
      $products = Product::paginate(4);
      return view('user.dashboard',compact('products'));
    }

    public function showprofile()
    {
      return view('user.profile');
    }

    public function showCart()
    {
      $couriers = Courier::pluck('expedition_name','code');
      $provinces = Province::pluck('province_name','province_id');
      $carts = Cart::all()->where('customerId', Auth::user()->id);

      return view('user.cart', compact('carts','couriers','provinces'));
    }

    public function addToCart(Request $request)
    {
      $collection = Cart::where([
        ['customerId', '=', $request->customerId],
        ['productId', '=', $request->productId]
      ])->count();

      if ( $collection > 0)
      {
        // untuk menambahkan jumlah kuantitas barang jika barang yang di tambahkan ke cart sebelumnya sudah ada di cart
        Cart::where
        ([
              ['customerId', '=', $request->customerId],
              ['productId', '=', $request->productId]
        ])->increment('quantity');

        // quantity untuk mengalikan total harga pembayaran
        $quantity = Cart::where
        ([
              ['customerId', '=', $request->customerId],
              ['productId', '=', $request->productId]
        ])->select('quantity')->get();

        // mengupdate data pembayaran per jenis produk
        Cart::where
        ([
              ['customerId', '=', $request->customerId],
              ['productId', '=', $request->productId]
        ])->update([
          'payment' => htmlspecialchars($request->price * $quantity[0]["quantity"]),
        ]);
      }

      // jika produk memang belum pernah ditambahkan ke cart
      else
      {
        $cart = new Cart;
        $cart->productId = htmlspecialchars($request->productId);
        $cart->customerId= htmlspecialchars($request->customerId);
        $cart->quantity = 1;
        $cart->payment =  htmlspecialchars($request->price); 
        $cart->save();
      }

      return back()->with('status','Produk dalam keranjang belanja Anda sudah diperbaharui!');
    }

    // fungsi untuk menmapilkan semua produk dirutukan berdasarkan nama
    public function showProduct()
    {  
      $products = Product::orderBy('nama_produk')->get();
      return view('user.product',compact('products'));
    }

    // menampilkan profile pengguna
    public function showMyProfile()
    {  
      return view('user.myprofile');
    }

    //fungsi update profile user
    public function updateProfile(Request $request)
    {   
      //memeriksa validasi inputan // diubah menjadi validasi form html
      // $this->validate($request, [
      //     'name'    => 'required|alpha|string|max:30|min:3',
      //     'email'   => 'required|string|email|max:255',
      //     'address' => 'string|min:10|max:100',
      //     'no_telp' => 'string|min:10|max:100',
          
      // ]);

      User::where('id', $request->user_id)->update([
          'name' => htmlspecialchars($request->name),
          'email' => htmlspecialchars($request->email),
          'address' =>htmlspecialchars($request->address),
          'no_telp' => htmlspecialchars($request->no_telp),
          'role'=> "user",
      ]);

      return back()->with('status', 'Your profile has been updated!');
    }

    // mengupdate kuantitas barang di cart
    public function updateQuantity(Request $request)
    {
      $cart = Cart::find($request->cart_id);
      $quantity = $request->quantity;


      Cart::where('id', $request->cart_id)->update([
        'quantity' => htmlspecialchars($request->quantity),
        'payment' => htmlspecialchars($quantity * $request->price),
      ]);

      return back()->with('status','Kuantitas berhasil diubah!');
    }

    // menghapus data produk dari cart
    public function deleteCart(Request $request) 
    {
      $cart = Cart::find($request->id);
      $cart->delete();
      return back()->with('status', 'Produk berhasil dihapus dari keranjang!');
    }

    // Menambahkan data detail cart, bill, dan ekspedisi jika pengguna sudah mengklik "pesanan"
    public function addBill(Request $request)
    {
        $products = Cart::where('customerId',$request->customerId)->get();
        $payment = $request->payment;
        $shippingAddress = $request->shippingAddress;
        $receiverName = $request->bill_name;
        $receiverContact = $request->bill_phone;

        // menambahkan data ke database bills
        $bill = new Bill;
        $bill->payment          = htmlspecialchars($request->payment);
        $bill->ongkir           = htmlspecialchars($request->ongkir);
        $bill->customerId       = htmlspecialchars($request->customerId);
        $bill->bill_name        = htmlspecialchars($request->bill_name);
        $bill->bill_phone       = htmlspecialchars($request->bill_phone);
        $bill->shippingAddress  = htmlspecialchars($request->shippingAddress);
        $bill->save();

        foreach($products as $bought_product)
        {
          $cart_details = new CartDetail;
          $cart_details -> productId = $bought_product->productId;
          $cart_details -> customerId = $request->customerId;
          $cart_details -> bill_id = $bill->id;
          $cart_details -> quantity = $bought_product->quantity;
          $cart_details->save();
        }

        //menambahkan data expedition baru
        $expedition = new Expedition;
        $expedition -> bill_id = $bill->id;
        $expedition -> postal_code = $request->postalCode;
        $expedition -> courier = $request->courier;
        $expedition -> service = $request->service;
        $expedition -> cost = $request->ongkir;
        $expedition -> etd = $request->etd;
        $expedition -> weight = $request -> weight;
        $expedition -> city_origin = $request->city_origin;
        $expedition -> city_destination = $request -> city_destination;
        $expedition -> save();

        // menghapus data dari cart karena sudah di checkout
        Cart::where('customerId',$request->customerId)->delete();
        //menyimpan data di bills sesuai customer Id supaya bisa ditampilkan di view detail checkoutnya
        $products = CartDetail::where('customerId', $request->customerId) -> groupBy('bill_id');

        return redirect('/user/history')->with('status', 'Orderan Anda berhasil kami terima!');
    }

    // menampilkan riwayat pembelia yang pernah dilakukan user
    public function history()
    {
      $cartDetails = CartDetail::where('customerId', Auth::user()->id)->get();
      $bills = Bill::where('customerId', Auth::user()->id)->orderBy('created_at')->get();
      $expeditions = Expedition::all();
      return view('user.history', compact('cartDetails','bills','expeditions'));
    }

    // halaman bill untuk mendapatkan semua parameter yg diperlukan untuk addBill()
    public function bill_page(Request $request)
    {
      $courier  = $request->all();
      $carts = Cart::all()->where('customerId', Auth::user()->id);
      // dd($courier);
      return view('user.bills',compact('courier','carts'));
    }


    // keperluan Ongkos Kirim
    public function getCities($id)
    {
        $cities = City::where('province_id', $id)->pluck('city_name','city_id');
        return json_encode($cities);
    }

    public function submit(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => $request->city_origin,
            'destination'   => $request->city_destination,
            'weight'        => $request-> weight,
            'courier'       => $request->courier,

        ])->get();
        return response()->json($cost);
    }

    public function payment_evd(Request $request)
    {
      $bill = Bill::find($request->bill_id);
      if($request->hasFile('payment_evd'))
      {

          //hapus foto yang lama 
          //memeriksa validasi inputan file gambar
          $this->validate($request, [
              'payment_evd' => 'required|image|mimes:jpg,png,jpeg|max:2048'
          ]);
          $location = public_path('images');
          $request-> file('payment_evd')->move($location, $request->file('payment_evd')->getClientOriginalName());
          $bill->payment_evd = $request->file('payment_evd')->getClientOriginalName();
          $bill->save();
      }

      Bill::where('id', $request->bill_id)->update([
        'payment_status' => 'Sedang menunggu verifikasi',
      ]);

      return redirect('/user/history')->with('status','Bukti Pembayaran Terkirim!');
      
    }


}
