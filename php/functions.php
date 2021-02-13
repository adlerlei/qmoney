<?php
//開啟session紀錄
@session_start();
require_once 'db.php';
//獲取總部或經銷商身分識別//////////////////////////////////////
function load_identification()
{
	//宣告空值的陣列準備儲存
	$datas = array();
	//抓取資料庫中的member資料表，並將資料表中的identification資料欄位中的值為"經銷商"的取出來，並儲存給$sql變數
	$sql = "SELECT * FROM `member` WHERE `identification` = '經銷商' ";
	//執行資料庫查詢
	$query = mysqli_query( $_SESSION['link'] , $sql );

	if ($query)
	{
		//只要大於0就把每筆資料都抓出來
		if (mysqli_num_rows($query)>0)
		{
			//省用迴圈重複讀取並儲存到$row
			while ($row = mysqli_fetch_assoc($query))
			{
				//將所有資料儲存到$datas陣列
				$datas[] = $row;
			}
		}
		
	} else {
		//將$_SESSION['link']帶入也會顯示資料庫執行錯誤的原因
		echo "{$sql}請求失敗：<br/>" . mysqli_error($_SESSION['link']);
	}
	//將$datas的值回傳出去以便日後可以使用！
	return $datas;
}
//獲取總部或經銷商身分識別 END//////////////////////////////////////

//獲取會員信息身分識別 ////////////////////////////////////////////
//$qid = $_GET['search_member_qid'];
function load_member()
{
	$qid = (isset($_GET['search_member_qid']) ? $_GET['search_member_qid'] : null);
	//宣告空值的陣列準備儲存
	$datas = array();
	//抓取資料庫中的member資料表，並將資料表中的identification資料欄位中的值為1的取出來，並儲存給$sql變數
	$sql = "SELECT * FROM `member` WHERE `qid` = '$qid' ";
	//執行資料庫查詢
	$query = mysqli_query( $_SESSION['link'] , $sql );

	if ($query)
	{
		//只要大於0就把每筆資料都抓出來
		if (mysqli_num_rows($query)>0)
		{
			//省用迴圈重複讀取並儲存到$row
			while ($row = mysqli_fetch_assoc($query))
			{
				//將所有資料儲存到$datas陣列
				$datas[] = $row;
			}
		}
		
	} else {
		//將$_SESSION['link']帶入也會顯示資料庫執行錯誤的原因
		echo "{$sql}請求失敗：<br/>" . mysqli_error($_SESSION['link']);
	}
	//將$datas的值回傳出去以便日後可以使用！
	return $datas;
}

//檢查資料庫有無重複的QID
function check_qid($qid)
{
	//宣告要回傳的結果
  $result = null;

  //將查詢語法當成字串，記錄在$sql變數中
  $sql = "SELECT * FROM `member` WHERE `qid` = '{$qid}'";

  //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
  $query = mysqli_query($_SESSION['link'], $sql);

  //如果請求成功
  if ($query)
  {
    //使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否有一筆資料
    if (mysqli_num_rows($query) >= 1)
    {
      //取得的量大於0代表有資料
      //回傳的 $result 就給 true 代表有該帳號，不可以被新增
      $result = true;
    }

    //釋放資料庫查詢到的記憶體
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
  }

  //回傳結果
  return $result;
}

//新增經銷商並將經銷商資料寫入資料庫
function add_dealer($qid,$username,$password,$dealerName,$phone,$region,$address,$remarks,$identification)
{
	//宣告要回傳的結果
  $result = null;
  $password = md5($password);
  //將查詢語法當成字串，記錄在$sql變數中
  $sql = "INSERT INTO `member` ( `qid` , `username` , `password` , `dealer_name` , `phone` , `region` , `address` , `remarks` , `identification` ) VALUES ( '$qid' , '$username' , '$password' , '$dealerName' , '$phone' , '$region' , '$address' , '$remarks' ,'$identification' )";

  //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
  $query = mysqli_query($_SESSION['link'], $sql);

  //如果請求成功
  if ($query)
  {
    //使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否有一筆資料
    if (mysqli_affected_rows($_SESSION['link']) == 1)
    {
      //取得的量大於0代表有資料
      //回傳的 $result 就給 true 代表有該帳號，不可以被新增
      $result = true;
    }
  }
  else
  {
    echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
  }

  //回傳結果
  return $result;
}

//檢查用戶登入是否正確
function verify_user($qid,$password)
{
	//宣告要回傳的結果
  $result = null;
  $password = md5($password);
  //將查詢語法當成字串，記錄在$sql變數中
  $sql = "SELECT * FROM `member` WHERE `qid` = '$qid' AND `password` = '$password' ";

  //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
  $query = mysqli_query($_SESSION['link'], $sql);

  //如果請求成功
  if ($query)
  {
    //使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否有一筆資料
    if (mysqli_num_rows($query) >= 1)
    {
    	//將取出來的值（qid跟密碼）儲存到user變數
		$user = mysqli_fetch_assoc($query);
		//新增一個session的值為is_login準備儲存到使用者的session中
		$_SESSION['is_login'] = true;
		//將用戶註冊時的資料庫序列id取出來一起丟進用戶的session中
		$_SESSION['login_user_id'] = $user['uid'];
    $_SESSION['user_identification'] = $user['identification'];
    $_SESSION['dealer_name'] = $user['dealer_name'];
		$result = true;
    }

    //釋放資料庫查詢到的記憶體
    //mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
  }

  //回傳結果
  return $result;
}

