<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\CartDetail;
use App\Models\Cart;
use App\Models\Bill;
use App\Models\Expedition;
use Carbon\Carbon;



class AdminController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }
    public function index() 
    {
        $cartDetails = CartDetail::all();
        // Daftar Pesanan adalah pesanan yang pembayarannya belum diverifikasi ataupun produknya belum dikirimkan
        $bills = Bill::where('payment_status','not verified')
                ->orWhere('shipping_status','!=','sudah dikirim')
                ->get();

        //Data yang ada pada history penjualan adalah produk yang pembayarannya sudah diverifikasi dan produk sudah dikirim
        $bills2 = Bill::where('payment_status','verified')->get();
        $products = Product::paginate(3);
        $sold = Bill::where('payment_status', 'verified')->sum('payment');
        $user = User::where('role', 'user')->count();
        return view('administrator.dashboard', compact('products','bills','bills2','cartDetails','sold','user'));
    }
    public function order_list() 
    {
        $bills = Bill::where('payment_status','not verified')
                ->orWhere('shipping_status','!=','sudah dikirim')
                ->paginate(5);
        $cartDetails = CartDetail::all(); 
        return view('administrator.order_list',compact('bills','cartDetails'));
    }
    
    public function product() 
    {
        $products = Product::all();
        return view('administrator.product',compact('products'));
    }

    public function profile() 
    {
        return view('administrator.profile');
    }

    public function history() 
    {
        // data penjualan yang ditampilkan adalah data penjualan yang pembarayannya sudah terverifikasi
        $cartDetails = CartDetail::all(); 
        $bills = Bill::where('payment_status', 'verified')->get();
        return view('administrator.history', compact('bills','cartDetails'));
    }

    public function single_product(Request $request)
    {
        $id = $request->product_id;    
        $product = Product::find($id);

       return view('administrator.single-product', compact('product'));
    }

    //  fungsi delete produk
    public function delete(Request $request) 
    {
        Cart::where('productId',$request->produk_id)->delete();
        CartDetail::where('productId',$request->produk_id)->delete();
        $product = Product::find($request->produk_id);
        unlink("images/".$product->gambar);
        $product->delete();
        return redirect('/admin/produk')->withSuccess('Data produk berhasil dihapus!');
    }

    // update data produk
    public function update_product(Request $request)
    {
        $product = Product::find($request->produk_id);
        //memeriksa validasi inputan
        $this->validate($request, [
            'nama_produk' => 'required|string|min:3',
            'harga' => 'required',
            'stock' => 'required',
            'deskripsi'=>'required',
        ]);
 
        Product::where('id', $request->produk_id)->update([
            'nama_produk' => htmlspecialchars($request->nama_produk),
            'harga' => htmlspecialchars($request->harga),
            'stock' =>htmlspecialchars($request->stock),
            'deskripsi' =>htmlspecialchars($request->deskripsi),
            'masa_preorder' =>htmlspecialchars($request->masa_preorder),
            'kondisi_produk' =>htmlspecialchars($request->kondisi_produk),
            'berat' =>htmlspecialchars($request->berat),
        ]);
 
        if($request->hasFile('gambar'))
        {

            //hapus foto yang lama 
            //memeriksa validasi inputan file gambar
            $this->validate($request, [
                'gambar' => 'required|image|mimes:jpg,png,jpeg|max:2048'
            ]);
            unlink("images/".$request->old_gambar);
            $location = public_path('images');
            $request-> file('gambar')->move($location, $request->file('gambar')->getClientOriginalName());
            $product->gambar = $request->file('gambar')->getClientOriginalName();
        }
        $product->save();
        return redirect('/admin/produk')->withSuccess('Perubahan berhasil disimpan!');
    }

    public function add_product_page()
    {
        return view('administrator.add_product');
    }

    //fungsi untuk menambah produk baru baru
    public function store(Request $request)
    {
        $product = new Product;
        $product->nama_produk = htmlspecialchars($request->nama_produk);
        $product->harga= htmlspecialchars($request->harga);
        $product->stock = htmlspecialchars($request->stock);
        $product->deskripsi = htmlspecialchars($request->deskripsi);
        $product->masa_preorder = htmlspecialchars($request->masa_preorder);
        $product->berat = htmlspecialchars($request->berat);
        $product->kondisi_produk = htmlspecialchars($request->kondisi_produk);
        
        
        if($request->hasFile('gambar')){
            //memeriksa validasi inputan file gambar
            $this->validate($request, [
                'gambar' => 'required|image|mimes:jpg,png,jpeg|max:2048'
            ]);

                $location = public_path('images');
                $request-> file('gambar')->move($location, $request->file('gambar')->getClientOriginalName());
                $product->gambar = $request->file('gambar')->getClientOriginalName();
                $product->save();
            }

        return redirect('/admin/produk')->withSuccess("Produk baru telah ditambahkan!");
    }


    //fungsi update profile admin
    public function update_profile(Request $request)
    {
        $user = User::find($request->user_id);

        // ddd($user);
 
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
             'role'=> "admin",
        ]);
  
        return redirect('/admin/myprofile')->withSuccess('Profile Anda sudah diperbaharui!');
    }

    public function editBills(Request $request)
    {
        $bill = Bill::where('id', $request->bill_id)->get();
        $cartDetails = CartDetail::where('bill_id', $request->bill_id)->get();

        return view('administrator.edit_bills',compact('bill','cartDetails'));
    }

    public function updateBills(Request $request)
    {
        Bill::where('id', $request->bill_id)->update([
            'shipping_status' => htmlspecialchars($request->shipping_status),
            'payment_status' => htmlspecialchars($request->payment_status),
        ]);

        return redirect('/admin/order_list')->withSuccess('Data pesanan pelanggan berhasil diubah! Pantau terus daftar pesanan Anda agar tidak ada pesanan yang terlewatkan!');
    }

    public function deleteBills(Request $request)
    {
        CartDetail::where('bill_id', $request->bill_id)->delete();
        Expedition::where('bill_id', $request->bill_id)->delete();
        Bill::where('id', $request->bill_id)->delete();

        return redirect('/admin/order_list')->withSuccess('Data pesanan pelanggan berhasil dihapus!');
    }

    public function billDetail(Request $request)
    {
        $bill = Bill::where('id', $request->bill_id)->get();
        $cartDetails = CartDetail::where('bill_id', $request->bill_id)->get();
        return view('administrator.bill_detail', compact('bill','cartDetails'));
    }

    public function users()
    {
        $users = User::orderBy('role')->get();
        return view('administrator.users',compact('users'));
    }

    public function update_user(Request $request)
    {
        User::where('id',$request->user_id)->update([
            "role" => "admin",
        ]);

        return redirect('/admin/users')->withSuccess('Data Pengguna berhasil diubah! Website memiliki Administrator baru.');
    }

    public function update_admin(Request $request)
    {
        User::where('id',$request->user_id)->update([
            "role" => "user",
        ]);

        return redirect('/admin/users')->withSuccess('Data Pengguna berhasil diubah! Administrator kembali menjadi user biasa.');
    }

    public function delete_user(Request $request)
    {
        Cart::where('customerId',$request->user_id)->delete();
        $bill_id = Bill::where('customerId',$request->user_id)->select('id')->get();
        Bill::where('customerId',$request->user_id)->delete();
        if($bill_id->count() > 0)
        {
            Expedition::where('bill_id', $bill_id)->delete();
        }
        CartDetail::where('customerId',$request->user_id)->delete();
        User::where('id', $request->user_id)->delete();

        return redirect('/admin/users')->withSuccess('Data Pengguna berhasil Dihapus!');
    }

    public function single_product_read(Request $request)
    {
        $id = $request->produk_id;    
        $product = Product::find($id);

       return view('administrator.single_product2', compact('product'));
    }

    


    
}