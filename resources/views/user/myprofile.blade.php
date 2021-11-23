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
    <!-- AKHIR HERO SECTION -->

    <!-- PROFILE SECTION -->
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-xl-10 col-12 ftco-animate">

                    <form action="{{__('/user/update_profile')}}" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
                        @csrf

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
                        <p class="mb-4">Data pada profile ini akan kami gunakan untuk pengiriman produk. Harap input data sebenar-benarnya. </p>

                        <input type="text" value="{{Auth::user()->id}}" name="user_id" hidden>
                        <div class="row align-items-end">

                            <div class="col-md-12 col-12 col-lg-12  ">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{Auth::user()->name}}">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-md-12 col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="address">Alamat Lengkap</label>
                                    <input id="address" type="text" class="form-control" name="address" placeholder="Nomor rumah/blok/gang, dan nama jalan" value="{{Auth::user()->address}}">
                                </div>
                            </div>
                            
                            <div class="w-100"></div>

                            <div class="col-md-12 col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="phone">Nomor Telephone (terhubung dengan Whatsapp) </label>
                                    <input id="phone" type="text" class="form-control" name="no_telp" value="{{Auth::user()->no_telp}}" placeholder="08XX XXXX XXXX">
                                </div>
                            </div>
                            <div class="col-md-6 col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="emailaddress">Alamat Email</label>
                                    <input type="email" id="emailaddress" class="form-control" name="email" placeholder="Masukkan alamat email yang valid" value="{{Auth::user()->email}}">
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