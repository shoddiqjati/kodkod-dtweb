<?php
include 'db_configuration.php';

/*
    Created by P-CODE 2016
*/
$response = array();

function login($nisn, $password)
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    $query = "SELECT * FROM `users` WHERE `nisn` = '$nisn'";
    $result = $conn->query($query);
    if ($result->num_rows>0) {
        $query = "SELECT * FROM `users` WHERE `nisn` = '$nisn' AND `password` = '$password'";
        $result = $conn->query($query); 
        if ($result->num_rows>0) {
            while ($row = $result->fetch_array()) {
                extract($row);
                $login[] = array(
                    'nisn' => (int) $nisn,
                    'nama' => $nama,
                    'login_status' => (int) $login_status);
            }
            $response['response'] = "login";
            $response['login'] = $login;
            //$log_response = (object) array('login' => $login);
            echo json_encode($response);
            $conn->close();
        } else {
            $response['response'] = "error";
            $response['message'] = "Password Anda Salah";
            echo json_encode($response);
            $conn->close();
        }
    } else {
        $response['response'] = "error";
        $response['message'] = "NISN Tidak Terdaftar";
        echo json_encode($response);
        $conn->close();
    }
}

function signUp($nisn, $nama, $password)
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    $query = "SELECT * FROM `users` WHERE `nisn` = '$nisn'";
    $result = $conn->query($query);
    if ($result->num_rows>0) {
        $notif[] = array('notif' => "NISN was registered");
        $response['response'] = "signup";
        $response['signup'] = $notif;
        echo json_encode($response);
    } else 
    {
        $query = "INSERT INTO `users` (`nisn`, `nama`, `password`, `login_status`) VALUES ('$nisn', '$nama', '$password', '0')";
        $result = $conn->query($query);
        $query_check = "SELECT * FROM `users` WHERE `nisn` = '$nisn'";
        $result_check = $conn->query($query_check);
        if ($result_check->num_rows>0) {
            $notif[] = array('notif' => "Sign Up Successful");
            $response['response'] = "signup";
            $response['signup'] = $notif;
            echo json_encode($response);
        }
    }
}
?>