<?php
    //untuk menghitung jumlah jenis barang dalam produk   
    use App\Models\Cart;
    $counter = Cart::where('customerId', Auth::user()->id)->count();
?>


@extends('user.headerfooter')
@section('title')
    <title>{{config('app_name','Linggom Coffee')}} - My Profile </title>
@endsection('title')

@section('navbar')
	<li class="nav-item"><a href="{{__('/user/dashboard')}}" class="nav-link">Home</a></li>
	<li class="nav-item"><a href="/user/dashboard#about" class="nav-link">Tentang</a></li>
	<li class="nav-item"><a href="{{__('/user/showprofile')}}" class="nav-link">Profile</a></li>
	<li class="nav-item"><a href="{{__('/user/product')}}" class="nav-link">Produk</a></li>
	<!-- cart -->
	<li class="nav-item cart"><a href="{{route('cart')}}" class="nav-link"><span class="icon icon-shopping_cart"></span><span class="bag d-flex justify-content-center align-items-center"><small>{{$counter}}</small></span></a></li>
@endsection('navbar')

@section('content')
    <!-- HERO SECTION -->
    <section class="home-slider owl-carousel">
        <!--SLIDER  ITEM 1  -->
        <div class="slider-item" style="background-image: url({{asset('../images/lico-black-1.png')}});">
            <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
                        <div class="col-md-8 col-sm-12 text-center ftco-animate">
                            <span class="subheading">Welcome</span>
                            <h1 class="mb-4">The Best Coffee Testing Experience</h1>
                            <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                            <p>
                                <a href="{__('/user/dashboard')}}" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Home</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- SLIDER ITEM 2 -->
        <div class="slider-item" style="background-image: url({{asset('images/lico-black-2.png')}});">
            <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
                        <div class="col-md-8 col-sm-12 text-center ftco-animate">
                            <span class="subheading">Welcome</span>
                            <h1 class="mb-4">Amazing Taste &amp; Beautiful Place</h1>
                            <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                            <p>
                                <a href="{{__('/user/dashboard')}}" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Home</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SLIDER ITEM 3 -->
        <div class="slider-item" style="background-image: url({{asset('images/lico-black-4.png')}});">
            <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
                        <div class="col-md-8 col-sm-12 text-center ftco-animate">
                            <span class="subheading">Welcome</span>
                            <h1 class="mb-4">Creamy Hot and Ready to Serve</h1>
                            <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                            <p> 
                                <a href="{{__('/user/dashboard')}}" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Home</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- AKHIR HERO SECTION -->

    <!-- PROFILE SECTION -->
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-12 ftco-animate">
                    <!-- FORMULIR UNTUK UPDATE PROFILE USER -->
                    <form action="{{__('/user/update_profile')}}" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
                        @csrf

                        <!-- hidden input -->
                        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                        <!-- heading section -->
                        <center>
                            <div class="col-md-7 heading-section ftco-animate text-center">
                                <span class="subheading">Linggom Coffee</span> <br>
                                <h2 class="mb-4">Customer Profile</h2>
                            </div>
                        </center>
                        <!-- akhir ending section -->

                        <center><img class="img" src="{{asset('../images/logo.png')}}" style="width:200px;height:200px"></center>
                        <br><br>

                        @if(session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('status') }} </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <br><br>
                        <p class="mb-4">Data pada profile ini akan kami gunakan untuk pengiriman produk. Harap input data sebenar-benarnya. </p>
                        <div class="row align-items-end">

                            <div class="col-md-12 col-12 col-lg-12  ">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap *</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{Auth::user()->name}}" required pattern="[a-zA-Z\s]+">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-md-12 col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="address">Alamat Lengkap </label>
                                    <input id="address" type="text" class="form-control" name="address" placeholder="Jl.contoh alamat, Kab. Contoh , Provinsi Contoh, 123456" value="{{Auth::user()->address}}">
                                </div>
                            </div>
                            
                            <div class="w-100"></div>

                            <div class="col-md-12 col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="phone">Nomor HP (terhubung dengan Whatsapp) </label>
                                    <input id="phone" type="tel" class="form-control" name="no_telp" value="{{Auth::user()->no_telp}}" placeholder="08XX XXXX XXXX" min="12" max="20">
                                </div>
                            </div>
                            <div class="col-md-6 col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="emailaddress">Alamat Email *</label>
                                    <input type="email" id="emailaddress" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" name="email" placeholder="Masukkan alamat email yang valid" value="{{Auth::user()->email}}" required>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-md-12">
                                <div class="form-group mt-4">
                                    <div class="row justify-content-center">
                                        <button type="submit" class="btn btn-primary p-3 px-xl-4 py-xl-3"><i class="fa fa-save"></i>&nbsp;Simpan Perubahan</button> 
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                    <!-- AKHIR FORM PROFILE -->
                </div>
            </div>
        </div>
    </section> 
    <!-- AKHIR PROFILE SECTION  -->
@endsection('content')