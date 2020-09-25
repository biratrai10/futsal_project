
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/menu.css">
     

	<script type="text/javascript" src="javascript/clock.js">

</script>

</head>
<body>
<div class="container-fluid">
	<header><a href="">Khwopa futsal Online Booking</a>
<div class="clock">
	<span id="hr">00</span>
	<span>:</span>
	<span id="min">00</span>
	<span>:</span>
	<span id="sec">00</span><br>

<?php echo date('m/d/Y'); ?>
</div>
</div>
	</header>

	<nav class="navbar navbar-expand-sm bg-secondary navbar-dark sticky-top">

  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="customerpage.php">Booking</a>
    </li>
  
 <li class="nav-item">
      <a class="nav-link" href="customerinfo.php">Change Userinfo</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="customerlogout.php">Log out</a>
    </li>
    
  </ul>
</nav>
</body>
</html>