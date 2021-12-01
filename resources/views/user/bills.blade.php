<?php

    //untuk menampilkan jumlah barang dalam cart
	use App\Models\Cart;
	$counter = Cart::where('customerId', Auth::user()->id)->count();
	
    //untuk menjumlahkan semua total biaya produk dalam cart
	$subtotal = 0;
	foreach($carts as $cart)
    {
		$subtotal = $subtotal + $cart -> payment;
	}
?>

@extends('user.headerfooter')

@section('title')
	<title>{{config('app_name','Linggom Coffee')}} - Billing Details </title>
@endsection('title')

@section('navbar')
	<li class="nav-item"><a href="{{__('/user/dashboard')}}" class="nav-link">Home</a></li>
	<li class="nav-item"><a href="{{__('/user/dashboard#about')}}" class="nav-link">Tentang</a></li>
	<li class="nav-item"><a href="{{__('/user/showprofile')}}" class="nav-link">Profile</a></li>
	<li class="nav-item"><a href="{{__('/user/product')}}" class="nav-link">Produk</a></li>
	<!-- cart -->
	<li class="nav-item cart"><a href="{{route('cart')}}" class="nav-link"><span class="icon icon-shopping_cart"></span><span class="bag d-flex justify-content-center align-items-center"><small>{{$counter}}</small></span></a></li>
@endsection('navbar')


@section('content')

    <!-- HEADER SECTION -->
    <section class="home-slider owl-carousel">
        <div class="slider-item" style="background-image: url({{asset('images/lico-black-1.png')}});" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">
                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Billing Detail</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{__('/user/dashboard')}}">Home</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- HEADER SECTION -->

    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-xl-8 ftco-animate">

            <!--FORM UNTUK MENAMBAHKAN DATA BILLING  -->
            <form action="{{__('/user/addBill')}}" class="billing-form ftco-bg-dark p-3 p-md-5" method="POST">
                @csrf
                <!-- hidden input -->
                <input type="hidden" name="customerId" value="{{Auth::user()->id}}">
                <input type="hidden" name="payment" value="{{$subtotal}}">
                <input type="hidden" name="courier" value="{{$courier['courier']}}">
                <input type="hidden" name="service" value="{{$courier['service']}}">
                <input type="hidden" name="ongkir" value="{{$courier['cost']}}">
                <input type="hidden" name="etd" value="{{$courier['etd']}}">
                <input type="hidden" name="weight" value="{{$courier['weight']}}">
                <input type="hidden" name="city_origin" value="{{$courier['city_origin']}}">
                <input type="hidden" name="city_destination" value="{{$courier['city_destination']}}">
                
                <h3 class="mb-4 billing-heading">Billing Details</h3>
	          	<div class="row align-items-end">

	          		<div class="col-md-12">
                        <div class="form-group">
                            <label for="firstname">Nama Lengkap *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="bill_name" value="{{Auth::user()->name}}" placeholder="Nama Lengkap" required pattern="[a-zA-Z\s]+">
                            @error('bill_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
	                </div>

		            <div class="w-100"></div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="streetaddress">Alamat Lengkap Pengiriman * </label>
                            <input type="text" class="form-control @error('shippingAddress') is-invalid @enderror" name="shippingAddress" value="{{Auth::user()->address}}" placeholder="Jl.contoh alamat, Kab. Contoh , Provinsi Contoh, 123456" required>
                            @error('shippingAddress')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
		            </div>

		            <div class="w-100"></div>

		            <div class="col-md-12">
		            	<div class="form-group">
		            		<label for="postcodezip">Kode Pos *</label>
	                        <input type="text" id="postcodezip" class="form-control " placeholder="Kode Pos Daerah Anda" name="postalCode" min="5" max="5" required pattern={0-9}>
	                    </div>
		            </div>

		            <div class="w-100"></div>

		            <div class="col-md-12">
	                    <div class="form-group">
	                	    <label for="phone">Nomor Telephone (Terhubung dengan WA) * </label>
	                        <input type="tel" value="{{Auth::user()->no_telp}}" name="bill_phone" class="form-control @error('bill_phone') is-invalid @enderror" placeholder="08XX XXXX XXXX" required>
                            @error('bill_phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
	                    </div>
	                </div>

                    <div class="w-100"></div>
	            </div>
                </div>
                <!-- AKHIR BILLING STATEMENT -->

  
                <div class="row mt-5 pt-3 d-flex">

                    <!-- PAYMENT CART DETAIL -->
                    <div class="col-md-6 d-flex">
                        <div class="cart-detail cart-total ftco-bg-dark p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Cart Total</h3>
                            <p class="d-flex">
                                <span>Subtotal</span>
                                <span>@currency($subtotal)</span>
                            </p>
                            <p class="d-flex">
                                <span>Ongkos Kirim</span>
                                <span>@currency($courier['cost'])</span>
                            </p>
                            <p class="d-flex">
                                <span>Ekpedisi</span>
                                <span>{{strtoupper($courier['courier'])}} ({{$courier['service']}})</span>
                            </p>
                            <p class="d-flex">
                                <span>Estimasi Waktu</span>
                                <span>{{$courier['etd']}} Hari</span>
                            </p>
                            <hr>
                            <p class="d-flex total-price">
                                <span>Total</span>
                                <span>@currency($subtotal + $courier['cost'])</span>
                            </p>
                        </div>
                    </div>

                    <!-- DEAL THE BILL SECTION -->
                    <div class="col-md-6">
                        <div class="cart-detail ftco-bg-dark p-3 p-md-4">
                        <h3 class="billing-heading mb-4">Payment Method</h3>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <p>Direct Bank Tranfer</p>

                                        <p>Harap lakukan pembayaran ke no.rekening berikut: </p>
                                        <h3>Bank BRI : 1212121212 a.n Alex Simare-mare</h3>

                                        <p>Bukti pembayaran harus dikirimkan melalui kontak Whatsapp Business : +62 853-6288-8055 <br> Kepentingan untuk membayar menggunakan rekening bank yang lain juga dapat dikonfirmasi melalui Whatsapp business pada halaman riwayat transaksi Anda jika pesanan ini Anda kirim.</p>
                                    </div>
                                </div>

                            <p><button type="submit" class="btn btn-primary py-3 px-4">Kirim Pesanan</button></p>
                        </div>
                    </div>
                </div>
            </form>
            <!-- AKHIR FORM DATA BILLING -->

          </div>
        </div>
        </div>
      </div>
    </section>
@endsection('content')
