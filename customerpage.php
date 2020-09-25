<?php

session_start();
$id=$_SESSION['customerId'];
if(!isset($_SESSION['user']))
{
header('location:customerlogout.php');
}
if($_SESSION['time'] < time())
{
  header('location:customerlogout.php');
}
else{
  $_SESSION['time']=time()+600;
}

if(isset($_POST['submit'])){
  $err=[];
  
  if(isset($_POST['dt'])&& !empty($_POST['dt']))
    {
      $dt=$_POST['dt'];
      $datent=strtotime($dt);
      $datenow=strtotime("-1day");
      if($datent<=$datenow)
      {
        $err['dt']='Invalid date format';
      }

    }
    else
    {
      $err['dt']='Enter the date';
    }
    if(isset($_POST['tm'])&& !empty($_POST['tm'])&& trim($_POST['tm']) !='')
    {
      $tm=$_POST['tm'];
    }
    else
    {
      $err['tm']='choice time';
    }

  //database
  if(count($err)==0)
{
  //database connection
    require_once "include/connet.php";

  $sql="insert into bookings (bookingDate,bookingTime,customerId) values('$dt','$tm','$id')";

  if(!mysqli_query($conn,$sql))
  {

    $err['dt']="Time is already booked";
  }
  else if(mysqli_error($conn))
  {
      mysqli_close($conn);
  }
  else
  {
     session_start();
$_SESSION['dt']=$dt;
$_SESSION['tm']=$tm;
      header('location:customerbooking.php');
  }
  
}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Futsal Booking</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/home.css">
<link rel="stylesheet" type="text/css" href="css/customerpage.css">
</head>
<body>

  <?php require_once 'customermenu.php' ?>
    <div class='container-fluid'>

  <div class="row">
  <div class="col-lg-6">
  	<h4 style='color: white;'>Information</h4>
<p style='color: white;'>Booking charge per hour is Rs 1500</p>
<p style='color: white;'>After booking futsal don't forgot to watch status.</p>

  </div>

  <div class="col-lg-6">
  	<h4>Book Here</h4>
  	<form action="" method="POST" name="form" > 
  	<label>Date</label>
  	<input type="date" name="dt" valid>
    <select for='time' name='tm'>
      <OPTION value="">Select time</OPTION>
      <option value='8:00-9:00 AM'>8:00-9:00 AM</option>
      <option value="9:00-10:00 AM">9:00-10:00 AM</option>
      <option value="10:00-11:00 AM">10:00-11:00 AM</option>
      <option value="11:00-12:00 AM">11:00-12:00 AM</option>
      <option value="12:00-1:00 PM">12:00-1:00 PM</option>
      <option value="1:00-2:00 PM">1:00-2:00 PM</option>
      <option value="3:00-4:00 PM">3:00-4:00 PM</option>
      <option value="4:00-5:00 PM">4:00-5:00 PM</option>
      <option value="5:00-6:00 PM">5:00-6:00 PM</option>
      <option value="6:00-7:00 PM">6:00-7:00 PM</option>
      <option value="7:00-8:00 PM">7:00-8:00 PM</option>
      <option value="8:00-9:00 PM">8:00-9:00 PM</option>

    </select><?php if(isset($err['tm']))
  {
    echo $err['tm'].'    require_once 'message.php'
';
  }
  ?><br>
    <?php if(isset($err['dt']))
  {
    echo $err['dt'].'<br>';
  }
  ?>
  
  	<input type="submit" name="submit" value="submit">
  </form>
  </div>

</div>
</div>

         <?php require_once 'customerbookedlist.php' ?>
<div class='a'>
      <img src="image/under1.jpg" alt="under1" >
</div>
         <?php require_once 'footer.php' ?>
</body>
</html>

