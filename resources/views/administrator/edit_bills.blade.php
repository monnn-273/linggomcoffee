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
  <li class="nav-item ">
    <a class="nav-link active" href="{{__('/admin/order_list')}}">
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
  <li class="breadcrumb-item" aria-current="page"> <a href="{{__('/admin/order_list')}}">Daftar Pesanan</a></li>
  <li class="breadcrumb-item active" aria-current="page">Edit</li>
@endsection('path')

@section ('content')
    <!-- Page content -->
    <div class="container-fluid mt--6">

        <!-- Dark table -->
        <div class="row">
            <div class="col">
            <div class="card bg-primary-2 shadow">
                <div class="card-header bg-transparent border-0">
                <h3 class="text-dark mb-0">Edit Data Pesanan</h3>
                </div>
                <div class="table-responsive">
                <table class="table align-items-center bg-primary-2 table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col" class="sort" data-sort="name">Detail Pemesan</th>
                      <th scope="col" class="sort" data-sort="budget">Daftar Pesanan</th>
                      <th scope="col" class="sort" data-sort="status">Total Pembayaran</th>
                      <th scope="col" class="sort" data-sort="status">Bukti Pembayaran</th>
                      <th scope="col">Status Pengiriman</th>
                      <th scope="col" class="sort" data-sort="completion">Status Pembayaran</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody class="list">
                    <form action="{{__('/admin/updateBills')}}" method="POST">
                        @csrf
                        <!-- hidden input -->
                        <input type="hidden" value="{{$bill[0]->id}}" name="bill_id" hidden>
                        <tr>
                            <td>
                              <!-- Detail Pemesan -->
                              Atas nama         &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$bill[0]->customer->name}} <br><br>
                              Alamat Pengiriman &nbsp;&nbsp;&nbsp;&nbsp;: {{$bill[0]->shippingAddress}} <br><br>
                              Ongkos Kirim      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: @currency($bill[0]->expedition->cost) <br><br>
                              Kurir             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{strtoupper($bill[0]->expedition->courier)}} ({{$bill[0]->expedition->service}}) <br><br>
                              Estimasi Waktu    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$bill[0]->expedition->etd}} Hari
                            </td>
                            <td>

                                @foreach($cartDetails as $cartDetail)                   
                                    {{$cartDetail->products->nama_produk}} x <strong>{{$cartDetail->quantity}}</strong><br>
                                @endforeach	

                            </td>
                            <td>
                                @currency($bill[0]->payment)
                            </td>
                            <td>
                              @if($bill[0]->payment_evd != NULL)
                                <img src="../images/{{$bill[0]->payment_evd}}" alt="bukti_pembayaran" style="width:300px; height:400px">
                              @else
                                Belum di-upload.
                              @endif
                            </td>
                            <td>
                              <select name="shipping_status" class="form-control">
                                <option value="{{$bill[0]->shipping_status}}" selected>{{$bill[0]->shipping_status}}</option>
                                <option value="belum dikemas">belum dikemas</option>
                                <option value="sedang dikemas">sedang dikemas</option>
                                <option value="sudah dikirim">sudah dikirim</option>
                                <option value="sudah sampai">sudah sampai</option>
                              </select>
                            </td>
                            <td>
                              <select name="payment_status" id="" class="form-control">
                                <option value="{{$bill[0]->payment_status}}" selected>
                                  @if($bill[0]->payment_status == 'wait')
                                    waiting for verification
                                  @else
                                  {{$bill[0]->payment_status}}
                                  @endif
                                </option>
                                <option value="not verified">not verified</option>
                                <option value="wait">waiting for confirmation</option>
                                <option value="verified">verified</option>
                                
                              </select>
                            </td>
                        </tr>
                        <hr>
                        <tr>
                          <td colspan="5" class="text-center">
                            <button class="btn btn-success" type="submit"><i class="fa fa-save">&nbsp;Simpan Perubahan</i></button>
                          </td>
                        </tr>
                    </form>
                  </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
@endsection ('content')

