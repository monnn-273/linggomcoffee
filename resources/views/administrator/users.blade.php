@extends('administrator.headerfooter')

@section('title')
  <title>{{config('app_name','Linggom Coffee')}} - Daftar Pengguna </title>
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
    <a class="nav-link active" href="{{__('/admin/users')}}">
      <i class="fa fa-user-friends text-primary"></i>
      <span class="nav-link-text">Pengguna</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{__('/admin/produk')}}">
      <i class="ni  ni-bag-17 text-primary"></i>
      <span class="nav-link-text">Produk</span>
    </a>
  </li>
  <li class="nav-item ">
    <a class="nav-link" href="{{__('/admin/order_list')}}">
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
    <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
@endsection('path')

@section ('content')
    <!-- Page content -->
    <div class="container-fluid mt--6">

        <!-- Dark table -->
        <div class="row">
            <div class="col">
                <div class="card bg-primary-2 shadow">
                    <div class="card-header bg-transparent border-0">
                        <h3 class="text-dark mb-0">Data Seluruh Pengguna</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center bg-primary-2 table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Nama</th>
                                <th scope="col" class="sort" data-sort="budget">No. Telp</th>
                                <th scope="col" class="sort" data-sort="status">Email</th>
                                <th scope="col" class="sort" data-sort="status">Role</th>
                                @if(Auth::user()->id == 1)
                                <th scope="col" class="sort" data-sort="completion">Aksi</th>
                                @else
                                <th scope="col" class="sort" data-sort="completion">Tanggal Bergabung</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="list">  
                                @foreach($users as $user)       
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>
                                        @if($user->no_telp == NULL)
                                          Belum diatur.
                                        @endif
                                        {{$user->no_telp}}
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role}}</td>
                                    @if(Auth::user()->id ==1)
                                    <td>
                                      @if($user->role != "admin")
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <form action="{{__('/admin/update_user')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{$user->id}}" name="user_id">
                                                    <button type="submit" onclick="return confirm('Yakin ingin menjadikan pengguna ini sebagai Admin? Pengguna ini akan dapat mengakses seluruh halaman otorisasi administrator seperti Anda saat ini.')"class="btn btn-warning btn-lg d-inline px-5"> <i class="ni ni-fat-add"></i> &nbsp;Jadikan Admin &nbsp;</button>
                                                </form>
                                            </div>
                                            &nbsp;
                                            <div class="col-md-12">
                                                <form action="{{__('/admin/delete_user')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    <button class="btn btn-danger btn-lg d-inline px-5" type="submit" onclick="return confirm('Yakin ingin menhapus pengguna ini? Jika pengguna ini dihapus, maka seluruh data termasuk pesanan dan riwayat pemesanan atas nama pengguna ini juga akan dihapus.')"><i class="fa fa-trash"></i>&nbsp;Hapus Pengguna</button>
                                                </form>
                                            </div>
                                        </div>
                                        @else
                                          @if($user->id == 1)
                                            Administrator Utama
                                          @else
                                            Administrator
                                            <div class="row">
                                              <div class="col-md-12">
                                                <form action="{{__('/admin/update_admin')}}" method="POST">
                                                  @csrf
                                                  <input type="hidden" name="user_id" value="{{$user->id}}">
                                                  <button class="btn btn-info btn-lg d-inline px-5" type="submit" onclick="return confirm('Yakin ingin mengubah akun ini menjadi user biasa?')"><i class="fa fa-minus"></i>&nbsp;Jadikan User</button>
                                                </form>
                                              </div>
                                              &nbsp;
                                              <div class="col-md-12">
                                                <form action="{{__('/admin/delete_user')}}" method="POST">
                                                  @csrf
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    <button class="btn btn-danger btn-lg d-inline px-5" type="submit" onclick="return confirm('Yakin ingin menhapus pengguna ini? Jika pengguna ini dihapus, maka seluruh data termasuk pesanan dan riwayat pemesanan atas nama pengguna ini juga akan dihapus.')"><i class="fa fa-trash"></i>&nbsp;Hapus Pengguna</button>
                                                </form>
                                              </div>
                                            </div>
                                          @endif
                                        @endif
                                    </td>

                                    @else
                                      <td>
                                        {{date('d-m-Y', strtotime($user->created_at))}}
                                      <td>
                                    @endif
                                </tr>
                                @endforeach
                                <hr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- required scripts -->
    @include('sweetalert::alert')
@endsection ('content')

