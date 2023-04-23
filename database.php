<?php
// ======================================
// Pengkoneksian File PHP dengan Database
// ======================================
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'iot_mario';

// Membuat koneksi
$connect = mysqli_connect($servername, $username, $password, $database);

// Cek Koneksi
if ($connect->connect_error) {
     die("Connection Failed : " . $connect->connect_error);
}
