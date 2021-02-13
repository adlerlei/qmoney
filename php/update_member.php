<?php
//載入資料庫與處理的方法
require_once 'db.php';
require_once 'functions.php';

//判別有無在登入狀態
if(isset($_SESSION['is_login']) && $_SESSION['is_login']){
	//執行更新使用者的方法，直接把整個 $_POST個別的照順序變數丟給方法。
	//定義password 是否有要修改
	$password = null;//預設為null代表沒有要改
	//$level = null;
	if(isset($_POST['password']))
	{
		//如果有password變數代表有要改
		$password = $_POST['password'];
		//$level = $_POST['level'];
	}
	$update_result = update_member($_POST['uid'], $_POST['q'], $_POST['un'],$_POST['pw'],$_POST['pe'],$_POST['rk'],$_POST['ml'],$password);
	
	if($update_result)
	{
		//若為true 代表新增成功，印出yes
		echo 'yes';
	}
	else
	{
		//若為 null 或者 false 代表失敗
		echo 'no';
		print_r($update_result);
	}
}
else
{
	//若為 null 或者 false 代表失敗
	echo 'no';	
}
?>