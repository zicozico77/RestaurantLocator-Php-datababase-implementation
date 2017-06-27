<?php

session_start();

require_once "admin.php";

$user_name = null;
$password = null;

if (isset($_POST['user_name'])) {
	$user_name = $_POST['user_name'];
	}
if (isset($_POST['password'])) {
	$password = $_POST['password'];
	}

$authenticated = check_login($user_name, $password);
if ($authenticated == true) {
	header ('Location: account_page.php');
	$_SESSION['user_name'] = $user_name;
	}
else{
	$_SESSION['login_error'] = 'Username or password incorrect';
	header ('Location: loginpage.php');
    }

?>