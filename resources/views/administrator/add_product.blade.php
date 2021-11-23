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
      <i class="ni ni-single-02 text-yellow"></i>
      <span class="nav-link-text">Profile</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{__('/admin/produk')}}">
      <i class="ni  ni-bag-17 text-default"></i>
      <span class="nav-link-text">Products</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{__('/admin/order_list')}}">
      <i class="ni ni-bullet-list-67 text-info"></i>
      <span class="nav-link-text">Daftar Pesanan</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{__('/admin/history')}}">
      <i class="fa fa-history" aria-hidden="true"></i>
      <span class="nav-link-text">Riwayat Penjualan</span>
    </a>
  </li>
@endsection('sidenav')

@section('path')
  <li class="breadcrumb-item active" aria-current="page">Produk</li>
  <li class="breadcrumb-item active" aria-current="page">Tambah Produk Baru</li>
@endsection('path')


@section('content')
<br><br><br>

<div class="col-xl-12 order-xl-1">

  <!-- card header -->
  <div class="card">

    <div class="card-header">
      <div class="row align-items-center">
        <div class="col-8">
          <h3 class="mb-0"><strong>Tambahkan Produk Baru</strong></h3>
        </div>
        <div class="col-4 text-right">
          <a href="{{__('/admin/dashboard')}}" class="text-danger">Batalkan</a>
        </div>
      </div>
    </div>

    <!-- card body -->
    <div class="card-body">
      <form action="{{__('/admin/store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <h6 class="heading-small text-muted mb-4">Informasi Produk</h6>
        <div class="pl-lg-4">
          {{-- <div class="row">
            <label for="image">Tambahkan gambar</label> <br>
            <input type="file" name="gambar">
          </div> --}}
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
                <label class="form-control-label" for="input-last-name">Kondisi Produk</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="kondisi_produk" value="full-washed" id="full-washed">
                  <label class="form-check-label" for="full-washed">
                    Full-washed
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="kondisi_produk" value="semi-washed" id="semi-washed">
                  <label class="form-check-label" for="semi-washed">
                    Semi-washed
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="kondisi_produk" value="bubuk-kopi" id="bubuk-kopi">
                  <label class="form-check-label" for="bubuk-kopi">
                    Bubuk Kopi
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="kondisi_produk" value="kopi-kemasan" id="kopi-kemasan">
                  <label class="form-check-label" for="kopi-kemasan">
                    Kopi Kemasan
                  </label>
                </div>
                  {{-- <label class="form-check-label" for="flexCheckDefault">
                    Keterangan Lain
                  </label>
                  <input type="text" class="form-control" > --}}
              </div>
            </div>
          </div>
              {{-- </div> --}}

          {{-- <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-first-name">Berat per kemasan (*dalam gram)</label>
                <input type="text" id="input-first-name" class="form-control" placeholder="conto: 500">
              </div>
            </div>
          </div> --}}

        <hr class="my-4" />
        <!-- Deskripsi -->
        <h6 class="heading-small text-muted mb-4">Deskripsi Produk</h6>
          <div class="form-group">
            <textarea rows="4" class="form-control" name="deskripsi" id="description">
              Silakan Masukkan Deskripsi Produk....
            </textarea>
          </div>
        <div class="row justify-content-center">
          <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i>&nbsp;Simpan</button>
        </div>
       
      </form>
    </div>
  </div>
</div>

@endsection('content')
