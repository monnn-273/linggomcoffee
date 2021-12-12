@extends('administrator.headerfooter')

@section('title')
  <title>{{config('app_name','Linggom Coffee')}} - Produk </title>
@endsection('title')


@section('sidenav')
  <li class="nav-item">
    <a class="nav-link" href="{{__('/admin/dashboard')}}">
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
    <a class="nav-link active" href="{{__('/admin/produk')}}">
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
  <li class="breadcrumb-item active" aria-current="page">Produk</li>
@endsection('path')

@section ('content')
  <div class="container-fluid mt--4">

        <div class="row"> 
          <div class="col-xl-12 col-12">
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

                  </div>
                </div>
              </div>
              <div class="card-body">
                <!-- FITUR TAMBAH PRODUK -->
                <a href="{{__('/admin/tambah_produk')}}" class="btn btn-success ">
                  <i class="ni ni-fat-add"></i>
                  Tambah Produk Baru
                </a>

              <br><br><br>
              <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th>Gambar</th>
                      <th>Nama Produk</th>
                      <th>Harga</th>
                      <th>Stock</th>
                      <th>Deskripsi Singkat</th>
                      <th  class="text-center" colspan="2">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($products as $product)
                    <tr>
                      <th >
                        <a href="/admin/detail_produk?product_id={{$product->id}}">
                          <img src="../images/{{$product->gambar}}" alt="gambar_product" style="width:80px; height:80px">
                        </a>
                      </th>
                      <th>
                        <p class="text-sm">{{$product->nama_produk}} </p>
                      </th>
                      <td>
                          @currency($product->harga)
                      </td>
                      <td>
                        {{$product->stock}}
                      </td>
                      <td>
                        Waktu preorder : {{$product->masa_preorder}} <br>
                        Berat : {{$product->berat}}
                      </td>
                      <td colspan="2">
                        <div class="row">
                          <div class="col-md-4">
                            <a class="btn btn-warning btn-lg" href="/admin/detail_produk?product_id={{$product->id}}"><i class="fa fa-pen" aria-hidden="true"></i></a>
                          </div>
                          <div class="col-md-4">
                            <form action="{{__('/admin/hapus_produk')}}" method="post">
                              @csrf
                              <input type="text" name="produk_id" value="{{$product->id}}" hidden>
                              <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Yakin ingin menghapus data produk? Seluruh data pemesanan dan produk yang berada di keranjang pengguna terkait produk ini akan ikut terhapus.')"><i class="fa fa-trash"></i></button>
                            </form>
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- akhir product list -->

        </div>
        </div>  
      </div>
  </div>
  <!-- required scripts -->
  @include('sweetalert::alert')
@endsection ('content')

