<?php
	//untuk menampilkan jumlah jenis barang dalam cart
	use App\Models\Cart;
	use App\Models\CartDetail;
	$counter = Cart::where('customerId', Auth::user()->id)->count();
	$products = CartDetail::where('customerId', Auth::user()->id);
	// $i untuk tabel nomor
	$i = 1;
?>

@extends('user.headerfooter')
@section('title')
	<title>{{config('app_name','Linggom Coffee')}} - Riwayat Pembelian </title>
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
		<div class="slider-item" style="background-image: url({{asset('images/lico-black-1.png')}});" data-stellar-background-ratio="0.5">
			<div class="overlay">
				<div class="container">
					<div class="row slider-text justify-content-center align-items-center">
						<div class="col-md-7 col-sm-12 text-center ftco-animate">
						<h1 class="mb-3 mt-5 h1">Riwayat Pembelian</h1>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section ftco-cart">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-xl-12 ftco-animate">	
					<div class="cart-list">

						<!-- STATUS BILA ADA PERUBAHAN PADA CART (KUANTITAS) -->
						@if(session('status'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>{{ session('status') }} </strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						@endif

						<table class="table">
							<thead>
								<tr>
									<th>No</th>
									<th>Daftar Produk</th>
									<th>Total</th>
									<th>Status Pembayaran</th>
									<th>Status Pengiriman</th>
									<th>Ekspedisi</th>
									<th>Estimasi Waktu</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<!-- Jika pengguna belum pernah mengirim pesanan -->
								@if ($bills->count() == 0)
								<tr>
									<td colspan="8" lass="text-center">Saat ini Anda tidak memilik riwayat belanja apapun di website Linggom coffee.</td>
								</tr>	
								@endif

								@foreach($bills as $bill)
									<tr>
										<td>
											{{$i++}}
										</td>
										<td>
											@foreach($cartDetails as $cartDetail)
												@if($cartDetail->bill_id == $bill->id)
													- {{$cartDetail->products->nama_produk}} x <strong>{{$cartDetail->quantity}}</strong><br>
												@endif
											@endforeach		
										</td>
										<td>@currency($bill->payment + $bill->ongkir)</td>
										<td>
											{{$bill->payment_status}}
										</td>
										<td>
											{{$bill->shipping_status}}
										</td>
										<td>
											@foreach ($expeditions as $expedition)
												@if($expedition -> bill_id == $bill->id)
													{{strtoupper($expedition->courier)}}
												@endif
											@endforeach
										</td>
										<td>
											@foreach ($expeditions as $expedition)
												@if($expedition -> bill_id == $bill->id)
													{{strtoupper($expedition->etd)}} Hari
												@endif
											@endforeach
										</td>
										<td> 
											@if($bill->payment_status == "not verified")
												<!-- redirect ke wa business -->
												<a class="btn btn-outline-primary" href="https://wa.me/6285362888055">Kirim Bukti pembayaran</a>
											@else
											<i class="fa fa-check"></i> &nbsp; Bukti pembayaran terverifikasi 
											@endif
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<br><br><br>
		</div>	
	</section>

@endsection('content')