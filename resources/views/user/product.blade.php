@extends('user.headerfooter')
@section('title')
    <title>{{config('app_name','Linggom Coffee')}} - Cart </title>
@endsection('title')

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
    <!-- AKHIR HERO SECTION-->


    <section class="ftco-menu mb-5 pb-5">
    	<div class="container">

            <!-- TITLE -->
    		<div class="row justify-content-center mb-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Linggom Coffee</span>
                    <br>
                    <h2 class="mb-4">Semua Produk</h2>
                    <p>Semua produk menggunakan kopi natural yang berasal dari single-origin Sidikalang, Kabupaten Dairi. Proses pengolahan mulai dari penjemuran, penggilingan, penggongsengan, dan pengemasan di Kota Kopi Kebanggan Dairi :)</p>
                </div>
            </div>

            <!-- MENU -->
    		<div class="row d-md-flex">
	    		<div class="col-lg-12 ftco-animate p-md-5">
		    		<div class="row">

		                <div class="col-md-12 d-flex align-items-center">
        		            <div class="tab-content ftco-animate" id="v-pills-tabContent"> 
		                        <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
		              	            <div class="row">
                                        @foreach($products as $product)
                                            <div class="col-md-4 text-center">
                                                <div class="menu-wrap">
                                                    <center><img class="menu-img img mb-4" src="../images/{{$product->gambar}}" style=""></center>
                                                    <div class="text">
                                                        <h3><a href="">{{$product->nama_produk}}</a></h3>
                                                        <p>{{$product->deskripsi}}.</p>
                                                        <p class="price"><span>@currency($product->harga)</span></p>
                                                        <p>
                                                            <form action="{{__('/user/addToCart')}}" method="POST">
                                                                @csrf
                                                                <input type="text" value="{{$product->id}}" name="productId" hidden>
                                                                <input type="text" value="{{Auth::user()->id}}" name="customerId" hidden>
                                                                <input type="text" value="{{$product->harga}}" name="price" hidden>
                                                                <button type="submit" class="btn btn-primary btn-outline-primary">Add to cart</button>
                                                            </form>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>   
                                        @endforeach        
		              		        </div>  
		              	        </div>
		                    </div>
		                </div>

		            </div>
		        </div>
		    </div>
		</div>
    </section>

@endsection('content')