<?php
include 'function.php';
/*
    Created by P-CODE 2016
*/
$response = array();

if (isset($_POST['tag'])) {
    $tag = $_POST['tag'];
    if ($tag=="login") {
        if(isset($_POST['nisn']) && isset($_POST['password'])){
            $nisn = $_POST['nisn'];
            $password = $_POST['password'];
            if ($nisn != "" && $password != "") {
                login($nisn, $password);
            }
            else {
                $response["kode"] = 0;
                $response["pesan"] = "Username atau password tidak boleh kosong!";
                echo json_encode($response);
            }   
        }
    } elseif ($tag=="signUp") {
        if (isset($_POST['nisn']) && isset($_POST['nama']) && isset($_POST['password'])) {
            $nisn = $_POST['nisn'];
            $nama = $_POST['nama'];
            $password = $_POST['password'];
            if ($nisn != "" && $nama != "" && $password != "") {
                signUp($nisn, $nama, $password);
            } else {
                $response["kode"] = 0;
                $response["pesan"] = "Username atau password tidak boleh kosong!";
                echo json_encode($response);
            }
        }
    }
}
?>