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
      <i class="ni  ni-bag-17 text-default"></i>
      <span class="nav-link-text">Products</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{__('/admin/order_list')}}">
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
  <li class="breadcrumb-item active" aria-current="page">Produk</li>
  <li class="breadcrumb-item active" aria-current="page">Tambah Produk Baru</li>
@endsection('path')


@section('content')
<br><br><br>

<div class="col-xl-8 order-xl-1">

  <!-- card header -->
  <div class="card">

    <div class="card-header">
      <div class="row align-items-center">
        <div class="col-8">
          <h3 class="mb-0"><strong>Tambahkan Produk Baru</strong></h3>
        </div>
        <div class="col-4 text-right">
          <a href="{{__('/admin/dashboard')}}" class="text-danger">Cancel</a>
        </div>
      </div>
    </div>

    <!-- card body -->
    <div class="card-body">
      <form action="{{__('/admin/store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <h6 class="heading-small text-muted mb-4">Informasi Produk</h6>
        <div class="pl-lg-4">
          <div class="row">
            <label for="image">Tambahkan gambar</label> <br>
            <input type="file" name="gambar">
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-product-name">Nama Produk</label>
                <input type="text" id="input-product-name" class="form-control" placeholder="Product Name" name="nama_produk">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="harga">Harga</label>
                <input type="text" id="harga" class="form-control" placeholder="Misal: 25000 (dua puluh lima ribu)" name="harga">
              </div>
            </div>
          </div>
          <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="stock">Stock</label>
                <input type="number" id="stock" class="form-control" placeholder="Misal: 10" name="stock">
              </div>
            </div>
          </div>
          <hr class="my-4" />
            <h6 class="heading-small text-muted mb-4">Keterangan Tambahan</h6>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="waktu-preorder">Waktu Preorder (Dalam hari)</label>
                      <input type="text" id="waktu-preorder" class="form-control" placeholder="Untuk 5 hari, ditulis: 5" name="waktu_preorder">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-last-name">Kondisi Produk</label>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Full-washed
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Semi-washed
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Bubuk Kopi
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Kopi Kemasan
                        </label>
                      </div>
                        <label class="form-check-label" for="flexCheckDefault">
                          Keterangan Lain
                        </label>
                      <input type="text" class="form-control" >
                     
                    </div>
                  </div>
                </div>
              </div>


          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-first-name">Berat per kemasan (*dalam gram)</label>
                <input type="text" id="input-first-name" class="form-control" placeholder="conto: 500">
              </div>
            </div>
          </div>

        <hr class="my-4" />
        <!-- Description -->
        <h6 class="heading-small text-muted mb-4">Deskripsi Produk</h6>
        <div class="pl-lg-4">
          <div class="form-group">
            <label class="form-control-label">About Me</label>
            <textarea rows="4" class="form-control" placeholder="A few words about you ..." name="description" id="description">A beautiful Dashboard for Bootstrap 4. It is Free and Open Source.</textarea>
          </div>
        </div>
        <div class="row justify-content-center">
          <button type="submit" class="btn btn-success btn-sm">Simpan</button>
        </div>

       
      </form>
    </div>
  </div>
</div>

@endsection('content')
