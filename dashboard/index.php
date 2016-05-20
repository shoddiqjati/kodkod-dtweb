<?php
session_start();
if ($_SESSION['username'] == "admin") {
	include 'result_data.php';
} else {
	echo "login gagal";
	//header("Location: ../error-404/")
}
?>