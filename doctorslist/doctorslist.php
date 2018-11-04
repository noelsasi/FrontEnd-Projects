 <?php session_start();
          if(isset($_POST['remember'])){
              setcookie("username",$username);
          }
          ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Doctors | Infectious Disease Detector</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="assets/css/main.css" />
  <style type="text/css">
  	body {
  		top: 0px;
	    background-image: linear-gradient(to top, rgba(19, 21, 25, 0.5), rgba(19, 21, 25, 0.5)), url("../../images/overlay.png");
	    background-size: auto, 256px 256px;
	    background-image: url("images/image21.jpg");
	    background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      margin:0px;
              }
      .container {
  border: 2px solid #ccc;
  background-color: #eee;
  border-radius: 5px;
  padding: 16px;
  width: 65%;
  margin: 16px 0;
}
.container:hover{
  border-color: grey;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  margin-right: 20px;
  border-radius: 50%;
}

.container span {
  font-size: 20px;
  margin-right: 15px;
}

@media (max-width: 500px) {
  .container {
      text-align: center;
  }

  .container img {
      margin: auto;
      float: none;
      display: block;
  }  
  .details1{
    width: 100%;
  }
}      
</style>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
</head>
<body>
<div>
<nav class="navbar navbar-inverse" style=" margin-bottom:0;">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li class="#"><a href="home.php">Home</a></li>
      <li class="#"><a href="mainpage.php">Check Symptoms</a></li>
      <li class=""><a href="viewrecords.php">View Records</a></li>
      <li class="#"><a href="update.php" data-toggle="tooltip" data-placement="bottom" title="Post your Neighbours Health status and Contribute us more">Update Us</a></li>
      <li class="dropdown active"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Doctors</span>
        <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="doctors.php">Consult Doctor</a></li>
          <li><a href="https://www.google.co.in/maps/search/hospitals+near+me/@10.9418622,76.7309732,14z/data=!3m1!4b1?dcr=0" target="blank">Nearest Hospitals</a></li>
       </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> 
        <span style="text-transform: capitalize;"><?php echo $_SESSION['username']; ?></span>
        <span class="caret"></span></a>
      		<ul class="dropdown-menu">
          <li><a href="editmembers.php">Edit Profile</a></li>
          <li><a href="addmembers.php">Add Members</a></li>
          <li><a href="viewmembers.php">View Members</a></li>
          <li><a href="mybookings.php">My Bookings</a></li>
          <li><a href="#">Delete Account</a></li>
       </ul>
      </li>
      <li><a href="index.html"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>
</div>
<br><br>

<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);

if (!$conn) {
     die("Connection failed: " . mysql_error());
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM doctors";
 mysql_select_db('sem_project');
 $retval = mysql_query( $sql, $conn );
            
            if(! $retval ) {
               die('Could not enter data: ' . mysql_error());
}

elseif (mysql_num_rows($retval) > 0) {
     // output data of each row
     while($row = mysql_fetch_assoc($retval)) {
         //echo "Title--- " . $row["username"]. " --- Amount: " . $row["age"]. "--- Persons" . $row["gender"]. $row["problem"]. "--- Persons" .$row["symptom1"]. "--- Persons" .$row["duration"]. "--- Persons" .$row["doctor_report"]. "--- Persons" ."<br>";
      ?>
      <div style="padding-left: 35px;">
        <form action="doctorsbcknd.php" method="Post">
      <div class="container" style="background-color: white">
      <div class="details1" style="float:left;">  
      <p style="display: none;">Doctor ID : <?php echo $row["sno"]; ?></p>
      <img src="images/1.png" style="width:90px">
      <span style="color: #FF5733; font-weight: bold;"><?php echo $row["name"]; ?></span>
      <p style="font-size: 15px; font-weight: bold;"><?php echo $row["category"]; ?></p>
    </div>
      <div class="details2" style="float: right; line-height: 30px;">
      <ul style="list-style-type: none; color: black;">
      <li class="fa fa-map-marker">  <?php echo $row["Hospital_name"]; ?></li><br>
      <li class="fa fa-rupee"> INR <?php echo $row["consult_fee"]; ?></li><br>
      <li class="fa fa-calendar"> <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" style="height:20px; color:black;"></li><br>
      <li class="fa fa-clock-o">  Available today!</li><br>
      <input type=hidden value="<?php echo $row['sno']; ?>" name="ssno" > 
      <li><button class="btn-success" style="height: 30px; line-height: 15px;">Book Appointment</button></li>
    </form>
    </ul>
  </div>
</div>
</div>
<?php

     }
} else {
     echo "0 results";
}

mysql_close($conn);

?>
<div style="background-color: white; height: 500px; width: 30%; position: fixed; right: 10px; margin-top: -1040px;">
<div style="padding: 10px;">
  <img src="second.gif">
   <h4 style="padding:15px;">We have highly qualified doctors, Want to join our team please contact us!</h2> 
  </ul>
</div>
</div>



<!--
<div style="padding-left: 100px">

<div class="container" style="background-color: white">
  <img src="images/1.png" style="width:90px">
  <span style="color: #FF5733; font-weight: bold;"><?php echo $row["name"]; ?></span>
  <p style="font-size: 12px; font-weight: bold;">MBBS MS - Orthopaedics Fellowship in Joint Replacement<br>
  11 years experience</p>
  <div style="float: right; margin-top:-100px; line-height: 30px;">
    <ul style="list-style-type: none; color: black;">
      <li class="fa fa-map-marker">  Peelamedu, Coimbatore</li><br>
      <li class="fa fa-rupee"> INR 200</li><br>
      <li class="fa fa-calendar"> <input type="date" style="height:20px; color:black;"></li><br>
      <li class="fa fa-clock-o">  Available today!</li><br> 
      <li><button class="btn-success">Book Appointment</button></li>
    </ul>
  </div>
</div>

<div class="container" style="background-color: white">
  <img src="images/4.jpg" alt="Avatar" style="width:90px">
  <span style="color: #FF5733; font-weight: bold;">Rebecca Flex.</span>
  <p style="font-size: 12px; font-weight: bold;">MBBS MS - Orthopaedics Fellowship in Joint Replacement<br>
  11 years experience</p>
  <div style="float: right; margin-top:-100px; line-height: 30px;">
    <ul style="list-style-type: none; color: black;">
      <li class="fa fa-map-marker">  Peelamedu, Coimbatore</li><br>
      <li class="fa fa-rupee"> INR 200</li><br>
      <li class="fa fa-calendar"> <input type="date" style="height:20px; color:black;"></li><br>
      <li class="fa fa-clock-o">  Available today!</li><br> 
      <li><button class="btn-success">Book Appointment</button></li>
    </ul>
  </div>
</div>

-->
 
</body>
</html>
