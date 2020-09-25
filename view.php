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

  //database connection
     require_once "include/connet.php";

  $sql="SELECT * FROM customers as c
INNER JOIN bookings as b
on c.customerId=b.customerId
  ";
 //1st option $result = $conn->query($sql);
  $result=mysqli_query($conn,$sql);
$data=[];
	//fetch data from database
	while($d=mysqli_fetch_array($result,MYSQLI_ASSOC))//MYSQLI_BOTH(default),MYSQLI_NUM,MYSQLI_ASSOC
	{
		//insert $d into $data
		array_push($data, $d);
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>VIEWs</title>
		<link rel="stylesheet" type="text/css" href="css/view.css">

</head>
<body>
<h1>Views</h1>
	<p><a href='booking.php'>Back</a></p>
<table border="1">
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Address</th>
			<th>Phone</th>
			<th>Email</th>
			<th>Date</th>
			<th>Time</th>
			<th>Status</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody>
		<?php 
	

foreach ($data as $a) {?>
<tr>
	<td><?php echo $a['customerId'] ?></td>
		<td><?php echo $a['customerName'] ?></td>
	<td><?php echo $a['address'] ?></td>
	<td><?php echo $a['phone'] ?></td>
		<td><?php echo $a['email'] ?></td>
		<td><?php echo $a['bookingDate'] ?></td>
		<td><?php echo $a['bookingTime'] ?></td>
<td><?php if($a['status']==1){
			echo "confirm";
		}
		else{
			echo "pending";
		} ?></td>						<td><?php echo $a['price'] ?></td>

		<td><a href="delete.php?id=<?php echo $a['bookingId'] ?>" onclick="return confirm('Are you sure to delete ?')">Delete</a></td>
		<td><a href="update.php?id=<?php echo $a['bookingId']?>">Edit</a></td> 
	</tr>
<?php }?>


	</tbody>
</table>
</body>
</html>