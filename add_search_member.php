<?php
require_once 'php/db.php';
require_once 'php/functions.php';
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
	header("Location: index.php");
}
$datas = load_member();
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
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
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
	<link rel="stylesheet" type="text/css" href="css/main_system.css">
<!--===============================================================================================-->
<style type="text/css">
.navbar-center {
  display: inline-block;
  float: none;
  vertical-align: top;
}
.navbar-collapse-center {
  text-align: center;
}
</style>
</head>
<body>
	<div class="limiter justify-content-start">
		<div class="container-login100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
				<nav class="navbar fixed-top justify-content-center navbar-dark bgblack">
					<a class="navbar-brand" href="#!">QMoney</a>
					<a style="color: #f6f6f6;" class="nav-link active" href="#">建立 | 查詢會員資料</a>
					<?php 
					if( $_SESSION['user_identification'] == "總部" ){
					echo "<a class= 'nav-link' href='create_member.php'>建立總部帳號</a>";
					echo "<a class='nav-link' href='create_dealer.php'>建立經銷商帳號</a>";
					echo "<a class='nav-link' href='search_dealer.php'>查詢經銷商</a>";
					}
					?>					
					<?php
					if(isset($_SESSION['is_login'])){
					echo "<a class='nav-link' href='php/logout.php'>登出</a>";
					}
					?>
				</nav>
				<div class="row">
					<div style="text-align: center;" class="col-sm-6 mycontent-right">
				<form id="add_member_from" class="login100-form" action="php/insert_member.php" method="POST">
					<span class="login100-form-title p-b-55">
						 <img style="width: 80px;" src="images/qlogo.png"> Create User
					</span>
					<div class="wrap-input100 validate-input m-b-16">
						<input id="qid" class="input100" type="number" name="qid" placeholder="QID ( 必填 )" required="required">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-id-card"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16">
						<input id="username" class="input100" type="text" name="username" placeholder="用戶名稱 ( 必填 )" required="required">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user-circle-o"></i>						
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16">
						<input id="phone" class="input100" type="number" name="phone" maxlength="10" placeholder="手機 ( 必填 )" required="required">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone-square"></i>						
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16">
						<textarea  id="remarks" style="padding-top: 20px;" class="input100" type="text" name="remarks" placeholder="備註"></textarea>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-file-text"></i>
						</span>
					</div>

					<div class="wrap-input100 m-l-4">
						<select id="member_level" style="width: 100%; background-color: #ff7575;" name="member_level" class="custom-select" required="required">
							<option selected>請選擇用戶類別 ( 必填 )</option>
							<?php
							if($_SESSION['user_identification']=="總部"){
							echo "<option value='QMoney團隊''>QMoney團隊</option>";
							echo "<option value='非QMoney團隊成員''>非QMoney團隊成員</option>";
							echo "<option value='公司第一代''>公司第一代</option>";
							}else{
							echo "<option value='經銷商團隊''>經銷商團隊</option>";
							echo "<option value='非經銷商團隊成員''>非經銷商團隊成員</option>";
							echo "<option value='經銷商第一代''>經銷商第一代</option>";
							}
							?>
						</select>
					</div>
					
					<?php
					if($_SESSION['user_identification']=="經銷商"){
						echo"<input type='hidden' name='dealer_name' value={$_SESSION['dealer_name']}>";
					}
					?>

					<!-- <input type="hidden" name="identification" value="總部"> -->

					
					<div class="container-login100-form-btn p-t-25">
						<button id="addBtn" type="submit" class="login100-form-btn">
							建立用戶資料
						</button>
					</div>

					<div class="text-center w-full p-t-42 p-b-22">
						<span class="txt1">
							<hr>
						</span>
					</div>

				</form>
					</div>
				
					<div class="col-sm-6">
						<form class="login100-form">
					<span class="login100-form-title p-b-55">
						Search User <img style="width: 80px;" src="images/qlogo.png">
					</span>

					<!-- 搜尋會員資料 -->
					<div class="wrap-input100 validate-input m-b-16">
						<form name="selsct_member" method="GET" action="">
						<input id="search_member_qid" class="input100" type="text" name="search_member_qid" placeholder="請輸入欲搜尋的 QID" required="required">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						<i class="fa fa-search"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-25">
						<button name="btn" style="margin-top: -30px;" class="login100-form-btn">
							搜尋
						</button>
					</div>
				</form>

				<!-- 資料呈現 -->
				<div class="table-responsive-sm">
						<?php if(!empty($datas)): ?>
						<?php foreach($datas as $member): ?>
					<table id="cc" style="margin-top: 30px;" class="table table-striped">
						<thead>
							<tr style="background-color: #c58232;">
								<th>搜尋結果</th>
							</tr>
							<tr>
								<th>所屬：</th>
								<th><?php echo $member['dealer_name']; ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th>身分：</th>
								<th><?php echo $member['level']; ?></th>
							</tr>
							<tr>
								<th>QID：</th>
								<th><?php echo $member['qid']; ?></th>
							</tr>
							<tr>
								<th>名稱：</th>
								<th><?php echo $member['username']; ?></th>
							</tr>
							<tr>
								<th>手機：</th>
								<th><?php echo $member['phone']; ?></th>
							</tr>
							<tr>
								<th>註冊日期：</th>
								<th><?php echo$member['date']; ?></th>
							</tr>
							<tr>
								<th>備註：</th>
								<th><?php echo $member['remarks']; ?></th>
							</tr>
							<tr>
								<th></th>
								 <th class="text-right">
<?PHP if($_SESSION['user_identification']=="總部"): ?>
<a href='edit_member.php?i=<?php echo $member['uid'];?>' class="btn btn-warning">修改</a>&#12288;
<?PHP endif; ?>
<?php
/*
 if($_SESSION['user_identification'] == '總部'){
    echo"<a class='btn btn-warning' href='edit_member.php?i={$member['uid']}'>修改</a>";
} 
*/
?>

								 </th>
							</tr>
						</tbody>
					</table>
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<!-- 資料呈現結束 -->
					</div>
				</div>
			</div>
		</div>
	</div>
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<!-- <script src="vendor/select2/select2.min.js"></script>
 --><!--===============================================================================================-->
	<!-- <script src="js/main.js"></script> -->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>


<script>
$(document).on("ready", function(){
	$("#qid").on("keyup",function(){
		if($(this).val()!=''){
			$.ajax({
				type : "POST",
				url : "php/check_qid.php",
				data : {
				qid : $("#qid").val()
				},
				dataType : 'html'
			}).done(function(data){
				//console.log(data);
				if(data == "yes"){
					alert("此QID已是會員！請勿重複註冊！");
					$("#addBtn").attr("disabled", true);
				}
				else
				{
					//console.log(data);
					$("#addBtn").attr("disabled", false);		        
				}
			}).fail(function(jqXHR, textStatus, errorThrown){
			//失敗的時候
				alert("有錯誤產生，請看 console log");
				console.log(jqXHR.responseText);
			});
		}else{
		}
	});
		$("#add_member_from").on("submit", function(){
			alert("新增會員成功！！");
	});
	});
</script>
</body>
</html>