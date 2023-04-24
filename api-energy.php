<?php
// Menggunakan kode dari database.php
require 'database.php';

ini_set('date.timezone', 'Asia/Jakarta');

$now = new DateTime();

$datenow = $now->format("Y-m-d");
var_dump($_SERVER["REQUEST_METHOD"]);

//Mengambil data dari Web Server ESP 
$value = $_POST['energy'];

// variabel untuk random
$value2 = $value + random_int(1, 15);

//Masukin data ke MySQL
$sql = "INSERT INTO energy VALUES (NULL,
     			'$value2',
                    '$string')";

// Cek sukses tidak
if ($connect->query($sql) === TRUE) {
     echo json_encode("Ok");
} else {
     echo "Error: " . $sql . "<br>" . $connect->error;
}

$connect->close();
