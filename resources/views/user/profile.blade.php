<?php
  // menghitung jenis produk dalam cart
  use App\Models\Cart;
  $counter = Cart::where('customerId', Auth::user()->id)->count();
?>

@extends('user.headerfooter')

@section('title')
  <title>{{config('app_name','Linggom Coffee')}} - Profile </title>
@endsection('title')

@section('navbar')
	<li class="nav-item"><a href="{{__('/user/dashboard')}}" class="nav-link">Home</a></li>
	<li class="nav-item"><a href="/user/dashboard#about" class="nav-link">Tentang</a></li>
	<li class="nav-item active"><a href="{{__('/user/showprofile')}}" class="nav-link">Profile</a></li>
	<li class="nav-item"><a href="{{__('/user/product')}}" class="nav-link">Produk</a></li>
	<!-- cart -->
  <li class="nav-item cart"><a href="{{route('cart')}}" class="nav-link"><span class="icon icon-shopping_cart"></span><span class="bag d-flex justify-content-center align-items-center"><small>{{$counter}}</small></span></a></li>

@endsection('navbar')

@section('content')

  <!-- HERO SECTION -->
  <section class="home-slider owl-carousel">

    <!--SLIDER  ITEM 1  -->
    <div class="slider-item" style="background-image: url(images/lico-black-1.png);">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

          <div class="col-md-8 col-sm-12 text-center ftco-animate">
            <span class="subheading">Welcome</span>
            <h1 class="mb-4">The Best Coffee Testing Experience</h1>
            <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            <p>
              <a href="{{__('/user/product')}}" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Lihat Produk</a>
            </p>
          </div>

        </div>
      </div>
    </div>

    <!-- SLIDER ITEM 2 -->
    <div class="slider-item" style="background-image: url(images/lico-black-2.png);">
      <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
            <div class="col-md-8 col-sm-12 text-center ftco-animate">
              <span class="subheading">Welcome</span>
              <h1 class="mb-4">Amazing Taste &amp; Beautiful Place</h1>
              <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              <p>
                <a href="{{__('/user/product')}}" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Lihat Produk</a>
              </p>
            </div>
          </div>
      </div>
    </div>

    <!-- SLIDER ITEM 3 -->
    <div class="slider-item" style="background-image: url(images/lico-black-4.png);">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

          <div class="col-md-8 col-sm-12 text-center ftco-animate">
            <span class="subheading">Welcome</span>
            <h1 class="mb-4">Creamy Hot and Ready to Serve</h1>
            <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            <p>
              <a href="{{__('/user/product')}}" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Lihat Produk</a>
            </p>
          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- AKHIR HERO SECTION-->

<section class="ftco-section">
    <div class="container">
      <div class="row">
          <div class="col-md-8 ftco-animate">
            <center>
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <span class="subheading">Linggom Coffee</span> <br>
                    <h2 class="mb-4">Mereka yang Terlibat</h2>
                </div>
            </center>
        
            <br><br>
            <div class="about-author d-flex">
              <div class="bio align-self-md-center mr-5">
                <img src="{{asset('images/person_4.jpg')}}" style="height:500;width:500" alt="Image placeholder" class="img-fluid mb-4">
              </div>
              <div class="desc align-self-md-center">
                <h3>Alex Simare-mare</h3>
                <p>
                  Pemuda asal Sidikalang sebagai pemilik usaha Linggom Coffee. Linggom Coffee dibangun dengan banyak harapan. Salah satunya adalah mengembalikan
                  ketenaran Kopi Sidikalang. Kopi Sidikalang banyak diakui orang sebagai kopi yang enak dan aroma yang membuat candu. Oleh karena itu, produk Linggom Coffee dibuat, representasi dari kopi asli Sidikalang yang diolah secara natural.
                  Banyak petani yang terlibat dalam proses pembuatan, oleh karena itu, dengan semakin berkembangnya produk Linggom Coffee ini, maka petani kopi Sidikalang juga dapat semakin sejahtera. 
                </p>
              </div>
            </div>

            </div> <!-- .col-md-8 -->
            <div class="col-md-4 sidebar ftco-animate">
              <div class="sidebar-box ftco-animate">
                <h3>Tag Cloud</h3>
                <div class="tagcloud">
                  <a href="#" class="tag-cloud-link">coffee</a>
                  <a href="#" class="tag-cloud-link">green bean</a>
                  <a href="#" class="tag-cloud-link">kopi arabika</a>
                  <a href="#" class="tag-cloud-link">kopi robusta</a>
                  <a href="#" class="tag-cloud-link">kopi bubuk</a>
                  <a href="#" class="tag-cloud-link">kopi sidikalang</a>
                  <a href="#" class="tag-cloud-link">dairi</a>
                  <a href="#" class="tag-cloud-link">kota kopi</a>
                </div>
              </div>

              <div class="sidebar-box ftco-animate">
                <h3>Parsidikalang: </h3>
                <p>
                  Produk Linggom Coffee tidak akan pernah ada tanpa kesinergisan dari hulu ke hilir. Petani kopi di Dairi menanam kopi kemudian biji kopi asli Sidikalang diolah dan melahirkan produk Linggom Coffee. Jangan lupa buat nikmati kopi Sidikalang ya, guys! Horas!
                </p>
              </div>
            </div>

          </div>
        </div>
  </section> <!-- .section -->
@endsection('content')

