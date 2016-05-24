<?php
session_start();
if ($_SESSION['username'] == "admin") {
	header("Location: nisn");
} else {
	//echo "login gagal";
	header("Location: ../error-404/");
}
?>
