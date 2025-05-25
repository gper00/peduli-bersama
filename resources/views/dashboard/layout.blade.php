<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Dashboard</title>
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
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="/assets/dashboard/css/demo.css">

	{{-- froala editor --}}
	<link rel="stylesheet" href="/assets/dashboard/js/plugin/froala-editor/css/froala_editor.pkgd.min.css">
</head>
<body>
	<div class="wrapper">
		{{-- Navbar --}}
		@include('dashboard.partials.navbar')

		{{-- Sidebar --}}
		@include('dashboard.partials.sidebar')

        <div class="main-panel">

            @yield('page-content')

            {{-- Footer --}}
			@include('dashboard.partials.footer')
        </div>

		<!-- Custom template | don't include it in your project! -->
		{{-- <div class="custom-template">
			<div class="title">Settings</div>
			<div class="custom-content">
				<div class="switcher">
					<div class="switch-block">
						<h4>Logo Header</h4>
						<div class="btnSwitch">
							<button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
							<button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="white"></button>
							<br/>
							<button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Navbar Header</h4>
						<div class="btnSwitch">
							<button type="button" class="changeTopBarColor" data-color="dark"></button>
							<button type="button" class="changeTopBarColor" data-color="blue"></button>
							<button type="button" class="changeTopBarColor" data-color="purple"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue"></button>
							<button type="button" class="changeTopBarColor" data-color="green"></button>
							<button type="button" class="changeTopBarColor" data-color="orange"></button>
							<button type="button" class="changeTopBarColor" data-color="red"></button>
							<button type="button" class="changeTopBarColor" data-color="white"></button>
							<br/>
							<button type="button" class="changeTopBarColor" data-color="dark2"></button>
							<button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="purple2"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="green2"></button>
							<button type="button" class="changeTopBarColor" data-color="orange2"></button>
							<button type="button" class="changeTopBarColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Sidebar</h4>
						<div class="btnSwitch">
							<button type="button" class="selected changeSideBarColor" data-color="white"></button>
							<button type="button" class="changeSideBarColor" data-color="dark"></button>
							<button type="button" class="changeSideBarColor" data-color="dark2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Background</h4>
						<div class="btnSwitch">
							<button type="button" class="changeBackgroundColor" data-color="bg2"></button>
							<button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
							<button type="button" class="changeBackgroundColor" data-color="bg3"></button>
							<button type="button" class="changeBackgroundColor" data-color="dark"></button>
						</div>
					</div>
				</div>
			</div>
			<div class="custom-toggle">
				<i class="flaticon-settings"></i>
			</div>
		</div> --}}
		<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
	<script src="/assets/dashboard/js/core/jquery.3.2.1.min.js"></script>
	<script src="/assets/dashboard/js/core/popper.min.js"></script>
	<script src="/assets/dashboard/js/core/bootstrap.min.js"></script>
	<!-- jQuery UI -->
	<script src="/assets/dashboard/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="/assets/dashboard/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="/assets/dashboard/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<!-- Datatables -->
	<script src="/assets/dashboard/js/plugin/datatables/datatables.min.js"></script>
	<!-- Atlantis JS -->
	<script src="/assets/dashboard/js/atlantis.min.js"></script>
	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="/assets/dashboard/js/setting-demo2.js"></script>

	{{-- Sweet Alert --}}
	<script src="/assets/dashboard/js/plugin/sweetalert/sweetalert.min.js"></script>
	{{-- Bootstrap Notify --}}
	<script src="/assets/dashboard/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
	{{-- froala editor --}}
	<script src="/assets/dashboard/js/plugin/froala-editor/js/froala_editor.pkgd.min.js"></script>

	{{-- Custom JS --}}
	<script src="/assets/dashboard/js/custom.js"></script>

    {{-- Page specific scripts --}}
    @yield('scripts')
</body>
</html>
