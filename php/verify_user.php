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

//執行驗證的方法，把帳密帶入，因為會回傳一個值，所以也可以直接寫在if判別中，不用再另外寫變數
if(verify_user($_POST['q'], $_POST['pw']))
{
	//若為true 代表登入成功，印出yes
	echo 'yes';
}
else
{
	//若為 null 或者 false 代表失敗
	echo 'no';
}
// print_r($result);
// echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
?>