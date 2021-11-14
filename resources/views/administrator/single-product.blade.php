@extends('administrator.headerfooter')

@section('sidenav')
  <li class="nav-item">
    <a class="nav-link" href="{{__('/admin/dashboard')}}">
      <i class="ni ni-tv-2 text-primary"></i>
      <span class="nav-link-text">Dashboard</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{__('/admin/profile')}}">
      <i class="ni ni-single-02 text-yellow"></i>
      <span class="nav-link-text">Profile</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{__('/admin/produk')}}">
      <i class="ni ni-bag-17 text-default"></i>
      <span class="nav-link-text">Products</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{__('/admin/order_list')}}.html">
      <i class="ni ni-bullet-list-67 text-default"></i>
      <span class="nav-link-text">Order List</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{__('/admin/history')}}">
      <i class="ni ni-archive-2 text-default"></i>
      <span class="nav-link-text">History Penjualan</span>
    </a>
  </li>
@endsection('sidenav')

@section('path')
  <li class="breadcrumb-item" aria-current="page">Produk</li>
  <li class="breadcrumb-item active" aria-current="page">Detail Produk</li>
@endsection('path')

@section('content')
<div class="container-fluid mt--6">
    <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Edit Data Produk </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- UPDATE FORM -->
              <form action="{{__('/admin/update_produk')}}" method="post" enctype="multipart/form-data">
              @csrf
                <input type="text" value="{{$product->id}}" name="produk_id" hidden>
                <h6 class="heading-small text-muted mb-4">Gambar Produk</h6>
                
                <table class="table table-flush text-center">
                  <tr>       
                      <td colspan="2">
                        <img src="../images/{{$product->gambar}}" alt="gambar_product" style="width:400px; height:440px">
                      </td>
                  </tr>
                </table>

                <div class="col-lg-8">
                  <div class="form-group">
                    <label class="form-control-label">Ubah gambar</label>
                    <div class="input-group mb-3">
                      <div class="custom-file">
                        <input type="file" name="gambar">  
                      </div>
                    </div>
                  </div>
                </div>               
                <hr class="my-4" />

                <h6 class="heading-small text-muted mb-4">Informasi Produk</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-product-name">Nama Produk</label>
                        <input type="text" id="input-product-name" class="form-control" placeholder="nama produk" value="{{$product->nama_produk}}" name="nama_produk">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="harga">Harga</label>
                        <input type="string" id="harga" class="form-control" placeholder="contoh: 25000" value="{{$product->harga}}" name="harga">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="stock">Stock</label>
                        <input type="number" id="stock" class="form-control" placeholder="contoh: 20" value="{{$product->stock}}" name="stock">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />

                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">Deskripsi Produk</h6>
                <div class="pl-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Deskripsikan produk Anda</label>
                    <textarea rows="10" col="30" class="form-control" placeholder="Kata-kata yang menjelaskan produk Anda secara singkat, padat, dan jelas" name="deskripsi">{{$product->deskripsi}}</textarea>
                  </div>
                </div>

                <div class="row justify-content-end container">
                  <button type="submit" class="btn btn-success d-inline">Simpan Perubahan</button>
              </form>
              <!-- END UPDATE FORM-->
                <form action="{{__('/admin/hapus_produk')}}" method="post">
                  @csrf
                  <input type="text" value="{{$product->id}}" name="produk_id" hidden>
                  <button type="submit" class="btn btn-danger d-inline show_confirm" data-toggle="tooltip" title='Delete'>Hapus produk</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>


<!-- required scripts -->
@include('sweetalert::alert')
@endsection('content')