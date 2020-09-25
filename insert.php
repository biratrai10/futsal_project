<?php 
$err=[];
    require_once "include/connet.php";
session_start();
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
if(isset($_POST['submit'])){
  
  if(isset($_POST['id'])&& !empty($_POST['id'])&& trim($_POST['id']) !='') {
      
      $id=$_POST['id'];
  }else {
    $err['id']='Enter id';
  }
 
  
  if(isset($_POST['dt'])&& !empty($_POST['dt'])&& trim($_POST['dt']) !='')
    {
      $dt=$_POST['dt'];
    }
    if(isset($_POST['tm'])&& !empty($_POST['tm'])&& trim($_POST['tm']) !='')
    {
      $tm=$_POST['tm'];
    }
if(count($err)==0)
{
  //database connection

 $sql="insert into bookings
  (bookingDate,bookingTime,customerId) values('$dt','$tm','$id')";
  mysqli_query($conn,$sql);

} 
$sq="SELECT * FROM customers '";
          
          $result=mysqli_query($conn,$sq);

      $data=mysqli_fetch_array($result);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<p><a href='booking.php'>Back</a></p>
<form action="" method="POST" name="form" onsubmit="valid()"> 
  	
    <label>CustomerUser</label>
    <select for='name' name='customerUser'>

<option value='<?php $data['customerUser'];?>'><?php echo $data['customerUser'];?></option>
    </select> 


<br>
  	<label>Date</label>
  	<input type="date" name="dt" valid>
    <select for='time' name='tm'>
      <OPTION value="">Select times</OPTION>
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

    </select><br>
  	<input type="submit" name="submit" value="submit">
  </form>
</body>
</html>