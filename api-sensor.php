<?php
// Menggunakan kode dari database.php
require 'database.php';

ini_set('date.timezone', 'Asia/Jakarta');

$now = new DateTime();

$datenow = $now->format("Y-m-d H:i:s");
var_dump($_SERVER["REQUEST_METHOD"]);

//Mengambil data dari Web Server ESP 
$suhu = $_POST['temperature'];
$humid = $_POST['humidity'];
$ldr = $_POST['ldr'];

// variabel untuk random
$suhu2 = $suhu + random_int(18, 35);
$humid2 = $humid + random_int(10, 40);
$ldr2 = $ldr + random_int(0, 200);

//Masukin data ke MySQL
$sql = "INSERT INTO monitoring VALUES (NULL,
     			'$suhu2',
				'$humid2',
				'$ldr2',
                    '$datenow')";

// Cek sukses tidak
if ($connect->query($sql) === TRUE) {
     echo json_encode("Ok");
} else {
     echo "Error: " . $sql . "<br>" . $connect->error;
}

$connect->close();
