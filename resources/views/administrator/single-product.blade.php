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
              <!-- UPDATE FORM -->
              <form action="{{__('/admin/update_produk')}}" method="POST" class="needs-validation" enctype="multipart/form-data">
              @csrf
                <!-- hidden input -->
                <input type="hidden" value="{{$product->id}}" name="produk_id" hidden>
                <input type="text" value="{{$product->gambar}}" name="old_gambar" hidden>
                <h6 class="heading-small text-muted mb-4">Gambar Produk</h6>
                
                <table class="table table-flush text-center">
                  <tr>       
                      <td colspan="2">
                        <img src="/images/{{$product->gambar}}" alt="gambar_product" style="width:400px; height:440px">
                      </td>
                  </tr>
                </table>

                <div class="col-lg-8">
                  <div class="form-group">
                    <label class="form-control-label">Ubah gambar</label>
                    <div class="input-group mb-3">
                      <div class="custom-file">
                        <input type="file" name="gambar" id="gambar">
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
                        <label class="form-control-label" for="input-product-name">Nama Produk *</label>
                        <input type="text" id="input-product-name" class="form-control" value="{{ $product->nama_produk }}" name="nama_produk" placeholder="Nama Produk" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="harga">Harga *</label>
                        <input type="text" id="harga" class="form-control" value="{{ $product->harga }}" name="harga" required min="4">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="stock">Stok *</label>
                        <input type="number" id="stock" class="form-control" value="{{ $product->stock }}" name="stock" required min="1">
                      </div>
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
                      <label class="form-control-label" for="waktu-preorder">Waktu Preorder (hari) *</label>
                      <p class="text-sm">Waktu pre-order akan disimpan dalam satuan hari. Contoh untuk masa pre-order 3 hari, cukup diisi '3' saja.</p>
                      <input type="number" id="waktu-preorder" name="masa_preorder" class="form-control" value="{{ $product->masa_preorder }}" name="masa_preorder">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="berat">Berat per kemasan (gram) *</label>
                      <p class="text-sm">Berat per-kemasan akan disimpan dalam satuan gram. Contoh untuk berat 100gr, cukup diisi dengan '100' saja.</p>
                      <input type="text" id="berat" name="berat" class="form-control" value="{{ $product->berat }}" >
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="kondisi_produk">Kondisi Produk *</label>
                      <select name="kondisi_produk" id="kondisi_produk" class="form-control">
                          <option value="{{$product->kondisi_produk}}" selected>{{$product->kondisi_produk}}</option>
                          <option value="semi-washed">semi-washed</option>
                          <option value="full-washed">full-washed</option>
                          <option value="kopi kemasan">kopi kemasan</option>
                          <option value="kopi bubuk">kopi bubuk</option>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">Deskripsi Produk</h6>
                  <div class="form-group">
                    <textarea rows="10" col="30" id="description" class="form-control" placeholder="Kata-kata yang menjelaskan produk Anda secara singkat, padat, dan jelas" name="deskripsi">{{ $product->deskripsi }}</textarea>
                  </div>
                <div class="row justify-content-center">
                  <button type="submit" class="btn btn-success d-inline"><i class="fa fa-save"></i>&nbsp;Simpan Perubahan</button>
              </form>
              <!-- END UPDATE FORM-->
              <form action="{{__('/admin/hapus_produk')}}" method="post">
                @csrf
                <input type="text" value="{{ $product->id }}" name="produk_id" hidden>
                <button type="submit" class="btn btn-danger d-inline show_confirm" data-toggle="tooltip" title='Delete' onclick="return confirm('Yakin ingin menghapus produk ini? Anda tidak akan dapat mengembalikan data produk setelah dihapus.')"><i class="fa fa-trash"></i>&nbsp;Hapus produk</button>
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

