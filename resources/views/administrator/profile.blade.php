@extends('administrator.headerfooter')

@section('title')
<title>{{config('app_name','Linggom Coffee')}} - Profile </title>
@endsection('title')


@section('sidenav')
  <li class="nav-item">
    <a class="nav-link" href="{{__('/admin/dashboard')}}">
      <i class="ni ni-tv-2 text-primary"></i>
      <span class="nav-link-text">Dashboard</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{__('/admin/myprofile')}}">
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
  <li class="breadcrumb-item active" aria-current="page">Profile</li>
@endsection('path')

@section('content')
 
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col-xl-4 order-xl-2">
        <div class="card card-profile">
          <img src="../images/bg_1.jpg" alt="Image placeholder" class="card-img-top">

            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="../images/logo.png" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
              <!--Data kosong supaya  Card tetap rapi  -->
              </div>
            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center">     
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h5 class="h3">
                  {{Auth::user()->name}}
                </h5>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i>{{Auth::user()->address}}
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Administrator - Linggom Coffee
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>University of Pennsylvania
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Edit profile </h3>
                </div>
              </div>
            </div>

            <div class="card-body">

            <!-- FORM UPDATE PROFILE -->
              <form action="{{__('/admin/update_profile')}}" method="POST">
              @csrf
                <!-- hidden information -->
                <input type="text" name="user_id" value="{{Auth::user()->id}}" hidden>

                <h6 class="heading-small text-muted mb-4">Informasi Pengguna</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-nama">Nama</label>
                        <input type="text" id="input-nama" class="form-control" placeholder="Nama Lengkap Anda" value="{{Auth::user()->name}}" name="name">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Alamat Email</label>
                        <input type="email" id="input-email" class="form-control" placeholder="contoh: yourname@example.com" value="{{Auth::user()->email}}" name="email">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Kontak Pengguna</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Alamat lengkap</label>
                        <input id="input-address" class="form-control" placeholder="Home Address" value="{{Auth::user()->address}}" type="text" name="address">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-telp">No. Telephone</label>
                        <input id="input-telp" class="form-control" placeholder="0812 1234 4567" value="{{Auth::user()->no_telp}}" type="text" name="no_telp">
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="row justify-content-center container ">
                  <button class="btn btn-success btn-lg" type="submit"><i class="fa fa-save"></i>&nbsp;Simpan Perubahan</button>
                </div>
              </form>

              <!-- AKHIR FORM UPDATE DATA -->
            </div>
          </div>
        </div>
      </div>
      <br><br><br><br><br>
@endsection('content')