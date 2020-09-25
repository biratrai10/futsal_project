<?php


if(isset($_POST['submit'])){
  $err=[];
  if(isset($_POST['user'])&& !empty($_POST['user'])&& trim($_POST['user']) !='') {

if(strlen($_POST['user'])<6){
      $err['user'] = 'username must be atleast 6 characters';
    }
    else if(preg_match("/[^a-zA-Z0-9_-]/", $_POST['user']))
      {
              $err['user'] = 'Only letters,number and _ or - as username';
      }
      else{
      $user=$_POST['user'];
    }
  }
  else{
    $err['user']='Enter username';
  }
  if(isset($_POST['pass'])&& !empty($_POST['pass'])&& trim($_POST['pass']) !='') {

      $pass=md5($_POST['pass']);
  }
  else{
    $err['pass']='Enter password';
  }

  if(isset($_POST['name'])&& !empty($_POST['name'])&& trim($_POST['name']) !='') {
      //check length
    if(strlen($_POST['name'])<4){
      $err['name'] = 'name must be atleast 4 characters';
    }
    else if(preg_match("/[0-9]/", $_POST['name']))
      {
              $err['name'] = 'Only letters as fullname';
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
  /**if(isset($_POST['email'])&& !empty($_POST['email'])&& trim($_POST['email']) !='') {
      
      $email=$_POST['email'];
  }
  else {
    $err['email']='Enter email';
  }
  */
  if(isset($_POST['email'])&& !empty($_POST['email'])&& trim($_POST['email']) !='') {
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  $err['email']="Invalid email";

}else
{
    $email=$_POST["email"]; 

}
}
else
{
  $err['email']="Enter email";

}
  //database
  if(count($err)==0)
{
  //database connection
    require_once "../include/connet.php";

  $sql="insert into customers
  (customerUser,customerPass,customerName,address,phone,email) values('$user','$pass','$name','$address','$phone','$email')";
  $result=mysqli_query($conn,$sql);
if(!$result)
{
  echo "<h2>Failed</h2>";
}
else
{
  echo "<h2>Successful</2>";
}
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
  <link rel="stylesheet" type="text/css" href="../css/signup.css">

</head>
<body >
<form action="" method="post">

  <section>
    <h2>Sign Up</h2>
  <label for="user">Username</label>
  <input type="text" name="user"/>
  <?php if(isset($err['user'])){
      echo $err['user'];
    }
    ?><br>
  <label for="pass">Password</label>
    <input type="password" name="pass"/>
    <?php if(isset($err['pass'])){
      echo $err['pass'];
    }
    ?><br>
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
    <input type="email" name="email"><?php if(isset($err['email'])){
      echo $err['email'];
    }
    ?><br>
        <input type="submit" name="submit" value="submit">
              <a href="signin.php" class='b'>Or Sign in</a>
</section>

</form>
</body>
</html>