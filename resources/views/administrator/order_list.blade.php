@extends('administrator.headerfooter')

@section('title')
<title>{{config('app_name','Linggom Coffee')}} - Daftar Pesanan</title>
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
    <a class="nav-link" href="{{__('/admin/produk')}}">
      <i class="ni  ni-bag-17 text-default"></i>
      <span class="nav-link-text">Products</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{__('/admin/order_list')}}">
      <i class="ni ni-bullet-list-67 text-default"></i>
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
  <li class="breadcrumb-item active" aria-current="page">Daftar Order</li>
@endsection('path')

@section ('content')
<!-- PRODUK LIST -->

<br><br><br><br><br>
<h1>INI ADALAH ORDER-LIST SECTION</h1>
<br><br><br><br><br>


@endsection ('content')

