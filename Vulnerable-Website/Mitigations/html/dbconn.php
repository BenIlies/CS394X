<?php
    error_reporting(E_ALL);
    ini_set('display_error', 1);

    $host = "localhost";
    $user = "sqlogin";
    $pass = "Th1s_i5_SQL0g1n_p4ssw0rd";

    $conn = mysqli_connect($host, $user, $pass, "33065");
    unset($host, $user, $pass);
    mysqli_select_db($conn, "sqlogin_user");
    mysqli_query($conn, "set names utf8");
    session_start(); 

?>

