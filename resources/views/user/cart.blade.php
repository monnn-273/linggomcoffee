@extends('user.headerfooter')
@section('title')
	<title>{{config('app_name','Linggom Coffee')}} - Cart </title>
@endsection('title')

@section('content')

<!-- Header -->
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

<section class="ftco-section ftco-cart">
	<div class="container">
		<div class="row">
    		<div class="col-md-12 ftco-animate">	
    			<div class="cart-list">
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
                            
                            @foreach($carts as $cart)
								

									<tr class="text-center">
										<td class="product-remove">
											<form action="{{__('/user/deleteCart')}}" method="POST">
												@csrf
												<input type="text" value="{{$cart->id}}" name="id" hidden>
												<button type="submit" class="a"><span class="icon-close"></span></button>
											</form>
										</td>
										<td class="image-prod"><img class="img" src="../images/{{$cart->product->gambar}}"></td>
											
										<td class="product-name">
											<h3>{{$cart->product->nama_produk}}</h3>
										</td>
											
										<td class="price">@currency($cart->product->harga)</td>
											
										<form action="{{__('/user/updateQuantity')}}" method="POST">
										@csrf
											<input type="text" value="{{$cart->product->harga}}" name="price" hidden>
											<td class="quantity">
												<div class="input-group mb-3">
													<input type="text" value="{{$cart->id}}" name="cart_id" hidden>
													<input type="number" name="quantity" class="quantity form-control input-number" value="{{$cart->quantity}}" min="1" max="100">
												</div>
											</td>
											<td>
												<div class="row justify-content-end">
													<div class="col col-lg-6 col-md-6 mt-5 cart-wrap ftco-animate">
														<button type="submit" class="btn btn-success">Tetapkan</button>
													</div>
												</div>
											</td>
										</form>
										
										<td class="total">@currency(($cart->product->harga * $cart->quantity) + $cart->ongkir)</td>
									</tr>	
									<tr>

									</tr>							
                            @endforeach
                            <!-- END TR-->
					    </tbody>
				    </table>
			    </div>
    	    </div>
        </div>

    	<!--PROCEED TO CHECKOUT  -->
        <div class="row justify-content-end">
    		<div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
				<form action="">
					
				</form>
    			<p class="text-center"><a href="{{__('/user/checkout')}}" class="btn btn-primary py-3 px-4">Show The Bills</a></p>
    		</div>
    	</div>
	</div>
</section>

@endsection('content')