<?php 
require_once 'db.php';
require_once 'functions.php';
$check = del_dealer($_POST['uid']);

if ($check) {
	echo "yes";
} else {
	echo "no";
}



//print_r($_POST);
?>