<!DOCTYPE html>
<html lang="en">
  <head>
    <title>{{config('app_name','Linggom Coffee')}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.timepicker.css')}}">

    
    <link rel="stylesheet" href="{{asset('css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
  </head>

  <body>
    <!-- NAVBAR -->
  	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="{{__('/')}}">Linggom<small>Coffee</small></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="{{__('/')}}" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="#about" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="{{__('/profile')}}" class="nav-link">Profile</a></li>
	          <li class="nav-item"><a href="{{__('/products')}}" class="nav-link">Products</a></li>
	          <li class="nav-item"><a href="#contact" class="nav-link">Contacts</a></li>
	        </ul>

          <ul class="navbar-nav ml-auto justify-content-right">
	          <li class="nav-item"><a href="{{route('register')}}" class="btn btn-white btn-outline-white p-3 px-xl-5 py-xl-3">Daftar</a></li>
            <li class="nav-item"><a href="#" class="nav-link"></a></li>
	          <li class="nav-item"><a href="{{route('login')}}" class="btn btn-white btn-outline-white p-3 px-xl-5 py-xl-3">Masuk</a></li>
	        </ul>
	      </div>
		  </div>
	  </nav>
    <!-- END nav -->

    @yield('content')

  <footer class="ftco-footer ftco-section img" id="contact">
    <div class="overlay"></div>
    <div class="container">
      <div class="row mb-5">
        <div class="col-lg-3 col-md-6 mb-5 mb-md-5">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">About Us</h2>
            <p>UMKM yang menjual produk kopi lokal, single origin Sidikalang, Kabupaten Dairi.</p>
            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
              <li class="ftco-animate"><a href="https://l.wl.co/l?u=https%3A%2F%2Fwww.instagram.com%2Flinggom_coffee"><span class="icon-instagram"></span></a></li>
              <li class="ftco-animate"><a href="https://www.facebook.com/LinggomCoffee/"><span class="icon-facebook"></span></a></li>
              <li class="ftco-animate"><a href="https://www.youtube.com/channel/UCSAioYSZwHRLnF6-Cq6f4Xg"><span class="icon-youtube"></span></a></li>
            </ul>
          </div>
        </div>
        
        <div class="col-lg-6 col-md-6 mb-5 mb-md-5">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Contact Us</h2>
            <div class="block-23 mb-3">
              <ul>
                <li><span class="icon icon-map-marker"></span><span class="text">Jl. Empat Lima, Batang Beruh, Dairi Regency, North Sumatra 22212</span></li>
                <li><a href="https://wa.me/6285362888055"><span class="icon icon-phone"></span><span class="text">+62 853-6288-8055</span></a></li>
                <li><a href="mailto:linggomcoffee@gmail.com"><span class="icon icon-envelope"></span><span class="text">linggomcoffee@gmail.com</span></a></li>
                <li><a href="https://www.tokopedia.com/linggomcoffee" target="blank"><span class="icon icon-shopping_cart"></span><span class="text">Visit Linggom Coffee in Tokopedia </span></a></li>
                <li><a href="https://l.wl.co/l?u=https%3A%2F%2Fwww.blibli.com%2Fmerchant%2Fumkm-linggom-coffee%2FLIC-70078" target="blank"><span class="icon icon-shopping_cart"></span><span class="text">Visit Linggom Coffee in Blibli.com </span></a></li>
                
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">

          <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> Linggom Coffee. All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        </div>
      </div>
    </div>
  </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>