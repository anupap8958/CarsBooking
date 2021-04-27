<!DOCTYPE html>
<html>
<?php 
session_start();
require 'connection.php';
$conn = Connect();
?>
<head>
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
<link rel="stylesheet" href="assets/w3css/w3.css">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/bookingconfirm.css" />
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
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
<body>

<?php 
$id = $_GET["id"];
$distance = NULL;
$distance_or_days = $conn->real_escape_string($_POST['distance_or_days']);
$fare = $conn->real_escape_string($_POST['hid_fare']);
$total_amount = $distance_or_days * $fare;
$car_return_date = date('Y-m-d');
$return_status = "R";
$login_customer = $_SESSION['login_customer'];

$sql0 = "SELECT rc.id, rc.rent_end_date, rc.charge_type, rc.rent_start_date, c.car_name, c.car_nameplate FROM rentedcars rc, cars c WHERE id = '$id' AND c.car_id = rc.car_id";
$result0 = $conn->query($sql0);

if(mysqli_num_rows($result0) > 0) {
    while($row0 = mysqli_fetch_assoc($result0)){
            $rent_end_date = $row0["rent_end_date"];  
            $rent_start_date = $row0["rent_start_date"];
            $car_name = $row0["car_name"];
            $car_nameplate = $row0["car_nameplate"];
            $charge_type = $row0["charge_type"];
    }
}

function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}

$extra_days = dateDiff("$rent_end_date", "$car_return_date");
$total_fine = $extra_days*200;

$duration = dateDiff("$rent_start_date","$rent_end_date");

if($extra_days>0) {
    $total_amount = $total_amount + $total_fine;  
}

if($charge_type == "days"){
    $no_of_days = $distance_or_days;
    $sql1 = "UPDATE rentedcars SET car_return_date='$car_return_date', no_of_days='$no_of_days', total_amount='$total_amount', return_status='$return_status' WHERE id = '$id' ";
} else {
    $distance = $distance_or_days;
    $sql1 = "UPDATE rentedcars SET car_return_date='$car_return_date', distance='$distance', no_of_days='$duration', total_amount='$total_amount', return_status='$return_status' WHERE id = '$id' ";
}

$result1 = $conn->query($sql1);

if ($result1){
     $sql2 = "UPDATE cars c, driver d, rentedcars rc SET c.car_availability='yes', d.driver_availability='yes' 
     WHERE rc.car_id=c.car_id AND rc.driver_id=d.driver_id AND rc.customer_username = '$login_customer' AND rc.id = '$id'";
     $result2 = $conn->query($sql2);
}
else {
    echo $conn->error;
}
?>

    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Car Returned</h1>
        </div>
    </div>
    <br>

    <h2 class="text-center"> ขอบพระคุณ ! ที่ไว้วางใจเรา</h2>

    <h3 class="text-center"> <strong>หมายเลขออเดอร์ :</strong> <span style="color: blue;"><?php echo "$id"; ?></span> </h3>


    <div class="container">
        <h5 class="text-center">โปรดอ่านข้อมูลด้านล่าง</h5>
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
                <h3 style="color: orange;">ใบเสร็จ</h3>
                <br>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>ชื่อรถ : </strong> <?php echo $car_name;?></h4>
                <br>
                <h4> <strong>หมายเลขทะเบียนรถ :</strong> <?php echo $car_nameplate; ?></h4>
                <br>
                <h4> <strong>อัตราค่าบริการ :&nbsp;</strong><?php 
            if($charge_type == "days"){
                    echo ($fare . "/วัน");
                } else {
                    echo ($fare . "/กิโลเมตร");
                }
            ?></h4>
                <br>
                <h4> <strong>วันที่จอง : </strong> <?php echo date("Y-m-d"); ?> </h4>
                <br>
                <h4> <strong>วันเริ่มต้นการเช่า : </strong> <?php echo $rent_start_date; ?></h4>
                <br>
                <h4> <strong>วันที่ต้องทำการคืนรถ : </strong> <?php echo $rent_end_date; ?></h4>
                <br>
                <h4> <strong>วันที่คืนรถ : </strong> <?php echo $car_return_date; ?> </h4>
                <br>
                <?php if($charge_type == "days"){?>
                    <h4> <strong>จำนวนวัน :</strong> <?php echo $distance_or_days; ?>day(s)</h4>
                <?php } else { ?>
                    <h4> <strong>ระยะทาง :</strong> <?php echo $distance_or_days; ?>km(s)</h4>
                <?php } ?>
                <br>
                <?php
                    if($extra_days > 0){
                        
                ?>
                <h4> <strong>ระยะทางและจำนวนวันทั้งหมด :</strong> <label class="text-danger"> Rs. <?php echo $total_fine; ?>/- </label> for <?php echo $extra_days;?> extra days.</h4>
                <br>
                <?php } ?>
                <h4> <strong>อัตราค่าบริการทั้งหมด : </strong> Rs. <?php echo $total_amount; ?>/-     </h4>
                <br>
            </div>
        </div>
        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
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