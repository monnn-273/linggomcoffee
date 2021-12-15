@extends('administrator.headerfooter')

@section('title')
  <title>{{config('app_name','Linggom Coffee')}} - Detail Produk </title>
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
      <i class="ni ni-bag-17 text-primary"></i>
      <span class="nav-link-text">Produk</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{__('/admin/order_list')}}.html">
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
  <li class="breadcrumb-item" aria-current="page"><a href="{{__('admin/produk')}}">Produk</a></li>
  <li class="breadcrumb-item active" aria-current="page">Detail Produk</li>
@endsection('path')

@section('content')
    <div class="container-fluid mt--6">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-primary-2">

                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Edit Data Produk </h3>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Gambar Produk</h6>
                    
                    <table class="table table-flush text-center">
                        <tr>       
                            <td colspan="2">
                                <img src="/images/{{$product->gambar}}" alt="gambar_product" style="width:400px; height:440px">
                            </td>
                        </tr>
                    </table>
                    <hr class="my-4" />

                    <h6 class="heading-small text-muted mb-4">Informasi Produk</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-product-name">Nama Produk </label>
                                    <div class="card-body bg-white">
                                        {{$product->nama_produk}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="harga">Harga</label>
                                    <div class="card-body bg-white">
                                        {{$product->harga}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="stock">Stok</label>
                                    <div class="card-body bg-white">
                                        {{$product -> stock}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4" />

                        <h6 class="heading-small text-muted mb-4">Keterangan Tambahan</h6>
                        <div class="row">
                            &nbsp; &nbsp;
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="waktu-preorder">Waktu Preorder</label>
                                    <div class="card-body bg-white">
                                        {{$product->masa_preorder}} hari
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="berat">Berat per kemasan</label>
                                <div class="card-body bg-white">
                                    {{$product->berat}} gram
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="kondisi_produk">Kondisi Produk *</label>
                                <div class="card-body bg-white">
                                    {{$product->kondisi_produk}}
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <h6 class="heading-small text-muted mb-4">Deskripsi Produk</h6>
                        <div class="form-group">
                            <div class="card-body bg-white">
                                {{ $product->deskripsi }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- required scripts -->
    @include('sweetalert::alert')
@endsection('content')

