<!-- 
  Developed by : Mario Alfandi Wirawan 
  Github : AlfandiMario
-->
<?php
require 'database.php';
include 'function.php';
[$temperature, $humidity, $ldr] = SingleDataSensor();
$energy = SingleDataEnergy();

// Array query untuk membuat grafik
[$energyDate, $energys, $lastUpdate] = ArrayDataEnergy();
[$date, $temperatures, $humiditys, $ldrs] = ArrayDataSensor();
// var_dump($lastUpdate);

$i = 0;
while ($sensorDateRow = mysqli_fetch_array($date)) {
  $tanggal = $sensorDateRow["timestamp"];
  $split = explode(" ", $tanggal);
  $jam[$i] = $split[1];
  $i++;
}
$last = $i - 1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
  <link rel="icon" type="image/png" href="assets/img/favicon.png" />
  <title>Sistem IoT-Mario</title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.5" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-200">
  <!-- SIDEBAR -->
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header text-center">
      <h3 class="text-white mt-3">IoT System</h3>
    </div>
    <hr class="horizontal light mt-0 mb-2" />
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="#">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white bg-gradient-secondary" href="kontrol.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">settings</i>
            </div>
            <span class="nav-link-text ms-1">Control</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
      <div class="mx-3 my-3 text-center">
        <small class="text-white">Mario Alfandi Wirawan</small>
        <br>
        <small class="text-white">I0720037</small>
      </div>
    </div>
  </aside>
  <!-- END OF SIDEBAR -->

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
      </div>
    </nav>
    <!-- END NAVBAR -->

    <div class="container-fluid py-4">
      <div class="row">
        <!-- Temperature -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">thermostat</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Temperature</p>
                <h4 class="mb-0" id="nowTemp"><?= $temperature ?> C</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0" />
            <div class="card-footer p-3">
              <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> -->
            </div>
          </div>
        </div>
        <!-- Humidity -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">chalet</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Humidity</p>
                <h4 class="mb-0" id="nowHumid"><?= $humidity ?> %</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0" />
            <div class="card-footer p-3">
              <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p> -->
            </div>
          </div>
        </div>
        <!-- LDR -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">light</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Light Intensity</p>
                <h4 class="mb-0" id="nowLdr"><?= $ldr ?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0" />
            <div class="card-footer p-3">
              <!-- <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p> -->
            </div>
          </div>
        </div>
        <!-- Potensiometer -->
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">bolt</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Energy Usage</p>
                <h4 class="mb-0" id="nowEnergy"><?= $energy ?> kWh</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0" />
            <div class="card-footer p-3">
              <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p> -->
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <!-- Humidity Chart  -->
        <div class="col-lg-6  mt-4 mb-4">
          <div class="card z-index-2">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1" id="chartHumid">
                <div class="chart">
                  <canvas id="chart-humid" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0">Humidity</h6>
              <p class="text-sm">Updated every 5 minutes</p>
              <hr class="dark horizontal" />
              <div class="d-flex">
                <i class="material-icons text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm">Last update at <?= $jam[$last] ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Energy Usage Chart -->
        <div class="col-lg-6  mt-4 mb-4">
          <div class="card z-index-2">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-info shadow-success border-radius-lg py-3 pe-1" id="chartEnergy">
                <div class="chart">
                  <canvas id="chart-energy" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0">Daily Energy Usage</h6>
              <p class="text-sm">Updated every 1 day</p>
              <hr class="dark horizontal" />
              <div class="d-flex">
                <i class="material-icons text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm">Last update at <?= $lastUpdate ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Temperature Chart -->
        <div class="row">
          <div class="col-lg-6 mt-4 mb-3">
            <div class="card z-index-2">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-success shadow-dark border-radius-lg py-3 pe-1" id="chartLdr">
                  <div class="chart">
                    <canvas id="chart-ldr" class="chart-canvas" height="170"></canvas>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <h6 class="mb-0">Light Intensity</h6>
                <p class="text-sm">Updated every 5 minutes</p>
                <hr class="dark horizontal" />
                <div class="d-flex">
                  <i class="material-icons text-sm my-auto me-1">schedule</i>
                  <p class="mb-0 text-sm">Last update at <?= $jam[$last] ?></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 mt-4 mb-3">
            <div class="card z-index-2">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1" id="chartTemp">
                  <div class="chart">
                    <canvas id="chart-temperature" class="chart-canvas" height="170"></canvas>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <h6 class="mb-0">Temperature</h6>
                <p class="text-sm">Updated every 5 minutes</p>
                <hr class="dark horizontal" />
                <div class="d-flex">
                  <i class="material-icons text-sm my-auto me-1">schedule</i>
                  <p class="mb-0 text-sm">Last update at <?= $jam[$last] ?></p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Refresh Page -->
  <script>
    setInterval(function() {
      $('#nowTemp').load('index.php #nowTemp');
    }, 1000);
    setInterval(function() {
      $('#nowHumid').load('index.php #nowHumid');
    }, 1000);
    setInterval(function() {
      $('#nowLdr').load('index.php #nowLdr');
    }, 1000);
    setInterval(function() {
      $('#nowEnergy').load('index.php #nowEnergy');
    }, 1000);
    setInterval(function() {
      $('#chart-humid').load('index.php #chart-humid');
    }, 1000);
    setInterval(function() {
      $('#chart-energy').load('index.php #chart-energy');
    }, 1000);
    setInterval(function() {
      $('#chart-temperature').load('index.php #chart-temperature');
    }, 1000);
  </script>

  <script>
    var ctx = document.getElementById("chart-humid").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: [<?php for ($i = 0; $i < 8; $i++) {
                    echo '"' . $jam[$i] . '"' . ',';
                  } ?>],
        datasets: [{
          label: "Humidity",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "rgba(255, 255, 255, .8)",
          data: [<?php
                  while ($row = mysqli_fetch_array($humiditys)) {
                    echo $row["humidity"] . ',';
                  } ?>],
          maxBarThickness: 6,
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          },
        },
        interaction: {
          intersect: false,
          mode: "index",
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: "rgba(255, 255, 255, .2)",
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: "normal",
                lineHeight: 2,
              },
              color: "#fff",
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: "rgba(255, 255, 255, .2)",
            },
            ticks: {
              display: true,
              color: "#f8f9fa",
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: "normal",
                lineHeight: 2,
              },
            },
          },
        },
      },
    });

    var ctx2 = document.getElementById("chart-energy").getContext("2d");

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: [<?php
                  while ($row2 = mysqli_fetch_array($energyDate)) {
                    echo '"' . $row2['timestamp'] . '"' . ',';
                  } ?>],
        datasets: [{
          label: "Energy Usage",
          tension: 0,
          borderWidth: 0,
          pointRadius: 5,
          pointBackgroundColor: "rgba(255, 255, 255, .8)",
          pointBorderColor: "transparent",
          borderColor: "rgba(255, 255, 255, .8)",
          borderColor: "rgba(255, 255, 255, .8)",
          borderWidth: 4,
          backgroundColor: "rgba(255, 255, 255, .6)",
          fill: true,
          data: [<?php
                  while ($row = mysqli_fetch_array($energys)) {
                    echo $row["value"] . ',';
                  } ?>],
          maxBarThickness: 6,
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          },
        },
        interaction: {
          intersect: false,
          mode: "index",
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: "rgba(255, 255, 255, .2)",
            },
            ticks: {
              display: true,
              color: "#f8f9fa",
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: "normal",
                lineHeight: 2,
              },
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: "rgba(255, 255, 255, .4)",
            },
            ticks: {
              display: true,
              color: "#f8f9fa",
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: "normal",
                lineHeight: 2,
              },
            },
          },
        },
      },
    });

    var ctx4 = document.getElementById("chart-temperature").getContext("2d");

    new Chart(ctx4, {
      type: "line",
      data: {
        labels: [<?php for ($i = 0; $i < 8; $i++) {
                    echo '"' . $jam[$i] . '"' . ',';
                  } ?>],
        datasets: [{
          label: "Temperature",
          tension: 0,
          borderWidth: 0,
          pointRadius: 5,
          pointBackgroundColor: "rgba(255, 255, 255, .8)",
          pointBorderColor: "transparent",
          borderColor: "rgba(255, 255, 255, .8)",
          borderWidth: 4,
          backgroundColor: "transparent",
          fill: true,
          data: [<?php
                  while ($row = mysqli_fetch_array($temperatures)) {
                    echo $row["temperature"] . ',';
                  } ?>],
          maxBarThickness: 6,
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          },
        },
        interaction: {
          intersect: false,
          mode: "index",
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: "rgba(255, 255, 255, .2)",
            },
            ticks: {
              display: true,
              padding: 10,
              color: "#f8f9fa",
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: "normal",
                lineHeight: 2,
              },
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: "rgba(255, 255, 255, .4)",
            },
            ticks: {
              display: true,
              color: "#f8f9fa",
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: "normal",
                lineHeight: 2,
              },
            },
          },
        },
      },
    });

    var ctx4 = document.getElementById("chart-ldr").getContext("2d");

    new Chart(ctx4, {
      type: "line",
      data: {
        labels: [<?php for ($i = 0; $i < 8; $i++) {
                    echo '"' . $jam[$i] . '"' . ',';
                  } ?>],
        datasets: [{
          label: "Intensity",
          tension: 0,
          borderWidth: 0,
          pointRadius: 5,
          pointBackgroundColor: "rgba(255, 255, 255, .8)",
          pointBorderColor: "transparent",
          borderColor: "rgba(255, 255, 255, .8)",
          borderWidth: 4,
          backgroundColor: "transparent",
          fill: true,
          data: [<?php
                  while ($row = mysqli_fetch_array($ldrs)) {
                    echo $row["ldr"] . ',';
                  } ?>],
          maxBarThickness: 6,
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          },
        },
        interaction: {
          intersect: false,
          mode: "index",
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: "rgba(255, 255, 255, .2)",
            },
            ticks: {
              display: true,
              padding: 10,
              color: "#f8f9fa",
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: "normal",
                lineHeight: 2,
              },
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: "rgba(255, 255, 255, .4)",
            },
            ticks: {
              display: true,
              color: "#f8f9fa",
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: "normal",
                lineHeight: 2,
              },
            },
          },
        },
      },
    });
  </script>

</body>

</html>