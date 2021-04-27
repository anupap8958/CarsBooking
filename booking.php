<!DOCTYPE html>
<html>
<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?> 
<title>Book Car </title>
<head>
    <script type="text/javascript" src="assets/ajs/angular.min.js"> </script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>  
  <script type="text/javascript" src="assets/js/custom.js"></script> 
 <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>
<body ng-app=""> 


      <!-- Navigation -->
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
    
<div class="container" style="margin-top: 65px;" >
    <div class="col-md-7" style="float: none; margin: 0 auto;">
      <div class="form-area">
        <form role="form" action="bookingconfirm.php" method="POST">
        <br style="clear: both">
          <br>

        <?php
        $car_id = $_GET["id"];
        $sql1 = "SELECT * FROM cars WHERE car_id = '$car_id'";
        $result1 = mysqli_query($conn, $sql1);

        if(mysqli_num_rows($result1)){
            while($row1 = mysqli_fetch_assoc($result1)){
                $car_name = $row1["car_name"];
                $car_nameplate = $row1["car_nameplate"];
                $ac_price = $row1["ac_price"];
                $non_ac_price = $row1["non_ac_price"];
                $ac_price_per_day = $row1["ac_price_per_day"];
                $non_ac_price_per_day = $row1["non_ac_price_per_day"];
            }
        }

        ?>

          <!-- <div class="form-group"> -->
              <h5> รถของท่าน:&nbsp;  <b><?php echo($car_name);?></b></h5>
         <!-- </div> -->
         
          <!-- <div class="form-group"> -->
            <h5> หมายเลขทะเบียน:&nbsp;<b> <?php echo($car_nameplate);?></b></h5>
          <!-- </div>      -->
        <!-- <div class="form-group"> -->
        <?php $today = date("Y-m-d") ?>
          <label><h5>เริ่มต้น:</h5></label>
            <input type="date" name="rent_start_date" min="<?php echo($today);?>" required="">
            &nbsp; 
          <label><h5>สิ้นสุด:</h5></label>
          <input type="date" name="rent_end_date" min="<?php echo($today);?>" required="">
        <!-- </div>      -->
        
        <h5> เลือกประเภทของรถ:  &nbsp;
            <input onclick="reveal()" type="radio" name="radio" value="ac" ng-model="myVar"> <b>มีประกัน </b>&nbsp;
            <input onclick="reveal()" type="radio" name="radio" value="non_ac" ng-model="myVar"><b>ไม่มีประกัน </b>
                
        
        <div ng-switch="myVar"> 
        <div ng-switch-default>
                    <!-- <div class="form-group"> -->
                <h5>อัตราค่าบริการ : <h5>    
                <!-- </div>    -->
                     </div>
                    <div ng-switch-when="ac">
                    <!-- <div class="form-group"> -->
                <h5>อัตราค่าบริการ : <b><?php echo("Rs. " . $ac_price . "/km and Rs. " . $ac_price_per_day . "/day");?></b><h5>    
                <!-- </div>    -->
                     </div>
                     <div ng-switch-when="non_ac">
                     <!-- <div class="form-group"> -->
                <h5>อัตราค่าบริการ : <b><?php echo("Rs. " . $non_ac_price . "/km and Rs. " . $non_ac_price_per_day . "/day");?></b><h5>    
                <!-- </div>   -->
                     </div>
        </div>

         <h5> ประเภท :  &nbsp;
            <input onclick="reveal()" type="radio" name="radio1" value="km"><b> ต่อกิโลเมตร</b> &nbsp;
            <input onclick="reveal()" type="radio" name="radio1" value="days"><b> ต่อวัน</b>

            <br><br>
                <!-- <form class="form-group"> -->
                กรุณาเลือกคนขับ : &nbsp;
                <select name="driver_id_from_dropdown" ng-model="myVar1">
                        <?php
                        $sql2 = "SELECT * FROM driver d WHERE d.driver_availability = 'yes' AND d.client_username IN (SELECT cc.client_username FROM clientcars cc WHERE cc.car_id = '$car_id')";
                        $result2 = mysqli_query($conn, $sql2);

                        if(mysqli_num_rows($result2) > 0){
                            while($row2 = mysqli_fetch_assoc($result2)){
                                $driver_id = $row2["driver_id"];
                                $driver_name = $row2["driver_name"];
                                $driver_gender = $row2["driver_gender"];
                                $driver_phone = $row2["driver_phone"];
                    ?>
  

                    <option value="<?php echo($driver_id); ?>"><?php echo($driver_name); ?>
                   

                    <?php }} 
                    else{
                        ?>
                    ขออภัย ! ขณะนี้พนักงานขับรถไม่ว่าง
                        <?php
                    }
                    ?>
                </select>
                <!-- </form> -->
                <div ng-switch="myVar1">
                

                <?php
                        $sql3 = "SELECT * FROM driver d WHERE d.driver_availability = 'yes' AND d.client_username IN (SELECT cc.client_username FROM clientcars cc WHERE cc.car_id = '$car_id')";
                        $result3 = mysqli_query($conn, $sql3);

                        if(mysqli_num_rows($result3) > 0){
                            while($row3 = mysqli_fetch_assoc($result3)){
                                $driver_id = $row3["driver_id"];
                                $driver_name = $row3["driver_name"];
                                $driver_gender = $row3["driver_gender"];
                                $driver_phone = $row3["driver_phone"];

                ?>

                <div ng-switch-when="<?php echo($driver_id); ?>">
                    <h5>ชื่อรถ:&nbsp; <b><?php echo($driver_name); ?></b></h5>
                    <p>เพศ:&nbsp; <b><?php echo($driver_gender); ?></b> </p>
                    <p>เบอร์ติดต่อ:&nbsp; <b><?php echo($driver_phone); ?></b> </p>
                </div>
                <?php }} ?>
                </div>
                <input type="hidden" name="hidden_carid" value="<?php echo $car_id; ?>">
                
         
           <input type="submit"name="submit" value="ยืนยัน" class="btn btn-warning pull-right">     
        </form>
        
      </div>
      <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            
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