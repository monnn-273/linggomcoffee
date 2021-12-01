<?php
  //data hasil penjualan
  use App\Models\Bill;
  $sold = Bill::where('payment_status', 'verified')->sum('payment');
?>
@extends('administrator.headerfooter')

@section('title')
  <title>{{config('app_name','Linggom Coffee')}} - Edit Data Pesanan </title>
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
    <a class="nav-link" href="{{__('/admin/produk')}}">
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
    <a class="nav-link active" href="{{__('/admin/history')}}">
      <i class="fa fa-history text-primary" aria-hidden="true"></i>
      <span class="nav-link-text">Riwayat Penjualan</span>
    </a>
  </li>
@endsection('sidenav')

@section('path')
    <li class="breadcrumb-item active" aria-current="page">Riwayat Penjualan</li>
@endsection('path')

@section ('content')
    <!-- Page content -->
    <div class="container-fluid mt--6">

        <div class="row">
            <div class="col">
            <div class="card bg-primary-2 shadow">
                <div class="card-header bg-transparent border-0">
                <h3 class="text-dark mb-0">Riwayat Penjualan</h3>
                </div>
                <div class="table-responsive">
                <table class="table align-items-center bg-primary-2 table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="name">No</th>
                        <th scope="col" class="sort" data-sort="name">Riwayat Penjualan</th>
                        <th scope="col" class="sort" data-sort="budget">Daftar Pesanan</th>
                        <th scope="col" class="sort" data-sort="status">Total Pembayaran</th>
                        <th scope="col">Status Pembayaran</th>
                        <th scope="col" class="sort" data-sort="completion">Status Pengiriman</th>
                    </tr>
                    </thead>
                    <tbody class="list">
                      @if($bills->count()==0)
                        <tr>
                          <td colspan="3">
                          <h5>Anda belum memiliki riwayat penjualan produk apapun melalui website ini.</h5>
                          </td>
                        </tr>
                      @endif
                      @php($i=1)
                      @foreach($bills as $bill)   
                        <tr>
                            <td>{{$i}}</td>
                            <td>
                              <!-- Detail Pemesan -->
                              Atas nama         &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$bill->customer->name}} <br><br>
                              Alamat Pengiriman &nbsp;&nbsp;&nbsp;&nbsp;: {{$bill->shippingAddress}} <br><br>
                              Ongkos Kirim      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: @currency($bill->expedition->cost) <br><br>
                              Kurir             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{strtoupper($bill->expedition->courier)}} ({{$bill->expedition->service}}) <br><br>
                              Estimasi Waktu    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$bill->expedition->etd}} Hari
                            </td>
                            <td>
                                @foreach($cartDetails as $cartDetail)                   
                                    {{$cartDetail->products->nama_produk}} x <strong>{{$cartDetail->quantity}}</strong><br>
                                @endforeach	
                            </td>
                            <td>
                                @currency($bill->payment)
                            </td>
                            <td>
                              {{$bill->shipping_status}}
                            </td>
                            <td>
                              {{$bill->payment_status}}
                            </td>
                        </tr>
                        <hr>

                        @php($i++)
                      @endforeach
                      <tr>
                        <td colspan="5"><center> <h3>Total penjualan melalui website: @currency($sold)</h3></center></td>
                      </tr>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
@endsection ('content')

