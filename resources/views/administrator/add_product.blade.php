@extends('administrator.headerfooter')

@section('title')
  <title>{{config('app_name','Linggom Coffee')}} - Tambah Produk </title>
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
  <li class="breadcrumb-item active" aria-current="page"><a href="{{__('/admin/produk')}}">Produk</a></li>
  <li class="breadcrumb-item active" aria-current="page">Tambah Produk Baru</li>
@endsection('path')


@section('content')
  <br><br><br>
  <div class="col-xl-10 order-xl-1 justify-content-center">

    <!-- card header -->
    <div class="card">

      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-8">
            <h3 class="mb-0"><strong>Tambahkan Produk Baru</strong></h3>
          </div>
          <div class="col-4 text-right">
            <a href="{{__('/admin/dashboard')}}" class="text-warning">Batalkan</a>
          </div>
        </div>
      </div>

      <div class="card-body">
        <!-- FORM TAMBAH PRODUK -->
        <form action="{{__('/admin/store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <h6 class="heading-small text-muted mb-4">Informasi Produk</h6>
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="image">Tambahkan gambar</label> <br>
                  <input type="file" name="gambar">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-product-name">Nama Produk</label>
                  <input type="text" id="input-product-name" class="form-control  @error('password') is-invalid @enderror" placeholder="Contoh : Bubuk Kopi Robusta" name="nama_produk">
                    @error('required')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="harga">Harga</label>
                  <input type="text" id="harga" class="form-control" placeholder="Contoh : 25000" name="harga">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="stok">Stok</label>
                  <input type="number" id="stok" class="form-control" placeholder="Contoh : 10" name="stock">
                </div>
              </div>
            </div>
            <hr class="my-4" />
            <h6 class="heading-small text-muted mb-4">
              Keterangan Tambahan
            </h6>
              {{-- <div class="pl-lg-4"> --}}
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="waktu-preorder">Waktu Preorder (hari)</label>
                  <input type="text" id="waktu-preorder" name="masa_preorder" class="form-control" placeholder="Contoh : 5" name="waktu_preorder">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="berat">Berat per kemasan (gram)</label>
                  <input type="text" id="berat" name="berat" class="form-control" placeholder="Contoh : 500">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                <label for="kondisi_produk">Kondisi Produk *</label>
                <select name="kondisi_produk" id="kondisi_produk" class="form-control">
                    <option value="semi-washed">semi-washed</option>
                    <option value="full-washed">full-washed</option>
                    <option value="kopi kemasan">kopi kemasan</option>
                    <option value="kopi bubuk">kopi bubuk</option>
                </select>
                </div>
              </div>
            </div>
      
          <hr class="my-4" />
          <!-- Deskripsi -->
          <h6 class="heading-small text-muted mb-4">Deskripsi Produk</h6>
            <div class="form-group">
              <textarea rows="3" class="form-control" name="deskripsi" id="description" placeholder="Deskripsikan produk Anda."></textarea>
            </div>
          <div class="row justify-content-center">
            <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i>&nbsp;Simpan</button>
          </div>
        </form>
        <!-- AKHIR FORM TAMBAH PRODUK -->
      </div>
    </div>
  </div>

  <!-- required scripts -->
  @include('sweetalert::alert')

@endsection('content')
