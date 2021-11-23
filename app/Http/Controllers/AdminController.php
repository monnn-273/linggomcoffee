<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        $products = Product::paginate(3);
        return view('administrator.dashboard', compact('products'));
    }
    public function order_list() {
        return view('administrator.order_list');
    }
    
    public function product() {
        $products = Product::all();
        return view('administrator.product',compact('products'));
    }

    public function profile() {
        return view('administrator.profile');
    }

    public function history() {
        return view('administrator.history');
    }

    public function single_product(Request $request){
        $id = $request->product_id;    
        $product = Product::find($id);

       return view('administrator.single-product', compact('product'));
    }

      //fungsi delete produk
    // public function destroy(Request $request)
    // {
    //     $produk_id = $request->produk_id;
    //     $destroy_product = Product::findOrFail($produk_id);
    //     $destroy_product->delete();
    //     return redirect('/admin/produk')->with('delete_status', 'Data produk telah dihapus!');
    // }
    public function delete($id) {
        // Memilih data dari database berdasarkan id dan menghapusnya dengan fungsi delete()
        // lalu kembali ke halaman data produk
        $product = Product::find($id);
        unlink("images/".$product->gambar);
        $product->delete();

        return redirect('/admin/produk')->with('delete_status', ' Data produk telah dihapus!');
    }

     
    public function update(Request $request, $id)
    {
        $product = Product::find($id);  
 
        //memeriksa validasi inputan
        // $this->validate($request, [
        //     'nama_produk' => 'required|string|min:3',
        //     'harga' => 'required',
        //     'stock' => 'required',
        //     'deskripsi'=>'required',
        // ]);
 
        // Product::where('id', $request->produk_id)->update([
        //     'nama_produk' => htmlspecialchars($request->nama_produk),
        //     'harga' => htmlspecialchars($request->harga),
        //     'stock' =>htmlspecialchars($request->stock),
        //     'deskripsi' =>htmlspecialchars($request->deskripsi),
        // ]);
        
        // $this->validate($request, [
        //     'nama_produk' => 'required | min:6',
        //     'gambar' => 'image|mimes:jpg,png,jpeg|max:2048',
        //     'harga' => 'required | numeric',
        //     'masa_preorder' => 'required | numeric',
        //     'kondisi_produk' => 'required',
        //     'berat' => 'required | numeric',
        //     'stock' => 'required | numeric',
        //     'deskripsi' => 'required | max:500',
        // ]);
        $product->update($request->all());

        //memeriksa apakah inputan file gambar
        if($request->hasFile('gambar')){
            // Mengambil gambar dan menyimpannya di folder tujuan dengan nama asli
            $request->file('gambar')->move('images/products/', $request->file('gambar')->getClientOriginalName());
            $product->gambar = $request->file('gambar')->getClientOriginalName();
            $product->save();
        }
        // if($request->hasFile('gambar')){
            //validasi format file gambar
            // $this->validate($request, [
            //     'gambar' => 'image|mimes:jpg,png,jpeg|max:2048',
            // ]);
 
            // $location = public_path('images');
            // $request-> file('gambar')->move($location, $request->file('gambar')->getClientOriginalName());
            // $product->gambar = $request->file('gambar')->getClientOriginalName();
            // $product->save();
        // }
  
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
        $product->deskripsi = htmlspecialchars($request->description);
        $product->masa_preorder = htmlspecialchars($request->masa_preorder);
        $product->berat = htmlspecialchars($request->berat);
        $product->kondisi_produk = 'kopi bubuk';
        
        
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


    public function add_administrator_page()
    {
        return view('administrator.add_administrator');
    }


    //fungsi untuk menyimpan data pengguna baru
    public function store_admin(Request $request){

        //memeriksa valdasi inputan file gambar, nama, dan email
        $this->validate($request, [
            'name'  => 'required|alpha|string|max:30|min:3',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|password|min:8|max:255',
        ]);


        $user = new User;
        $user->name= htmlspecialchars($request->name);
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); 
        $user->save();

        return redirect('/admin/dashboard')->withSuccess("Admin baru sudah ditambahkan!");
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
  
         return redirect('/admin/myprofile')->with('status', 'Your profile has been updated!');
     }
 

    
}