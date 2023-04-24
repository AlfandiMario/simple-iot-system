<?php
// Koneksi ke DB
require 'database.php';
$conn = $connect;

function SingleDataEnergy()
{
     global $conn;
     $sql = mysqli_query($conn, "SELECT * FROM energy ORDER BY id DESC");
     $data = mysqli_fetch_array($sql);
     $energy = $data['value'];
     return $energy;
}

function SingleDataSensor()
{
     global $conn;
     $sql = mysqli_query($conn, "SELECT * FROM monitoring ORDER BY id DESC");
     $data = mysqli_fetch_array($sql);
     $temperature = $data['temperature'];
     $humidity = $data['humidity'];
     $ldr = $data['ldr'];
     return [$temperature, $humidity, $ldr];
}

function ArrayDataEnergy()
{
     global $conn;
     $date = mysqli_query($conn, "SELECT timestamp FROM (SELECT * FROM energy ORDER BY id DESC LIMIT 8)SS ORDER BY id ASC");
     $energy = mysqli_query($conn, "SELECT value FROM (SELECT * FROM energy ORDER BY id DESC LIMIT 8)SS ORDER BY id ASC");
     $lastDate = mysqli_query($conn, "SELECT timestamp FROM energy ORDER BY id DESC");
     $row = mysqli_fetch_array($lastDate);
     $lastUpdate = $row['timestamp'];
     return [$date, $energy, $lastUpdate];
}

function ArrayDataSensor()
{
     global $conn;
     $date = mysqli_query($conn, "SELECT timestamp FROM (SELECT * FROM monitoring ORDER BY id DESC LIMIT 8)SS ORDER BY id ASC");
     $temperatures = mysqli_query($conn, "SELECT temperature FROM (SELECT * FROM monitoring ORDER BY id DESC LIMIT 8)SS ORDER BY id ASC");
     $humiditys = mysqli_query($conn, "SELECT humidity FROM (SELECT * FROM monitoring ORDER BY id DESC LIMIT 8)SS ORDER BY id ASC");
     $ldrs = mysqli_query($conn, "SELECT ldr FROM (SELECT * FROM monitoring ORDER BY id DESC LIMIT 8)SS ORDER BY id ASC");
     return [$date, $temperatures, $humiditys, $ldrs];
}
