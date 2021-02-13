<?php 
require_once 'db.php';
//require_once 'functions.php';
//@session_start();

if(!empty($_POST)){
$qid = $_POST['qid'];
$username = $_POST['username'];
$phone = $_POST['phone'];
$member_level = $_POST['member_level'];
$remarks = $_POST['remarks'];
// $identification = $_POST['identification'];
$dealer_name = $_POST['dealer_name'];

$sql = "INSERT INTO `member` ( `qid` , `username` , `phone` , `level` , `remarks` , `dealer_name` ) VALUES ( '$qid' , '$username' , '$phone' , '$member_level' , '$remarks' , '$dealer_name' )";
$query = mysqli_query( $_SESSION['link'] , $sql );
if ($query) {
header('Location:../add_search_member.php');
 echo '<pre>'; print_r( $_POST[''] ); echo '</pre>'; exit;
} else {
echo "資料庫寫入失敗 ... 請檢查網路異常！";
echo '<pre>'; print_r( $_POST[''] ); echo '</pre>'; exit;
mysqli_error($query);
}
}
// $check = add_member($_POST['q'] , $_POST['un'] , $_POST['pe'] , $_POST['rk'] , $_POST['ml'] , $_POST['ii'] );
// if ($check){
// 	echo "yes";
// } else {
// 	echo "no";
// }
?>