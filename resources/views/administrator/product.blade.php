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
                </div>
              </div>
            </div>
            <div class="card-body">
              <a href="{{__('/admin/tambah_produk')}}" class="btn btn-success ">
                <i class="ni ni-fat-add"></i>
                Tambah Produk Baru
              </a>

              <a href="#" class="btn btn-warning">
                <i class="ni ni-fat-add"></i>
                Tambah Administrator Baru
              </a>
            <br><br><br>
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th >Gambar</th>
                    <th >Nama Produk</th>
                    <th >Harga</th>
                    <th >Stock</th>
                    <th  class="text-center" colspan="3">Aksi</th>
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
                      <a href="/admin/detail_produk?product_id={{$product->id}}" class="btn btn-success d-inline">Edit</button>
                    </td>
                    <td>
                      <form action="{{__('/admin/hapus_produk')}}" method="post">
                        @csrf
                        <input type="text" name="produk_id" value="{{$product->id}}" hidden>
                        <button type="submit" class="btn btn-danger d-inline">Hapus</button>
                      </form>
                    </td>
                    <td>
                      <a href="/admin/detail_produk?product_id={{$product->id}}">Detail</a>
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

<!-- required scripts -->
@include('sweetalert::alert')
@endsection ('content')

