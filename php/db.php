<?php
@session_start();
$db_host = "localhost";
$db_username = "root";
$db_password = "root";
// $db_username = "qmoney_erp";
// $db_password = "660516li";
$db_name = "hqerp";

$_SESSION['link'] = mysqli_connect( $db_host , $db_username , $db_password , $db_name );

if ($_SESSION['link']) {
	mysqli_query( $_SESSION['link'] , "SET NAMES utf8" );
	//echo "已經正確連線！";
} else {
	echo "無法連線資料庫：<br/>" . mysqli_connect_error();
}


?>