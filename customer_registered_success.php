<html>

  <head>
    <title> Customer Signup </title>
  </head>
  <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
  <link rel="stylesheet" type = "text/css" href ="assets/css/manager_registered_success.css">
  <link rel="stylesheet" type = "text/css" href ="assets/bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

  <body>

  <!--Back to top button..................................................................................-->
    <button onclick="topFunction()" id="myBtn" title="Go to top">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </button>
  <!--Javacript for back to top button....................................................................-->
    <script type="text/javascript">
      window.onscroll = function()
      {
        scrollFunction()
      };

      function scrollFunction(){
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          document.getElementById("myBtn").style.display = "block";
        } else {
          document.getElementById("myBtn").style.display = "none";
        }
      }

      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>

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

$customer_name = $conn->real_escape_string($_POST['customer_name']);
$customer_username = $conn->real_escape_string($_POST['customer_username']);
$customer_email = $conn->real_escape_string($_POST['customer_email']);
$customer_phone = $conn->real_escape_string($_POST['customer_phone']);
$customer_address = $conn->real_escape_string($_POST['customer_address']);
$customer_password = $conn->real_escape_string($_POST['customer_password']);

$query = "INSERT into customers(customer_name,customer_username,customer_email,customer_phone,customer_address,customer_password) VALUES('" . $customer_name . "','" . $customer_username . "','" . $customer_email . "','" . $customer_phone . "','" . $customer_address ."','" . $customer_password ."')";
$success = $conn->query($query);

if (!$success){
	die("Couldnt enter data: ".$conn->error);
}

$conn->close();

?>


<div class="container">
	<div class="jumbotron" style="text-align: center;">
		<h2> <?php echo "ยินดีต้อนรับ $customer_name!" ?> </h2>
		<h1>สมัครสมาชิกสำเร็จ</h1>
		<p>เข้าสู่ระบบตอนนี้ <a href="customerlogin.php">ที่นี่</a></p>
	</div>
</div>

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