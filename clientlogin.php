<?php
include('login_client.php'); // Includes Login Script

if(isset($_SESSION['login_client'])){
    header("location: index.php"); //Redirecting
}
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title> Employee Login</title>
        <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/clientlogin.css">
</head>
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
              <li> <a href="enterdriver.php">เพิ่มพนักงานขับรถ</a></li>
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
        <div class="container">
            <div class="jumbotron">
                <h1 class="text-center">เข้าสู่ระบบ | พนักงาน </span>
                </h1>
                <br>
                <p class="text-center">กรุณาเข้าสู่ระบบ</p>
            </div>
        </div>

        <div class="container" style="margin-top: -2%; margin-bottom: 2%;">
            <div class="col-md-5 col-md-offset-4">
                <label style="margin-left: 5px;color: red;"><span> <?php echo $error;  ?> </span></label>
                <div class="panel panel-primary">
                    <div class="panel-heading"> เข้าสู่ระบบ </div>
                    <div class="panel-body">

                        <form action="" method="POST">

                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label for="client_username"><span class="text-danger" style="margin-right: 5px;">*</span> ชื่อผู้ใช้งาน : </label>
                                    <div class="input-group">
                                        <input class="form-control" id="client_username" type="text" name="client_username" placeholder="ชื่อผู้ใช้งาน" required="" autofocus="">
                                        <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-user" aria-hidden="true"></label>
            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label for="client_password"><span class="text-danger" style="margin-right: 5px;">*</span> รหัสผ่าน : </label>
                                    <div class="input-group">
                                        <input class="form-control" id="client_password" type="password" name="client_password" placeholder="รหัสผ่าน" required="">
                                        <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></label>
                                        </span>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-xs-4">
                                    <button class="btn btn-primary" name="submit" type="submit" value=" Login ">เข้าสู่ระบบ</button>

                                </div>

                            </div>
                            <label style="margin-left: 5px;">หรือ</label> <br>
                            <label style="margin-left: 5px;"><a href="clientsignup.php">สร้างบัญชีพนักงานใหม่</a></label>
                        </form>
                    </div>
                </div>
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