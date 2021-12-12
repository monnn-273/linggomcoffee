@extends('administrator.headerfooter')

@section('title')
  <title>{{config('app_name','Linggom Coffee')}} - Dashboard </title>
@endsection('title')

@section('sidenav')
  <li class="nav-item">
    <a class="nav-link active" href="{{__('/admin/dashboard')}}">
      <i class="ni ni-tv-2 text-primary"></i>
      <span class="nav-link-text">Dashboard</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{__('/admin/myprofile')}}">
      <i class="ni ni-single-02 text-primary"></i>
      <span class="nav-link-text">Profile Saya</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{__('/admin/users')}}">
      <i class="fa fa-user-friends text-primary"></i>
      <span class="nav-link-text">Pengguna</span>
    </a>

  <li class="nav-item">
    <a class="nav-link" href="{{__('/admin/produk')}}">
      <i class="ni  ni-bag-17 text-primary"></i>
      <span class="nav-link-text">Produk</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{__('/admin/order_list')}}">
      <i class="ni ni-bullet-list-67 text-primary"></i>
      <span class="nav-link-text">Daftar Pesanan</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{__('/admin/history')}}">
      <i class="fa fa-history text-primary" aria-hidden="true"></i>
      <span class="nav-link-text">Riwayat Penjualan</span>
    </a>
  </li>
@endsection('sidenav')

@section('path')
  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection('path')

@section('content')
    <!-- Page content -->
    <div class="container-fluid mt--6">

      <!-- product list -->
      <div class="row"> 
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">Products List</h6>
                  <h5 class="h3 mb-0">Linggom Coffee Products</h5>
                  <br>
                    @if(session('status'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                          <span class="alert-text"><strong>Success!</strong> {{session('status')}}</span>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                    @endif
                    <br>
                </div>
              </div>
            </div>
            <div class="card-body">
              <a href="{{__('/admin/tambah_produk')}}" class="btn btn-success ">
                <i class="ni ni-fat-add"></i>
                Tambah Produk Baru
              </a>
              <br><br>
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Gambar</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col" class="text-center" colspan="2">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $product)
                  <tr>
                    <th scope="row">
                      <a href="/admin/detail_produk?product_id={{$product->id}}">
                        <img src="../images/{{$product->gambar}}" alt="gambar_product" style="width:100px; height:100px">
                      </a>
                    </th>
                    <th scope="row">
                      {{$product->nama_produk}}
                    </th>
                    <td>
                        @currency($product->harga)
                    </td>
                    <td>
                      {{$product->stock}}
                    </td>
                    <td>
                      Waktu preorder: {{$product->masa_preorder}} <br>
                      Berat : {{$product->berat}} gram <br>
                    </td>
                    <td colspan="2">
                      <div class="row justify-content-center">
                        <div class="col-md-4">
                          <a class="btn btn-warning btn-lg" href="/admin/detail_produk?product_id={{$product->id}}"><i class="fa fa-pen" aria-hidden="true"></i>&nbsp;Edit</a>
                        </div>
                        &nbsp;
                        <div class="col-md-4">
                          <form action="{{__('/admin/hapus_produk')}}" method="post">
                            @csrf
                            <input type="text" name="produk_id" value="{{$product->id}}" hidden>
                            <button type="submit" class="btn btn-danger btn-lg d-inline" onclick="return confirm('Yakin ingin menghapus produk ini? Anda tidak akan dapat mengembalikan data produk setelah dihapus.')"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                          </form>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="7" class="text-center"><a href="{{('/admin/produk')}}" class="btn btn-primary">Semua Produk</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- akhir product list -->

      
      <div class="row">
        
        <!-- list orderan -->
        <div class="col-xl-8">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Daftar Pesanan</h3>
                </div>
                <div class="col text-right">
                  <a href="{{__('/admin/order_list')}}" class="btn btn-primary">Semua Pesanan</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- tabel pesanan -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Nama Pemesan</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Status Pembayaran</th>
                    <th scope="col">Status Pengiriman</th>
                  </tr>
                </thead>
                <tbody>
                  @if($bills->count() == 0)
                  <tr>
                    <th scope="row"><h5> Saat ini Anda belum menerima pesanan apapun.</h5></th>
                  </tr>
                    </td>
                  </tr>
                  @endif
                  @foreach($bills as $bill)
                  <tr>
                    <th scope="row">{{$bill->customer->name}}</th>
                    <td>
                      @foreach($cartDetails as $cartDetail)
                        @if($cartDetail->bill_id == $bill->id)
                          {{$cartDetail->products->nama_produk}} x <strong> {{$cartDetail->quantity}} </strong>
                          <br>
                        @endif
                      @endforeach
                    </td>
                    <td>
                      {{$bill->payment_status}}
                    </td>
                    <td>
                      {{$bill->shipping_status}}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- akhir list orderan -->

        <!-- history penjualan -->
        <div class="col-xl-4">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Riwayat Penjualan</h3>
                </div>
                <div class="col text-right">
                  <a href="{{__('/admin/history')}}" class="btn btn-sm btn-primary">Riwayat Penjualan</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Customer</th>
                    <th scope="col">Total Pembelian</th>
                  </tr>
                </thead>
                <tbody>
                  @if($bills2->count() == 0)
                  <tr>
                    <td>
                      <h5>Saat ini Anda belum memiliki riwayat penjualan melalui website ini.</h5>
                    </td>
                  </tr>
                  @endif
                  @foreach($bills2 as $bill)
                  <tr>
                    <th scope="row">{{$bill->bill_name}}</th>
                    <td>@currency($bill->payment)</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="2"><strong><h4>Total Penjualan : @currency($sold)</h4></strong></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- akhir history penjualan -->
      </div>
    </div>
@endsection('content')


