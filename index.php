<?php

/*
if(isset($_POST['submit'])){
  $err=[];
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
      
      $phone=$_POST['phone'];
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
  
  if(isset($_POST['dt'])&& !empty($_POST['dt'])&& trim($_POST['dt']) !='')
    {
      $dt=$_POST['dt'];
    }
    if(isset($_POST['tm'])&& !empty($_POST['tm'])&& trim($_POST['tm']) !='')
    {
      $tm=$_POST['tm'];
    }
  //database
  if(count($err)==0)
{
  //database connection
    require_once "include/connet.php";

  $sql="insert into customers
  (customerName,address,phone,email) values('$name','$address','$phone','$email')";
  mysqli_query($conn,$sql);
}
}
*/?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/home.css">

</head>
<body>

  <?php require_once 'menu.php' ?>
  <?php require_once 'slider.php' ?>
    <div class='container-fluid'>

  <div class="row">
  <div class="col-lg-6">
    <h4>Information</h4>

  </div>

  <div class="col-lg-6">
    <!--<h4>Book Here</h4>
    <form action="" method="POST" name="form" onsubmit="valid()"> 
    <label>Name</label>
    <input type="text" name="name"><?php if(isset($err['name'])){
      echo $err['name'];
    }
    ?><br>
    <label>Address</label>
    <input type="text" name="address"><?php if(isset($err['address'])){
      echo $err['address'];
    }
    ?><br>
    <label>Phone</label>
    <input type="number" name="phone" ><?php if(isset($err['phone'])){
      echo $err['phone'];
    }
    ?><br>
    <label>Email</label>
    <input type="email" name="email"><br>
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
  </form>-->
  </div>

</div>
</div>
         <?php require_once 'footer.php' ?>
</body>
</html>
<!--<script type="text/javascript">
  function valid(){
  var name=document.form.name.value;
 
  if(name!='')
  {
if(name.length<4)
{
alert("name must be atleast 4 characters ");
}
}
  else{
alert("Enter name");
  }
var address=document.form.address.value;
if(address=='')
{
alert('Enter address');
}
var phone=document.form.phone.value;
if(phone=='')
{
alert('Enter phone');
}
var dat=document.form.dt.value;
var dt=new Date();
var y=dt.getFullYear();
var m=dt.getMonth()+1;
var d=dt.getDate();
var s=dat.split('-');
var dates=parseInt(s[0])+parseInt(s[1])+parseInt(s[2]);
var check=parseInt(y+m+s);

if(dat!='')
{
  if(parseInt(dates)<parseInt(check))
  {
    alert('Enter valid date');
  }
}
else{
  alert("Enter date");
}
var time=document.form.tm.value;
if(time=='')
{
  alert("Choice time");
}
}

</script>
->