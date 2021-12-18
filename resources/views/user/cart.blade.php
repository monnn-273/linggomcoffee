<?php
	//Untuk menampilkan jumlah barang dalam cart
	use App\Models\Cart;
	$counter = Cart::where('customerId', Auth::user()->id)->count();

?>

@extends('user.headerfooter')
@section('title')
	<title>{{config('app_name','Linggom Coffee')}} - Cart </title>
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

	<!-- HERO -->
	<section class="home-slider owl-carousel">
		<div class="slider-item" style="background-image: url({{asset('images/lico-black-1.png')}});" data-stellar-background-ratio="0.5">
			<div class="overlay">
				<div class="container">
					<div class="row slider-text justify-content-center align-items-center">
						<div class="col-md-7 col-sm-12 text-center ftco-animate">
						<h1 class="mb-3 mt-5 h1">Cart</h1>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- USER CART -->
	<section class="ftco-section ftco-cart">
		<div class="container">
			<!--PRODUCT DALAM CART  -->
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
							<thead class="thead-primary">
								<tr class="text-center">
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>Product</th>
									<th>Price</th>
									<th colspan="2">Quantity</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<!-- JIKA PENGGUNA BELUM MENAMBAHKAN BARANG APAPUN KE CART -->
								@if($carts->count() == 0)
									<td>
										<td colspan="7"> Anda belum memiliki produk apapun dalam keranjang.</td>
									</td>
								@endif

								@php($total=0)
								@php($weight=0)
								@foreach($carts as $cart)
									<!--$total untuk menghitung semua biaya produk dalam keranjang pengguna  -->
									@php ($total = $total + $cart->payment)
									<!-- untuk keperluan input berat barang dan mencari ongkir-->
									@php($weight = $weight + ($cart->product->berat * $cart->quantity))
									<tr class="text-center">
										<td class="product-remove">
											<form action="{{__('/user/deleteCart')}}" method="POST">
												@csrf
												<input type="text" value="{{$cart->id}}" name="id" hidden>
												<button type="submit" class="btn btn-outline-danger px-3 py-3"  onclick="return confirm('Apakah Anda yakin ingin menghapus produk dari Cart? Anda tidak akan dapat lagi mengembalikan data ini setelah dihapus.')"><span class="icon-close"></span></button>
											</form>
										</td>
										<td class="image-prod"><img class="img" src="../images/{{$cart->product->gambar}}"></td>
											
										<td class="product-name">
											<h3>{{$cart->product->nama_produk}}</h3>
										</td>
											
										<td class="product-name" colspan="2">@currency($cart->product->harga)</td>	
										<td class="quantity">
											<form action="{{__('/user/updateQuantity')}}" method="POST">
											@csrf
												<input type="text" value="{{$cart->product->harga}}" name="price" hidden>
												<div class="input-group mb-3">
													<input type="text" value="{{$cart->id}}" name="cart_id" hidden>
													<input type="number" name="quantity" class="quantity form-control input-number" value="{{$cart->quantity}}" min="1" max="100">
													<button type="submit" class="btn btn-outline-primary px-2"><p class="text-white">Tetapkan</p></button>
												</div>
											</form>
										</td>
										<td class="price">@currency($cart->payment)</td>


									</tr>								
								@endforeach
								<tr>
									<td colspan="7">
										<div class="justify-content-end">
											Total : @currency($total)
										</div>
									</td>
								</tr>
								<!-- END TR-->
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<br><br><br>

			<!-- CEK ONGKOS KIRIM SECTION-->
			<div class="row justify-content-end">
				<div class="col-md-8">
					<form action="{{__('/user/cart')}}" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5" id="cekOngkir" role="form">
						@csrf
						<!-- Hidden input -->
						<input type="hidden" name="province_origin" value="{{  App\Models\Location::first()->province ? App\Models\Location::first()->province : '' }}">
						<input type="hidden" name="city_origin" value="{{  App\Models\Location::first()->city ? App\Models\Location::first()->city : '' }}">
						<input type="hidden" name="weight" value="{{$weight}}">

						<div class="col-xl-10 ftco-animate justify-content-end">
							<h3 class="mb-4 billing-heading">Alamat Pengiriman dan Ekspedisi</h3>	
							<div class="w-100"></div>
							<hr>
							<div class="col-md-12">
								<div class="form-group">	
									<label for="">Provinsi Tujuan</label>
									<select name="province_destination" class="form-control" id="province_destination" required>
										<option value="">--Provinsi--</option>
										<!-- MENAMPILKAN SEMUA DATA PROVINSI -->
										@foreach($provinces as $province => $value)
											<option value="{{$province}}" class=""> {{$value}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="col-md-12">
								<div class="-form-group">
									<label for="">Kabupaten / Kota Tujuan</label>
									<!-- MENAMPILKAN DATA KOTA BERDASARKAN ID PROVINSI -->
									<select name="city_destination" id="city_destination" class="form-control" required>
										<option>--Kota--</option>
									</select>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Kurir</label>
									<select name="courier" class="form-select form-control" required>
										@foreach ($couriers as $courier => $value)
										<option value="{{$courier}}">{{$value}}</option>
										@endforeach
									</select>
								</div>
								<div class="text-center">
									<button type="submit" class="btn btn-outline-primary text-white px-5 py-7"><p class="text-white">Lihat Ongkos Kirim</p></button>
								</div>		
							</div>
					</form>

						<div class="w-100"></div>
						<br><br>

						<!-- DATA ONGKIR BERDASARKAN LAYANAN YANG DIPILIH -->
						<div class="col-md-12">
							<div class="form-group">
								<label for="ongkir">Pilih Layanan</label>
								<p>...</p>
								<div id="ongkir"></div>
							</div>
						</div>
					</div>
			</div>
		</div>	
	</section>
@endsection('content')

@section('required_script')
	<!-- required script untuk data kota dan provinsi : untuk mendapatkan ongkos kirim -->
	<script>
      $(document).ready(function() {
          $('select[name="province_origin"]').on('change', function() {
              let provinceId = $(this).val();
              if (provinceId) {
                  $.ajax({
                      url: '/province/' + provinceId + '/cities',
                      type: "GET",
                      dataType: "json",
                      success: function(data) {
                          $('select[name="city_origin"]').empty();
                          $.each(data, function(key, value) {
                              $('select[name="city_origin"]').append(`<option value="${key}">${value}</option>`);
                          });
                      },
                  });
              } else {
                  $('select[name="city_origin"]').empty();
              }
          });

          $('select[name="province_destination"]').on('change', function() {
              let provinceId = $(this).val();
              if (provinceId) {
                  $.ajax({ 
                      url: '/province/' + provinceId + '/cities',
                      type: "GET",
                      dataType: "json",
                      success: function(data) {
                          $('select[name="city_destination"]').empty();
                          $.each(data, function(key, value) {
                              $('select[name="city_destination"]').append(`<option value="${key}">${value}</option>`);

                          });
                      },
                  });
              } else {
                  $('select[name="city_destination"]').empty();
              }
          });


      });

      // pakai vanila js untuk mengambil data dari API yang sudah di buat di laravel
      document.getElementById('cekOngkir').addEventListener('submit', async (event) => {
          // prevent default untuk menghindari halaman di refresh
          event.preventDefault();
          // mengambil data dari form
          const dari = document.getElementsByName('city_origin')[0].value
          const ke = document.getElementsByName('city_destination')[0].value
          const kurir = document.getElementsByName('courier')[0].value
          const berat = document.getElementsByName('weight')[0].value
          const token = document.getElementsByName('_token')[0].value
          // mengambil data dari API
          const result = await fetch('/user/cart', {
              // menentukan method yang digunakan pada API (POST)
              method: 'POST',
              // menentukan header yang digunakan pada API (JSON)
              headers: {
                  'Content-Type': 'application/json'
              },
              // menentukan body yang digunakan pada API (JSON)
              body: JSON.stringify({
                  _token: token,
                  city_origin: dari,
                  city_destination: ke,
                  courier: kurir,
                  weight: berat
              })
          })
          // mengambil data dari API (JSON) yang sudah di decode menjadi object javascript
          const response = await result.json()
          // mengosongkan id ongkir
          $('#ongkir').empty();
          // memunculkan class ongkir
          $('.ongkir').addClass('d-block');
          // menggunakan map untuk mengambil setiap data dalam bentuk object javascript
          await response[0]['costs'].map(value => {
              // memasukkan data ke dalam list group (ul) dengan id ongkir pada html
              $('#ongkir').append(`
              <li class="">
              ${response[0].code.toUpperCase()} : <strong>${value.service}</strong> - Rp. ${value.cost[0].value} (${value.cost[0].etd} hari) 
              <form action="/user/bill" method="POST">
				<input type="hidden" name="_token" value="${token}">
				<input type="hidden" name="courier" value="${response[0].code}">
				<input type="hidden" name="service" value="${value.service}">
				<input type="hidden" name="cost" value="${value.cost[0].value}">
				<input type="hidden" name="etd" value="${value.cost[0].etd}">
				<input type="hidden" name="weight" value="${berat}">
				<input type="hidden" name="city_origin" value="${dari}">
				<input type="hidden" name="city_destination" value="${ke}">
				<button type="submit" class="btn btn-outline-primary px-5 py-3"><p class="text-white">Pilih</p></button>
              </form>
			  <br><br>
              </li>`)
          });
      })
  </script>
@endsection

