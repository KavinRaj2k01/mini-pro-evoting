<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head> <title> OTP Verification </title>
</head>
<body>
<?php
if(!isset($_SESSION['name']))
{
	echo "<script> location.href='index.php'</script>";
}
else
{?>
<link rel="stylesheet" href="stylecommon.css">
<div style="margin-top:2%;margin-bottom:2%;"><section class="lead" style="float:right;"> <?php echo $_SESSION['username'];?> </section> </div>
 <form method="post">
   <table>
   <tr><td><h1> Enter the OTP Below </h1></td></tr>
   <tr><td><input type="number" name="otpnum" placeholder="Enter your OTP Here"></td></tr>
   <tr><td><input type="submit" name="submit"></input></td></tr>
   </table>
 </form>
<?php
$connection=mysqli_connect("localhost","root","","kavi");
if(!$connection)
{
die("database connection error".mysql_error());
}
else
{
    if(isset($_POST['submit']))
	{
	$_SESSION['otpverbtn']=time();
	$var=$_SESSION['name'];
	$queotp=mysqli_query($connection,"select otp from admin3 where usid='$var'");
    while($row=mysqli_fetch_array($queotp))
    {
    $onma=$row['otp'];
    }
	if($onma==$_POST['otpnum'])
	{
		echo "<script> location.href='sign.php'</script>";
	}
	else{
		echo "<script>alert('hey wrong OTP ,Please enter the correct one');</script>";		
	}
	}
}
}
?>
</body>
</html>