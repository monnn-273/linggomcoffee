<!doctype html>
<html lang="en">
<head>
  	<title>{{config('app_name','Linggom Coffee')}} - Reset Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{asset('auth/css/style.css')}}">

</head>

<body style="background-image: url({{asset('images/bg_2.jpg')}});">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-6">
					<div class="login-wrap py-5">
		      			<div class="img d-flex align-items-center justify-content-center" style="background-image: url(images/lico-black-5.png);"></div>
		      			<h3 class="text-center mb-0">H O R A S !</h3>
		      			<p class="text-center">Link untuk reset password Anda akan dikirim ke alamat email yang Anda gunakan saat mendaftar.</p>

                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

					<!-- FORM ALAMAT EMAIL -->
					<form method="POST" class="login-form" action="{{ route('password.email') }}">
					    @csrf
                        <label for="email">Alamat Email</label>
						<div class="form-group">
							<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-envelope"></span></div>
							<input id="email" type="email" placeholder="Masukkan email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
						</div>
						
						<div class="form-group">
							<button type="submit" class="btn form-control btn-primary rounded submit px-3">{{ __('Kirim Link Reset Password') }}</button>
						</div>

	          		</form>
					<!-- AKHIR LOGIN FORM -->

	          <div class="w-100 text-center mt-4 text">
		          <a href="{{route ('register')}}">Daftar</a> &nbsp;&nbsp; |  &nbsp;&nbsp;
                  <a href="{{route ('login')}}">Login</a>
	          </div>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="auth/js/jquery.min.js"></script>
  	<script src="auth/js/popper.js"></script>
  	<script src="auth/js/bootstrap.min.js"></script>
  	<script src="auth/js/main.js"></script>

</body>
</html>





<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->

