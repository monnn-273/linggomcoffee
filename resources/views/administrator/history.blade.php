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
    <a class="nav-link" href="{{__('/admin/produk')}}">
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
    <a class="nav-link  active" href="{{__('/admin/history')}}">
      <i class="ni ni-archive-2 text-default"></i>
      <span class="nav-link-text">History Penjualan</span>
    </a>
  </li>
@endsection('sidenav')

@section('path')
  <li class="breadcrumb-item active" aria-current="page">Riwayat Penjualan</li>
@endsection('path')

@section('content')
<h1>INI ADALAH HALAMAN PROFILE</h1>
@endsection('content')