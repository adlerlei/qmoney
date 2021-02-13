<?php 
require_once 'db.php';
require_once 'functions.php';
//if(isset($_POST[''])){
// $qid = $_POST['qid'];
// $username = $_POST['username'];
// $phone = $_POST['phone'];
// $member_level = $_POST['member_level'];
// $remarks = $_POST['remarks'];
// $identification = $_POST['identification'];

// $sql = "INSERT INTO `member` ( `qid` , `username` , `phone` , `level` , `remarks` , `identification` ) VALUES ( '$qid' , '$username' , '$phome' , '$member_level' , '$remarks' , '$identification' )";
// $query = mysqli_query( $_SESSION['link'] , $sql );
// if ($query) {
// header('Location:http://localhost:8080/QMoneyTeam/headquarters_system.php');
// } else {
// echo "資料庫寫入失敗 ... 請檢查網路異常！";
// mysqli_error($query);
// }
//}
$check = check_qid($_POST['qid']);

if ($check) {
	echo "yes";
} else {
	echo "no";
}



//print_r($_POST);
?>