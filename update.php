
<?php 
session_start();
$bid=$_SESSION['adminId'];

if(!isset($_SESSION['username']))
{
header('location:logout.php');
}
if($_SESSION['time'] < time())
{
  header('location:logout.php');
}
else{
  $_SESSION['time']=time()+600;
}
   require_once "include/connet.php";

			$id=$_GET['id'];
      $sq="SELECT * FROM bookings WHERE bookingId='$id'";
          
          $result=mysqli_query($conn,$sq);

      $data=mysqli_fetch_array($result);

$err=[];

if(isset($_POST['update'])){
  $err=[];
  
  if(isset($_POST['status'])&& !empty($_POST['status'])&& trim($_POST['status']) !='') {
      
      $status=$_POST['status'];
  }else {
    $err['status']='Enter status';
  }

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
 
			$sql= "update bookings set status='$status',bookingDate='$dt',bookingTime='$tm',adminId='$bid' where bookingId='$id'";
			mysqli_query($conn, $sql);
    
			header("location:view.php");

}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/update_delete.css">

</head>
<body>

    <div class='container-fluid'>
  <p><a href='booking.php'>Back</a></p>

  <div class="row">

  <div class="col-lg-6">
  	<form action="" method="post" name="form" > 
  	<label>Status:</label>
<?php if ($data['status']==1) { ?>
      <input type="radio" name="status" value="1"  checked="">Confirm
    <input type="radio" name="status" value="0">Pending
    <?php }else{?>
      <input type="radio" name="status" value="1">Confirm
    <input type="radio" name="status" value="0" checked="">Pending
    <?php }  if (isset($err['status'])) {
      echo $err['status'];
    } ?>
    <br>
  	
  	<label>Date</label>
    
  	<input type="date" name="dt"  value="<?php echo $data['bookingDate']; ?>">
    <select for='time' name='tm'>
      <option value="<?php echo $data['bookingTime'];?>"><?php echo $data['bookingTime'];?>
</option>
      <option value=''>select time</option>
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
    </select><br><span><?php if(isset($err['tm']))
  {
    echo $err['tm'];
  }
  ?></span><span><?php if(isset($err['tm']))
  {
    echo $err['tm'];
  }
  ?></span><br>
  	<input type="submit" name="update" value="update">
  </form>
  </div>

</div>
</div>
</body>
</html>
