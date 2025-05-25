<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Daftar Akun | Peduli Bersama</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="/assets/dashboard/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="/assets/dashboard/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['/assets/dashboard/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="/assets/dashboard/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/dashboard/css/atlantis.min.css">
	<style>
		.myForm {
			width: 400px;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			box-sizing: border-box;
		}
		@media (max-width: 500px) {
			.myForm {
				min-width: 90%;
			}
		}
		
		.btn-blue {
            background-color: #1e40af !important;
            border-color: #1e40af !important;
        }
        
        .btn-blue:hover {
            background-color: #1e3a8a !important;
            border-color: #1e3a8a !important;
        }
        
        .text-blue {
            color: #1e40af !important;
        }
        
        a {
            color: #1e40af;
        }
        
        a:hover {
            color: #1e3a8a;
        }
	</style>
</head>
<body class="bg-light">
	{{-- flash data --}}
	<div class="flash-data" data-message="{{ session()->has('failed') ? session('failed') : '' }}"></div>

	<div class="myForm">
		<div class="card px-2 py-4">
			<div class="card-body">
				<div class="text-center mb-4">
					<h3 class="mb-1">Daftar Akun</h3>
					<p class="text-muted small">Daftar sebagai donatur untuk membantu sesama</p>
				</div>
				
				@if(session('failed'))
				<div class="alert alert-danger">
				    {{ session('failed') }}
				</div>
				@endif
				
				<form action="{{ route('register') }}" method="post">
					@csrf

					<div class="form-group mb-2 form-floating-label">
						<input
							id="name"
							type="text"
							class="form-control input-border-bottom @error('name') is-invalid @enderror"
							name="name"
							value="{{ old('name') }}"
							autocomplete="off"
							required
						/>
						<label for="name" class="placeholder">Nama Lengkap</label>
						@error('name')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
					
					<div class="form-group mb-2 form-floating-label">
						<input
							id="email"
							type="email"
							class="form-control input-border-bottom @error('email') is-invalid @enderror"
							name="email"
							value="{{ old('email') }}"
							autocomplete="off"
							required
						/>
						<label for="email" class="placeholder">Email</label>
						@error('email')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
					
					<div class="form-group mb-2 form-floating-label">
						<input
							id="username"
							type="text"
							class="form-control input-border-bottom @error('username') is-invalid @enderror"
							name="username"
							value="{{ old('username') }}"
							autocomplete="off"
							required
						/>
						<label for="username" class="placeholder">Username</label>
						@error('username')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>

					<div class="form-group mb-2 form-floating-label">
						<input
							id="password"
							type="password"
							class="form-control input-border-bottom @error('password') is-invalid @enderror"
							name="password"
							required
						/>
						<label for="password" class="placeholder">Password</label>
						@error('password')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
					
					<div class="form-group mb-2 form-floating-label">
						<input
							id="password_confirmation"
							type="password"
							class="form-control input-border-bottom"
							name="password_confirmation"
							required
						/>
						<label for="password_confirmation" class="placeholder">Konfirmasi Password</label>
					</div>

					<div class="form-group row justify-content-center mt-4">
						<button class="btn btn-round btn-lg btn-blue text-white px-5" type="submit">Daftar</button>
					</div>
					
					<div class="text-center mt-3">
						<p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue">Masuk di sini</a></p>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!--   Core JS Files   -->
	<script src="/assets/dashboard/js/core/jquery.3.2.1.min.js"></script>
	<script src="/assets/dashboard/js/core/popper.min.js"></script>
	<script src="/assets/dashboard/js/core/bootstrap.min.js"></script>
	<!-- Atlantis JS -->
	<script src="/assets/dashboard/js/atlantis.min.js"></script>
	<!-- Sweet Alert -->
	<script src="/assets/dashboard/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Custom JS -->
	<script src="/assets/dashboard/js/custom.js"></script>
</body>
</html>
