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

<body class="bg-login">
	<!-- wrapper -->
	<div class="wrapper">
		<div class="section-authentication-login d-flex align-items-center justify-content-center mt-4">
			<div class="row">
				<div class="col-12 col-lg-8 mx-auto">
					<div class="card radius-15 overflow-hidden">
						<div class="row g-0">
							<div class="col-xl-6">
								<div class="card-body p-5">
									<div class="text-center">
										<img src="/assets/images/logo-pnj.png" width="150" alt="">
										<h3 class="mt-4 font-weight-bold">Login Admin/Operator</h3>
                                        @if (\Session::has('error'))
                                            <div class="alert alert-danger border-0 bg-danger fade show">
                                                <div class="text-white">{!! \Session::get('error') !!}</div>
                                            </div>
                                        @endif
									</div>
									<div class="">
										<div class="form-body">
											<form class="row g-3" action="{{ route('karyawan.proses-login') }}" method="POST">
                                                @csrf
												<div class="col-12">
													<label for="inputEmailAddress" class="form-label">Username</label>
													<input name="userid" type="text" class="form-control" id="inputEmailAddress" placeholder="Masukkan Username">
												</div>
												<div class="col-12">
													<label for="inputChoosePassword" class="form-label">Password</label>
													<div class="input-group" id="show_hide_password">
														<input name="password" type="password" class="form-control border-end-0" id="inputChoosePassword" value="" placeholder="Masukkan Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
													</div>
												</div>
												<div class="col-12">
													<div class="d-grid">
														<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Login</button>
													</div>
												</div>
                                                <div class="col-12 text-center">
                                                    <a href="/"><i class="bx bxs-chevron-left"></i> Kembali</a>
                                                </div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-6 bg-login-color d-flex align-items-center justify-content-center">
								<img src="/assets/images/login-images/login-image.png" class="img-fluid" alt="...">
							</div>
						</div>
						<!--end row-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
</body>

<!--plugins-->
<script src="/assets/js/jquery.min.js"></script>
<!--Password Show & Hide JS -->
<script>
	$(document).ready(function () {
		$("#show_hide_password a").on('click', function (event) {
			event.preventDefault();
			if ($('#show_hide_password input').attr("type") == "text") {
				$('#show_hide_password input').attr('type', 'password');
				$('#show_hide_password i').addClass("bx-hide");
				$('#show_hide_password i').removeClass("bx-show");
			} else if ($('#show_hide_password input').attr("type") == "password") {
				$('#show_hide_password input').attr('type', 'text');
				$('#show_hide_password i').removeClass("bx-hide");
				$('#show_hide_password i').addClass("bx-show");
			}
		});
	});
</script>
</html>
