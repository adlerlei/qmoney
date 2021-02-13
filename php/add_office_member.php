<?php 
require_once 'db.php';
if(!empty($_POST)){
$qid = $_POST['qid'];
$username = $_POST['username'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$remarks = $_POST['remarks'];
$identification = $_POST['identification'];
$password = md5($password);
$sql = "INSERT INTO `member` ( `qid` , `username` , `phone` , `password` , `remarks` , `identification` ) VALUES ( '$qid' , '$username' , '$phone' , '$password' , '$remarks' , '$identification' )";
$query = mysqli_query( $_SESSION['link'] , $sql );
if ($query) {
header('Location:http://localhost:8080/QMoneySystem/create_member.php');
// header('Location:http://localhost:8080/QMoneySystem/add_search_member.php');
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