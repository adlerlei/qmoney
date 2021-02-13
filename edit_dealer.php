<?php
require_once 'php/db.php';
require_once 'php/functions.php';
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
	header("Location: index.php");
}
if($_SESSION['user_identification'] == "經銷商" ){
	header("Location: add_search_member.php");
}
$data = get_dealer($_GET['i']);
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
			<div style="margin: 0px auto; text-align: center;" class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
				<div style="text-align: center; margin-bottom: 30px;">
				<!-- <nav class="navbar fixed-top justify-content-center navbar-dark bgblack">
					<a class="navbar-brand" href="#!">QMoney</a>
					<a class="nav-link active" href="add_search_member.php">建立 | 查詢會員資料</a>
					<a class="nav-link" href="create_member.php">建立總部帳號</a>
					<a style="color: #f6f6f6;" class="nav-link" href="#">建立經銷商帳號</a>
					<a class="nav-link" href="search_dealer.php">查詢經銷商</a>
					<a class="nav-link" href="php/logout.php">登出</a>
				</nav>		 -->		
				<div style="font-size: 10pt; text-align: center;">
					Q MONEY TEAM 修改經銷商資料
				</div>
				<form id="register" class="login100-form">
					<span class="login100-form-title p-b-55">
						Edit Dealer
					</span>
					<div class="wrap-input100 validate-input m-b-16">
						<input id="qid" class="input100" type="number" name="qid" placeholder="請輸入QID" required="required" value="<?php echo $data['qid']; ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-id-card"></i>						
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16">
						<input class="input100" type="text" id="userName" name="userName" placeholder="用戶名稱" required="required" value="<?php echo $data['username']; ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-user"></span>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16">
						<input id="password" class="input100" type="text" name="password" placeholder="密碼">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16">
						<input class="input100" type="text" id="dealer_name" name="dealer_name" placeholder="經銷商名稱" required="required" value="<?php echo $data['dealer_name']; ?>" >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-users"></span>						
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16">
						<input class="input100" type="number" id="phone" name="phone" placeholder="手機" required="required" value="<?php echo $data['phone']; ?>" >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-smartphone"></span>						
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16">
						<input class="input100" type="text" id="region" name="region" placeholder="地區" required="required" value="<?php echo $data['region']; ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-earth"></span>						
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16">
						<input class="input100" type="text" id="address" name="address" placeholder="經銷商門市地址" required="required" value="<?php echo $data['address']; ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-pushpin"></span>
						</span>
					</div>

 					<div class="wrap-input100 validate-input m-b-16">
						<textarea id="remarks" class="input100" type="text" name="remarks">
							<?php echo $data['remarks']; ?>
						</textarea>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-pencil"></span>
						</span>
					</div>

					<input type="hidden" id="uid" name="uid" value="<?php echo $data['uid']; ?>">

					<div class="container-login100-form-btn p-t-25">
						<button type="submit" class="login100-form-btn">
							存檔
						</button>
					</div>
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
<!-- 	<script src="vendor/select2/select2.min.js"></script>
--><!--===============================================================================================-->
<script src="js/main.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
//當文件準備好時，
$(document).on("ready", function(){
	$("#qid").on("keyup",function(){
		if($(this).val()!=''){
			//非空字串檢查
			$.ajax({
				type : "POST",
				url : "php/check_qid.php",
				data : {
				qid : $("#qid").val(), //用戶登入qid
				},
				dataType : 'html' //設定該網頁回應的會是 html 格式
			}).done(function(data){
				if(data == "yes"){
					alert("無法修改！QID重複！請確認QID！");
					$("button").attr("disabled", true);
				}
				else
				{
					$("#register button").attr("disabled", false);		        
				}
			}).fail(function(jqXHR, textStatus, errorThrown) {
			//失敗的時候
				alert("有錯誤產生，請看 console log");
				console.log(jqXHR.responseText);
			});
		}else{

		}
	});
	//當表單 sumbit 出去的時候
	$("form").on("submit", function(){
	$.ajax({
		type : "POST",
		url : "php/update_dealer.php",
		data : {
		'uid' : $("#uid").val(),
		'q' : $("#qid").val(),
		'un' : $("#userName").val(),
		'pw' : $("#password").val(),
		'dn': $("#dealer_name").val(),
		'pe': $("#phone").val(),
		'ri': $("#region").val(),
		'ad' : $("#address").val(),
		'rk' : $("#remarks").val()
		},
		dataType : 'html' //設定該網頁回應的會是 html 格式
	}).done(function(data){
		//console.log(data);
		if(data == "yes"){
			alert("修改完成！")
			window.location.href = "search_dealer.php";
		}
		else
		{
			alert("修改失敗！請確認電腦網路是否正常！")
			console.log(data);       
		}
	}).fail(function(jqXHR, textStatus, errorThrown) {
	//失敗的時候
		alert("有錯誤產生，請看 console log");
		console.log(jqXHR.responseText);
	});
	return false;
	});
});
</script>
</body>
</html>