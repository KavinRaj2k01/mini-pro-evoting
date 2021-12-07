<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head> <title> Sona E-Voting </title>
<link rel="stylesheet" href="stylecommon.css">
<style>
h1{
	color:white;
	text-align:center;
}
</style>
</head>
<body>
 <table>
 <form action="index.php" method="post" autocomplete="off">
 <tr><td><h1> Sona E-voting Welcomes You </h1></td></tr>
 <tr><td> <h2> Instructions </h2> </td></tr>
 <tr><td style="font-weight:bold;"> 1.) Enter Your Username, Password and uniqueID below to Log in. </td></tr>
 <tr><td style="font-weight:bold;"> 2.) Make Sure you have entered the OTP and Answer Correctly ,then only you will be able to vote. </td></tr>
 <tr><td style="font-weight:bold;"> 3.) There will be given some Time Limit inside , so make sure you have responded within the time limit. </td></tr>
   <tr><td><input type="text" placeholder="Enter your Username" name="uname" id="un" required></td></tr>
   <tr><td><input type="password" placeholder="Enter Your Password" name="pwd" required></td></tr>
   <tr><td><input type="text" placeholder="Enter Your Unique ID" name="ud" required></td></tr>
   <tr><td><input type="submit" name="submit"></td></tr>
 </form>
 </table>
<?php
$connection=mysqli_connect("localhost","root","","kavi");
     if(!$connection)
     {
		die("database connection error".mysql_error());
	 }
	 else
	{
		//echo "Connected Successfully";
	}
	if(isset($_POST['submit']))
	{
	$_SESSION['last_login_timestamp']=time();
	$una=$_POST['uname'];
	$pswd=$_POST['pwd'];
	$userid=$_POST['ud'];
    $checkque=mysqli_query($connection,"select * from users3 where password='$pswd' and uid='$userid'");
	$count=mysqli_num_rows($checkque);
	if($count>0)
	{
		echo "Login success";
		$_SESSION['name']=$userid;
		$_SESSION['username']=$una;
		echo "<script> location.href='otpsend.php'</script>";
	}
	else{
		echo "<h1>Login failed</h1>";
	}
	}
?>
</body>
</html>