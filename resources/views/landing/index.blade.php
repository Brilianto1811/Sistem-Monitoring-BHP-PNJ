<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>PNJ - BHP</title>
	<!--favicon-->
	<link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png" />
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
</head>

<body class="bg-lock-screen">
	<!-- wrapper -->
	<div class="wrapper">
		<div class="authentication-lock-screen d-flex align-items-center justify-content-center">
			<div class="card shadow-none bg-transparent">
				<div class="card-body p-md-5 text-center">
					<h1 class="mt-5 text">Sistem Monitoring Bahan Habis Pakai (BHP)</h1>
					<h3 class="text">{{ $waktu }}</h3>
					<h3 class="text">{{ $tanggal }}</h3>
					<div class="">
						<img src="/assets/images/icons/user.png" class="mt-5" width="120" alt=""/>
					</div>
					<h5 class="mt-2 text">Login sebagai</h5>
                    <a href="{{ route('karyawan.form-login') }}" class="btn btn-primary btn-md lis-rounded-circle-50 px-4 mx-1 my-1" data-abc="true"><i class="fa fa-shopping-cart pl-2"></i>ADMIN / OPERATOR</a>
                    <a href="{{ route('mahasiswa.form-login') }}" class="btn btn-success btn-md lis-rounded-circle-50 px-4 mx-1 my-1" data-abc="true"><i class="fa fa-shopping-cart pl-2"></i>MAHASISWA</a>
                    <p class="mt-5 text">&copy; 2023 | Developed by TIK - TI</p>
                    <p class="text">Page Rendered: {{ (microtime(true) - LARAVEL_START) }}</p>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
</body>

</html>
