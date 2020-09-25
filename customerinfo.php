<?php 
session_start();
$cid=$_SESSION['customerId'];

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

   require_once "include/connet.php";
      $sq="SELECT * FROM customers WHERE customerId='$cid'";
          
          $result=mysqli_query($conn,$sq);

      $data=mysqli_fetch_array($result);

$err=[];
$info=[];

if(isset($_POST['update'])){
  
 if(isset($_POST['name'])&& !empty($_POST['name'])&& trim($_POST['name']) !='') {
      //check length
    if(strlen($_POST['name'])<4){
      $err['name'] = 'name must be atleast 4 characters';
    }else{
      $name=$_POST['name'];
    }
  }else {
    $err['name']='Enter name';
  }
  if(isset($_POST['address'])&& !empty($_POST['address'])&& trim($_POST['address']) !='') {
      
      $address=$_POST['address'];
  }else {
    $err['address']='Enter address';
  }
   if(isset($_POST['phone'])&& !empty($_POST['phone'])) {
    $val=$_POST['phone'];
      if($val<0)
      {
        $err['phone']='Invalid number';
      }
      else
      {
              $phone=$_POST['phone'];
      }
  }
  else {
    $err['phone']='Enter phone';
  }
  if(isset($_POST['email'])&& !empty($_POST['email'])&& trim($_POST['email']) !='') {
      
      $email=$_POST['email'];
  }
  else {
    $err['email']='Enter email';
  }
  

  //database
  if(count($err)==0)
{
  //database connection
 
      $sql= "update customers set customerName='$name',address='$address',phone='$phone',email='$email' where customerId='$cid'";
      $result=mysqli_query($conn,$sql);
    
      header("location:customerinfo.php");    
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Setting</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/cusinfo.css">
</head>
<body>
  <?php require_once 'customermenu.php' ?>
 <form method="post" action="">
<label>Name</label>
    <input type="text" name="name" value="<?php echo $data['customerName']; ?>"><span><?php if(isset($err['name'])){
      echo $err['name'];
    }
    ?></span><br>
    <label>Address</label>
    <input type="text" name="address" value="<?php echo $data['address']; ?>"><span><?php if(isset($err['address'])){
      echo $err['address'];
    }
    ?></span><br>
    <label>Phone</label>
    <input type="number" name="phone" value="<?php echo $data['phone']; ?>"><span><?php if(isset($err['phone'])){
      echo $err['phone'];
    }
    ?></span><br>
    <label>Email</label>
    <input type="email" name="email" value="<?php echo $data['email']; ?>"><span><?php if(isset($err['email'])){
      echo $err['email'];
    }
    ?></span><br>
        <input type="submit" name="update" value="update">
</form>

    <?php require_once 'footer.php' ?>
  </body>
</html>