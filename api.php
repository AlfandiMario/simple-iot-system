<?php
// Menggunakan kode dari database.php
require 'database.php';

ini_set('date.timezone', 'Asia/Jakarta');

$now = new DateTime();

$datenow = $now->format("Y-m-d H:i:s");
var_dump($_SERVER["REQUEST_METHOD"]);

//Mengambil data dari Web Server ESP 
$suhu = $_POST['suhu'];
$humid = $_POST['kelembapan'];

//Masukin data ke MySQL
$sql = "INSERT INTO monitoring VALUES (NULL,
     			'$suhu',
				'$humid',
                    '$datenow')";

// $sql = "UPDATE esp SET tracking = '$tracking' WHERE id = 1";


if ($connect->query($sql) === TRUE) {
     echo json_encode("Ok");
} else {
     echo "Error: " . $sql . "<br>" . $connect->error;
}

$connect->close();
