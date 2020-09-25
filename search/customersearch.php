<?php 
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
$err=[];
if(isset($_GET['search']))
{
	if(isset($_GET['data'])&& !empty($_GET['data']) && trim($_GET['data']) !='')
	{
		$data=$_GET['data'];
	}
	else
	{
		$err['data']='Enter customer name';
	}
}
if(count($err)==0)
{
	     require_once "../include/connet.php";
	     if(isset($data))
	     {
	     	$sql="SELECT * FROM customers WHERE customerName LIKE '%".$data."%'";
	     	$result=mysqli_query($conn,$sql);
	     	$data1=[];
	//fetch data from database
	while($d=mysqli_fetch_array($result,MYSQLI_ASSOC))//MYSQLI_BOTH(default),MYSQLI_NUM,MYSQLI_ASSOC
	{
		//insert $d into $data
		array_push($data1, $d);
	}
	
	 $anymatches=mysqli_num_rows($result); 
	
 if ($anymatches == 0) 
 { 
 echo "Customer not found.<br><br>"; 
 
}
}


}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SEARCH</title>
</head>
<body>
<form method="get" action="<?php echo $_SERVER['PHP_SELF']?>">
	<p><a href='../adminPanel.php'>Back</a></p>
	SEARCH CUSTOMER 
	<input type='text' name='data'>
	<input type="submit" name="search" value="search">
	<br>
	<?php 
	if(isset($_GET['search']))
	{
		echo "<table border='1'><thead><tr><th>Id</th><th>CustomerName</th><th>Address</th><th>Phone</th><th>Email</th>
		</tr>
	</thead>
	<tbody>";
foreach ($data1 as $a) {?>
<tr>
		<td><?php echo $a['customerId'] ?></td>
		<td><?php echo $a['customerName'] ?></td>
	<td><?php echo $a['address'] ?></td>
	<td><?php echo $a['phone'] ?></td>
		<td><?php echo $a['email'] ?></td>
<?php }}?>
	<span><?php if(isset($err['data']))
  {
    echo $err['data'];
  }
  ?></span><br>
</form>
</body>
</html>