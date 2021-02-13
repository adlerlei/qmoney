<?php
require_once 'php/db.php';
require_once 'php/functions.php';
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
	header("Location: index.php");
}
if($_SESSION['user_identification'] == "經銷商" ){
	header("Location: add_search_member.php");
}
$datas = load_identification();
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
</head>
<body>	
	<div class="limiter justify-content-start">
		<div class="container-login100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
				<div style="text-align: center; margin-bottom: 30px;">
				<nav class="navbar fixed-top justify-content-center navbar-dark bgblack">
					<a class="navbar-brand" href="#!">QMoney</a>
					<a class="nav-link active" href="add_search_member.php">建立 | 查詢會員資料</a>
					<a class="nav-link" href="create_member.php">建立總部帳號</a>
					<a class="nav-link" href="create_dealer.php">建立經銷商帳號</a>
					<a style="color: #f6f6f6;"  class="nav-link" href="#">查詢經銷商</a>
					<a class="nav-link" href="php/logout.php">登出</a>
				</nav>

<span style="text-align: center;">
					<img style="margin-bottom: 20px;" src="images/qlogo.png">
				</span>
				<div style="font-size: 10pt; text-align: center; margin-bottom: 20px;">
					經銷商查詢
				</div>

<div class="table-responsive-sm">
	<?php if(!empty($datas)): ?>
	<?php foreach($datas as $member): ?>	
<table class="table table-striped">
<thead style="background-color: #b8d00a;">
<tr>
<th colspan="2">經銷商名稱：<?php echo $member['dealer_name'] ?></th>
<th colspan="2">所屬地區：<?php echo $member['region'] ?></th>
<th class="text-left" colspan="3">門市地址：<?php echo $member['address'] ?></th>
</tr>
</thead>
<tbody>
<tr>
<td class="text-left" colspan="1">QID：<?php echo $member['qid'] ?></td>
<td class="text-left"  colspan="1">用戶名稱：<?php echo $member['username'] ?></td>
<td class="text-left"  colspan="1">手機：<?php echo $member['phone'] ?></td>
<td class="text-left"  colspan="4">建立時間：<?php echo $member['date'] ?></td>
</tr>
<tr>
<td class="text-left" colspan="7">備註：<?php echo $member['remarks'] ?></td>
</tr>
<tr>
<td class="text-right" colspan="7">
<a href='edit_dealer.php?i=<?php echo $member['uid'];?>' class="btn btn-warning">修改</a>&#12288;
<a href="javascript:void(0);" class="btn btn-danger del_dealer" data-id="<?php echo $member['uid']; ?>">刪除</a>
</td>
</tr>
</tbody>
</table>
<?php endforeach; ?>
<?php endif; ?>
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
<!-- 	<script src="vendor/select2/select2.min.js"></script>
 --><!--===============================================================================================-->
	<script src="js/main.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
$(document).on("ready", function(){
	$("a.del_dealer").on("click",function(){
		var c = confirm("確定要刪除嗎？刪除後無法復原！！");
		var this_tr = $(this).parent().parent().parent().parent();;
		//console.log(c);
		if(c)
		{
		$.ajax({
		type : "POST",
		url : "php/del_dealer.php",
		data : {
		'uid' : $(this).attr("data-id") // 77row
		},
		dataType : 'html' //設定該網頁回應的會是 html 格式
	}).done(function(data){
		//console.log(data);
		if(data == "yes"){
			alert("已刪除經銷商！");
			this_tr.fadeOut();
		}
		else
		{
			alert("刪除失敗！請確認電腦網路是否正常！")
			console.log(data);       
		}
	}).fail(function(jqXHR, textStatus, errorThrown) {
	//失敗的時候
		alert("有錯誤產生，請看 console log");
		console.log(jqXHR.responseText);
	});
		}
	});
});
</script>

</body>
</html>