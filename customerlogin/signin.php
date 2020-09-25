
<?php


if(isset($_POST['submit'])){
  $err=[];
  if(isset($_POST['user'])&& !empty($_POST['user'])&& trim($_POST['user']) !='') {

if(strlen($_POST['user'])<6){
      $err['user'] = 'username must be atleast 6 characters';
    }else{
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
  if(count($err)==0)
{

   require_once "../include/connet.php";

   $sql="select * from customers where customerUser='$user' and customerPass='$pass'";
  //execute
$result=mysqli_query($conn,$sql);
$data=[];
$id=0;

while($d=mysqli_fetch_array($result))
{
array_push($data, $d);
}
foreach($data as $a)
{
	$id=$a['customerId'];
}
if(mysqli_num_rows($result)==1)
{
session_start();
$_SESSION['user']=$user;
$_SESSION['customerId']=$id;
$_SESSION['time']=time() + 600;
if (isset($_POST['rem'])&& !empty($_POST['rem'])) {
      setcookie('user',$user,time()+60); 
      }

      header('location:../customerpage.php');

} else{
  echo '<h4 style="color:white;">login failed<h4>';
}

//database ends
if(isset($_COOKIE['user'])&&!empty($_COOKIE['user']))

{
  session_start();
        $_SESSION['user']=$_COOKIE['user'];
  $_SESSION['time']=time()+600;
header('location:../customerpage.php');
}
}}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign in</title>
  <link rel="stylesheet" type="text/css" href="../css/sign.css">

</head>
<body>
  <div class='a'>
		<form action="" method="post" >
      <header><a href='../homepage.php'>Home</a></header>
<table border="0">
	<caption><h2>User login</h2></caption>
	<tbody>
		<tr>
			<td class='a'>Username</td>
			<td><input type="text" name="user"></td>
					</tr>
					<tr>
<td class='a'>Password</td>
<td><input type="password" name="pass"></td>
		</tr>
			<tr><td><input type="submit" name="submit" value="Sign in"></td></tr>
			<td><a href="signup.php" class='b'>Or Sign up</a></td>
	</tbody>
</table>
</form>
</div>
</body>
</html>