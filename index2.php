<?php
require 'database.php';

$sql = mysqli_query($connect, "SELECT * from monitoring order by id desc");
$data = mysqli_fetch_array($sql);
$suhu = $data['suhu'];
$kelembapan = $data['kelembapan'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <title>Two Cards Template</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
</head>

<body>
     <header class="bg-light py-5">
          <div class="container">
               <h1 class="text-center">IoT Monitoring</h1>
               <p class="text-center">Mario Alfandi Wirawan (I0720037)</p>
          </div>
     </header>
     <div class="container">
          <div class="row justify-content-center">
               <div class="col-md-4">
                    <div class="card">
                         <div class="card-body">
                              <h5 class="card-title text-center">Suhu</h5>
                              <p class="card-text text-center" id="suhu"><?= $suhu; ?></p>
                         </div>
                    </div>
               </div>
               <div class="col-md-4">
                    <div class="card">
                         <div class="card-body">
                              <h5 class="card-title text-center">Kelembapan</h5>
                              <p class="card-text text-center" id="kelembapan"><?= $kelembapan; ?></p>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <!-- Bootstrap JS -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
     <script src="vendor/jquery/jquery.min.js"></script>
     <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

     <!-- Core plugin JavaScript-->
     <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

<script>
     $(document).ready(function() {
          setInterval(function() {
               $("#suhu").load(window.location.href + " #suhu");
          }, 2000);
     });
     $(document).ready(function() {
          setInterval(function() {
               $("#kelembapan").load(window.location.href + " #kelembapan");
          }, 2000);
     });
</script>

</html>