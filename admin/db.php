<?php 
$hostname   = 'localhost';
$username   = 'root';
$password   = '';
$db_name    ='toko_parfum';

$koneksi =mysqli_connect($hostname, $username, $password, $db_name) or die('gagal terhubung ke database');


?>