/**
 * 透過uid傳遞經銷商資料到資料修改頁面
 */
function get_dealer($uid)
{
  //宣告要回傳的結果
  $result = null;

  //將查詢語法當成字串，記錄在$sql變數中
  $sql = "SELECT * FROM `member` WHERE `uid` = {$uid};";

  //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
  $query = mysqli_query($_SESSION['link'], $sql);

  //如果請求成功
  if ($query)
  {
    //使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否有一筆資料
    if (mysqli_num_rows($query) == 1)
    {
      //取得的量大於0代表有資料
      //while迴圈會根據查詢筆數，決定跑的次數
      //mysqli_fetch_assoc 方法取得 一筆值
      $result = mysqli_fetch_assoc($query);
    }

    //釋放資料庫查詢到的記憶體
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
  }

  //回傳結果
  return $result;
}

/**
 * 更新經銷商
 */
function update_dealer($uid,$qid,$username,$password,$dealer_name,$phone,$region,$address,$remarks)
{
  //宣告要回傳的結果
  $result = null;
  //根據有無 password 給予不同的 語法
  if($password)
  {
    //有直代表要改密碼
    $password = md5($password);
    //更新語法
    $sql = "UPDATE `member` SET qid = '$qid' , `username` = '$username' , `password` = '$password' , `dealer_name` = '$dealer_name' , `phone` = '$phone' , `region` = '$region' , `address` = '$address' , `remarks` = '$remarks' WHERE uid = '$uid'";
  }
  else
  {
    //沒有就不用
    //更新語法
    $sql = "UPDATE `member` SET qid = '$qid' , `username` = '$username' , `dealer_name` = '$dealer_name' , `phone` = '$phone' , `region` = '$region' , `address` = '$address' , `remarks` = '$remarks' WHERE uid = '$uid'";    
  }
  
  //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
  $query = mysqli_query($_SESSION['link'], $sql);

  //如果請求成功
  if ($query)
  {
    //使用 mysqli_affected_rows 判別異動的資料有幾筆，基本上只有新增一筆，所以判別是否 == 1
    if(mysqli_affected_rows($_SESSION['link']) == 1)
    {
      //取得的量大於0代表有資料
      //回傳的 $result 就給 true 代表有該帳號，不可以被新增
      $result = true;
    }
  }
  else
  {
    echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
  }

  //回傳結果
  return $result;
}

/**
 * 更新用戶
 */
function update_member($uid,$qid,$username,$password,$phone,$remarks,$level)
{
  //宣告要回傳的結果
  $result = null;
  //根據有無 password 給予不同的 語法
  if($password)
  {
    //有直代表要改密碼
    $password = md5($password);
    //更新語法
    $sql = "UPDATE `member` SET qid = '$qid' , `username` = '$username' , `password` = '$password' , `phone` = '$phone' , `remarks` = '$remarks' , `level` = '$level' WHERE uid = {$uid}";
  }
  else
  {
    //沒有就不用
    //更新語法
    $sql = "UPDATE `member` SET qid = '$qid' , `username` = '$username' , `phone` = '$phone' , `remarks` = '$remarks' , `level` = '$level' WHERE uid = {$uid}";
  }
  
  //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
  $query = mysqli_query($_SESSION['link'], $sql);

  //如果請求成功
  if ($query)
  {
    //使用 mysqli_affected_rows 判別異動的資料有幾筆，基本上只有新增一筆，所以判別是否 == 1
    if(mysqli_affected_rows($_SESSION['link']) == 1)
    {
      //取得的量大於0代表有資料
      //回傳的 $result 就給 true 代表有該帳號，不可以被新增
      $result = true;
    }
  }
  else
  {
    echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
  }

  //回傳結果
  return $result;
}



/**
 * 刪除經銷商
 */
function del_dealer($uid)
{
  //宣告要回傳的結果
  $result = null;
    //刪除語法
    $sql = "DELETE FROM `member` WHERE uid = '$uid'";    
  
  
  //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
  $query = mysqli_query($_SESSION['link'], $sql);

  //如果請求成功
  if ($query)
  {
    //使用 mysqli_affected_rows 判別異動的資料有幾筆，基本上只有新增一筆，所以判別是否 == 1
    if(mysqli_affected_rows($_SESSION['link']) == 1)
    {
      //取得的量大於0代表有資料
      //回傳的 $result 就給 true 代表有該帳號，不可以被新增
      $result = true;
    }
  }
  else
  {
    echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
  }

  //回傳結果
  return $result;
}
?>