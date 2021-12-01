@extends('administrator.headerfooter')

@section('title')
  <title>{{config('app_name','Linggom Coffee')}} - Daftar Pesanan </title>
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
    <a class="nav-link  active" href="{{__('/admin/order_list')}}">
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
  <li class="breadcrumb-item active" aria-current="page">Daftar Pesanan</li>
@endsection('path')

@section ('content')
  <div class="container-fluid mt--4">

        <div class="row"> 
          <div class="col-xl-12 col-12">
            <div class="card">
              <div class="card-header bg-transparent">
                <div class="row align-items-center">
                  <div class="col">
                    <h6 class="h3 mb-0">Daftar Pesanan</h6>
                    <h5 class=" text-muted ls-1 mb-1 ">Seluruh pesanan menampilkan daftar pesanan yang pembayarannya belum terverifikasi ataupun produk belum dikirim. </h5>
                  </div>
                </div>
              </div>
              <div class="card-body">
              <br><br><br>
              <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th>No</th>
                      <th>Customer</th>
                      <th>Daftar Pesanan</th>
                      <th>Total Pembayaran</th>
                      <th>Status Pengiriman</th>
                      <th colspan="3">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($bills->count() == 0)
                    <tr>
                      <td colspan="3">
                        <h5>Saat ini Anda belum menerima pesanan apapun.</h5>
                      </td>
                    </tr>
                    @endif
                    @php($i=1)
                    @foreach ($bills as $bill)
                      <tr>
                        <td >{{$i++}}</td>
                        <td><p class="text-sm">{{$bill->customer->name}} </p></td>
                        <td>
                        @foreach($cartDetails as $cartDetail)
										    	@if($cartDetail->bill_id == $bill->id)
												    {{$cartDetail->products->nama_produk}} x <strong>{{$cartDetail->quantity}}</strong> <br>
										      @endif
										    @endforeach	
                        </td>
                        <td>
                          @currency($bill->payment)
                        </td>
                        <td>
                          {{$bill->shipping_status}}
                        </td>
                        <td colspan="3">
                          <div class="row">

                            <div class="col-md-4">
                              <form action="{{__('/admin/editBills')}}" method="post">
                                @csrf 
                                <input type="text" value="{{$bill->id}}" name="bill_id" hidden>
                                <button type="submit" class="btn btn-success " href="{{__('/admin/editBills')}}"><i class="fa fa-pen-square" aria-hidden="true"></i></button>
                              </form>
                            </div>
                            <div class="col-md-4">
                              <form action="{{__('/admin/deleteBills')}}" method="post">
                                @csrf
                                <input type="text" value="{{$bill->id}}" name="bill_id" hidden>
                                &nbsp;<button class="btn btn-danger" href="{{__('/admin/deleteBills')}}" onclick="return confirm('Apakah Anda yakin ingin menghapus data billing ini? Anda tidak akan dapat mengembalikan data yang telah dihapus.')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                              </form>
                            </div>
                            <div class="col-md-4">
                              <form action="{{__('/admin/billDetail')}}" method="get">
                                @csrf
                                <input type="text" value="{{$bill->id}}" name="bill_id" hidden>
                                <button class="btn btn-info"><i class="fa fa-info-circle"></i></button>
                              </form>
                            </div>
                          </div>
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
      </div>
  </div>
  <!-- required scripts -->
  @include('sweetalert::alert')
@endsection ('content')

