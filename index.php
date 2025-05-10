<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>ระบบลงโทษทางวินัยผ่านเว็ปไซต์</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="./assetLogin/images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assetLogin/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assetLogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assetLogin/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assetLogin/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assetLogin/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assetLogin/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assetLogin/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assetLogin/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assetLogin/css/util.css">
	<link rel="stylesheet" type="text/css" href="./assetLogin/css/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(./assets/images/bg-01.jpg);">
					<span class="login100-form-title-1">
						ระบบลงโทษทางวินัยผ่านเว็ปไซต์
					</span>
					<span style="color: white;">(Warning Letter System)</span>
				</div>

				<form class="login100-form validate-form" method="POST">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">ชื่อผู้ใช้งาน</span>
						<input class="input100" type="text" name="username" id="username" placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
						<span class="label-input100">รหัสผ่าน</span>
						<input class="input100" type="password" name="password" id="password" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>
					<div class="container-login100-form-btn" onclick="login()">
						<button class="login100-form-btn" type="button">
							เข้าสู่ระบบ
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!--===============================================================================================-->
	<script src="./assetLogin/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="./assetLogin/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="./assetLogin/vendor/bootstrap/js/popper.js"></script>
	<script src="./assetLogin/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="./assetLogin/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="./assetLogin/vendor/daterangepicker/moment.min.js"></script>
	<script src="./assetLogin/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="./assetLogin/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="./assetLogin/js/main.js"></script>
	<script src="./assets/js/plugins/sweetalert/sweetalert2.min.js"></script>
</body>

</html>
<script>
	function login() {
		$.ajax({
			type: "POST",
			url: "./save/checkLogin.php",
			data: {
				username: $('#username').val(),
				password: $("#password").val()
			}, // serializes the form's elements.
			dataType: "json",
			success: function(response) {
				if (response.Status == false) {
					Swal.fire({
						title: response.Message,
						icon: "error"
					});
				} else {
					location.href = "./form/frmSend.php?menu_id=0"
				}
			}
		});
	}
</script>