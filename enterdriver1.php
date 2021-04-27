<html>

  <head>
    <title> customer Signup | Car Rentals </title>
  </head>
  <?php session_start(); ?>
  <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">

    <link rel="stylesheet" href="assets/w3css/w3.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php">
                   Cars Booking SU </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
                if(isset($_SESSION['login_client'])){
            ?> 
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">หน้าหลัก</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> ยินดีต้อนรับสมาชิก <?php echo $_SESSION['login_client']; ?></a>
                    </li>
                    <li>
                    <ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> ระบบควบคุม <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="entercar.php">เพิ่มรถ</a></li>
              <li> <a href="enterdriver.php"> เพิ่มพนักงานขับรถ</a></li>
              <li> <a href="clientview.php">ตรวจสอบ</a></li>

            </ul>
            </li>
          </ul>
                    </li>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>ออกจากระบบ</a>
                    </li>
                </ul>
            </div>
            
            <?php
                }
                else if (isset($_SESSION['login_customer'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">หน้าหลัก</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> ยินดีต้อนรับคุณ <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> ระบบควบคุม <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="prereturncar.php">ส่งคืนรถ</a></li>
              <li> <a href="mybookings.php"> รายการจองของฉัน</a></li>
            </ul>
            </li>
          </ul>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>ออกจากระบบ</a>
                    </li>
                </ul>
            </div>

            <?php
            }
            else {
              ?>
  
              <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                  <ul class="nav navbar-nav">
                      <li>
                          <a href="index.php">หน้าหลัก</a>
                      </li>
                      <li>
                          <a href="clientlogin.php">พนักงาน</a>
                      </li>
                      <li>
                          <a href="customerlogin.php">สมาชิก</a>
                      </li>
              </div>
                  <?php   }
                  ?>
          </div>
      </nav>

<?php

require 'connection.php';
$conn = Connect();

$driver_name = $conn->real_escape_string($_POST['driver_name']);
$dl_number = $conn->real_escape_string($_POST['dl_number']);
$driver_phone = $conn->real_escape_string($_POST['driver_phone']);
$driver_address = $conn->real_escape_string($_POST['driver_address']);
$driver_gender = $conn->real_escape_string($_POST['driver_gender']);
$client_username = $_SESSION['login_client'];
$driver_availability = "yes";

$query = "INSERT into driver(driver_name,dl_number,driver_phone,driver_address,driver_gender,client_username,driver_availability) VALUES('" . $driver_name . "','" . $dl_number . "','" . $driver_phone . "','" . $driver_address . "','" . $driver_gender ."','" . $client_username ."','" . $driver_availability ."')";
$success = $conn->query($query);

if (!$success){ ?>
    <div class="container">
	<div class="jumbotron" style="text-align: center;">
        ไม่สามารถเพิ่มพนักงานขับรถได้!
        <br><br>
        <a href="entercar.php" class="btn btn-default"> ย้อนกลับ </a>
</div>
<?php	
}
else {
    header("location: enterdriver.php"); //Redirecting 
}

$conn->close();

?>

    </body>
    <footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </footer>
</html>