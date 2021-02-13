<?php
require_once 'php/db.php';
if(isset($_SESSION['is_login']) && $_SESSION['is_login']){
	header("Location: add_search_member.php");
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<title>Q MONEY TEAM SYSTEM</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter justify-content-start">
		<div class="container-login100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
				<div style="margin-bottom: 30px; text-align: center;">
					<img src="images/qlogo.png">
				</div>
				<form class="login100-form">
<!-- 					<span class="login100-form-title p-b-55">
						Q MONEY TEAM
					</span> -->
					<div class="wrap-input100 validate-input m-b-16">
						<input id="qid" class="input100" type="number" name="qid" placeholder="QID" required="required" >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-user"></span>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16">
						<input id="password" class="input100" type="password" name="password" placeholder="PassWord" required="required" >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-25">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center w-full p-t-115">
						<span class="txt1">
							&copy; <?php echo date("Y"); ?> QMoney Team System v 1.0
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<!-- <script src="vendor/select2/select2.min.js"></script> -->
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
$(document).on("ready", function()
{	
	$("form").on("submit", function()
	{
	$.ajax(
	{
		type : "POST",
		url : "php/verify_user.php",
		data : {
		'q' : $("#qid").val(),
		'pw' : $("#password").val()
		},
		dataType : 'html'
	}).done(function(data)
	{
		if(data == "yes")
		{
			//console.log(data);
			window.location.href = "add_search_member.php";
		}
		else
		{
			alert("登入失敗！請確認帳號密碼是否正確！")
			//debug
			console.log(data);    
		}
	}).fail(function(jqXHR, textStatus, errorThrown)
	{
		//login error
		alert("有錯誤產生，請看 console log");
		console.log(jqXHR.responseText);
	});
	return false;
});
});
</script>
</body>
</html>