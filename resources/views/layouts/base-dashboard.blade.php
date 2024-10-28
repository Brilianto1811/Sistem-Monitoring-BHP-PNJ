<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>PNJ - BHP @yield('title')</title>
	<!--favicon-->
	<link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png" />
	<!-- Vector CSS -->
	<link href="/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<!--plugins-->
	<link href="/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="/assets/css/pace.min.css" rel="stylesheet" />
	<script src="/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&family=Roboto&display=swap" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="/assets/css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="/assets/css/app.css" />
	<link rel="stylesheet" href="/assets/css/dark-sidebar.css" />
	<link rel="stylesheet" href="/assets/css/dark-theme.css" />
    <!--Data Tables -->
	<link href="/assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
	<link href="/assets/plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    <!-- Custom CSS -->
    @yield('custom-css')
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		@include('layouts.sidebar')
        @include('layouts.navbar')

		<!--page-wrapper-->
		<div class="page-wrapper">
			<!--page-content-wrapper-->
			<div class="page-content-wrapper">
				<div class="page-content">
					@yield('content')
				</div>
			</div>
			<!--end page-content-wrapper-->
		</div>
		<!--end page-wrapper-->

        <!--start overlay-->
		<div class="overlay toggle-btn-mobile"></div>
		<!--end overlay-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->

		<!--footer -->
		<div class="footer d-none d-md-block d-lg-block d-xl-block d-xxl-block">
			<p class="mb-0">&copy; 2023 | Developed by Jurusan TIK - Prodi TI | Page Rendered: {{ (microtime(true) - LARAVEL_START) }}
			</p>
		</div>
		<!-- end footer -->
	</div>
	<!-- end wrapper -->

	<!--start switcher-->
	<div class="switcher-body">
		<button class="btn btn-primary btn-switcher shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bx bx-cog bx-spin"></i></button>
		<div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling">
			<div class="offcanvas-header border-bottom">
				<h5 class="offcanvas-title" id="offcanvasScrollingLabel">Mode Tema</h5>
				<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
		  	</div>
		  	<div class="offcanvas-body">
				<h6 class="mb-0">Variasi Mode Tema</h6>
				<hr>
				<div class="form-check form-check-inline">
			  		<input class="form-check-input" type="radio" name="inlineRadioOptions" id="lightmode" value="option1" checked>
			  		<label class="form-check-label" for="lightmode">Light</label>
				</div>
				<hr>
				<div class="form-check form-check-inline">
			  		<input class="form-check-input" type="radio" name="inlineRadioOptions" id="darkmode" value="option2">
			  		<label class="form-check-label" for="darkmode">Dark</label>
				</div>
				<hr>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="darksidebar" value="option3">
					<label class="form-check-label" for="darksidebar">Semi Dark</label>
			  	</div>
			  	<hr>
		  	</div>
		</div>
	</div>
	<!--end switcher-->

    <!-- JavaScript -->

	<!-- Bootstrap JS -->
	<script src="/assets/js/bootstrap.bundle.min.js"></script>

	<!--plugins-->
	<script src="/assets/js/jquery.min.js"></script>
	<script src="/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>

    <!-- Vector map JavaScript -->
	{{-- <script src="/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
	<script src="/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="/assets/plugins/vectormap/jquery-jvectormap-in-mill.js"></script>
	<script src="/assets/plugins/vectormap/jquery-jvectormap-us-aea-en.js"></script>
	<script src="/assets/plugins/vectormap/jquery-jvectormap-uk-mill-en.js"></script>
	<script src="/assets/plugins/vectormap/jquery-jvectormap-au-mill.js"></script>
	<script src="/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script> --}}
    <script src="/assets/js/index.js"></script>

    <!-- App JS -->
	<script src="/assets/js/app.js"></script>
	<script>
		// new PerfectScrollbar('.dashboard-social-list');
		// new PerfectScrollbar('.dashboard-top-countries');
	</script>

    <!--Data Tables js-->
	<script src="/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>

    <!--Select2 js-->
    <script src="/assets/plugins/select2/js/select2.min.js"></script>

    <!--VUE 3.3.2/vue.global.prod.min.js -->
    <script src="/assets/js/vue.global.prod.min.js"></script>

    <!--CUSTOM JS-->
    @yield('custom-js')
</body>

</html>
