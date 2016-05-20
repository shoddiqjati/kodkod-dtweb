<?php
session_start();
include 'db_configuration.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$date = date("Y-m-d H:i:s");

if (isset($_POST['signin'])) {
	$userName = $_POST['username'];
	$passWord = $_POST['password'];
	$md5_pass = md5($passWord);
	$query_signin = "SELECT * FROM `system_account` WHERE `username` = '$userName' AND `password` = '$md5_pass'";
	$result = $conn->query($query_signin);

	if ($result->num_rows>0) {
		while ($row = $result->fetch_array()) {
			extract($row);
			$query = "UPDATE `system_account` SET `last_login`= '$date' WHERE 1";
			$result = $conn->query($result);

			$_SESSION['username'] = $userName;
			header('Location: ../dashboard/');
		}
	}
	else{
		error_log($message);
		echo "<script type='text/javascript'>alert('$message');</script>";
		header('Location: ../');
	}
}
?>