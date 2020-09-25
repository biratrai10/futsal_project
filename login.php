<?php 
  
if(isset($_POST['submit']))
{
  $err=[];
  if(isset($_POST['username'])&& !empty($_POST['username']) && trim($_POST['username']) != '')
  {
    if(strlen($_POST['username'])<6)
    {
      $err['username']="username must be 6 characters";
    }
    else
    {
          $username = $_POST['username'];
    }
  }
  else
  {
    $err['username']="Enter Username";
  }
  if(isset($_POST['password'])&& !empty($_POST['password']) && trim($_POST['password']) != '')
  {
    
    $password = md5($_POST['password']);
  }
  else
  {
    $err['password']="Enter password";
  }

//database
if(count($err)==0)
{

  //database connection
 require_once "include/connet.php";
  $sql="select * from tbl_admin where status=1 and username='$username' and password='$password'";
  //execute
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)==1)
{
session_start();
$_SESSION['username']=$username;
header('location:adminPanel.php');
} else{
  echo "Login Failed";
}
}
//database ends
 

  
if(isset($_COOKIE['username'])&&!empty($_COOKIE['username']))

{
  session_start();
        $_SESSION['username']=$_COOKIE['username'];
  $_SESSION['time']=time()+600;
header('location:adminPanel.php');
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" href="css/adminlogin.css" >
	<script type="text/javascript">
		function valid()
		{
			var a=document.form.username.value;
			var b=document.form.password.value;
		if(a!=' ')
    {
if(a<6)
{
alert("username must be 6 characters");
}
    }
    else
    {
      alert("Enter username");
    }
    if(b=='')
    {
alert("Enter password");
    }
		}
	</script>
</head>
<body>
<div class="loginBox">
			<a href='homePage.php'><img src="img/futsalogo.png" class="user"></a>
			<h2>Log In</h2>
			<form method="post" action="" name='form' onsubmit="valid()">
				<p>Username</p>
				<input type="text" name="username" placeholder="">
				<section><?php if(isset($err['username']))
  {
    echo $err['username'];
  }
  ?></section>
				<p>Password</p>
				<input type="password" name="password" placeholder="••••••">


        <span><a href='' onclick='show()' >Show</a></span>
        
				<section><?php 
  if(isset($err['password']))
  {
    echo $err['password'];
  }
  ?></section>
<span>Remember me</span>
  <input type="checkbox" name="rem"><br>
				<input type="submit" name="submit" value="Sign In">
				<a href="forget.php">Forget Password</a>
			</form>
		</div>

</body>
</html>
<script type="text/javascript">
 function show()
 {
var a=document.form.password.value;
if(a=='')
{
  alert('Enter Password');
 } 
 else
 {
  alert(a);
 }
}
</script>