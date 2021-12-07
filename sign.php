<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head> <title> Question Answer </title>
<link rel="stylesheet" href="stylecommon.css">
<link rel="stylesheet" href="http://fonts.googleleapis.com/css?family=PT+Sans+Narrow|Open+Sans:300">
<link rel="stylesheet" href="timerstyle.css">
<style>
div{
	background-image: linear-gradient(to right top, #6b78d1, #707fd5, #7586da, #7a8dde, #7f94e2, #75a0ec, #6aacf4, #60b8fb, #40cbff, #28dcff, #39ecfb, #5ffbf1);
	float:left;
	width:95%;
	height:85px;
	margin-left:1%;
	margin-right:2%;
	margin-top:5%;
}
.lead{
	box-shadow: 0px 0px 0px 0px red; 
    border:2px solid white;	
	border-radius: 5px;
	height:30px;
	width:20%;
	margin-top:25px;
	text-align:center;
	font-weight:bold;
	padding-top:9px;
}
</style>
</head>
<body>
<div class = "container" style="margin-top:1%">
        <h1 class = "timer" id="timer"></h1>
     </div>
<script>
    var seconds=120;
    function displayseconds()
    {
        seconds-=1;
        document.getElementById("timer").innerHTML= ""+seconds+" seconds";
    }
    setInterval(displayseconds,1000);
    function redirectpage()
    {
        alert("Time Over , Hereafter your record won't be accepted");
    }
    setTimeout('redirectpage()',120000);
</script>
<?php
if(!isset($_SESSION['name']))
{
	echo "<script> location.href='index.php'</script>";
}
else{?>
	<div style="margin-top:2%;margin-bottom:2%;"><section class="lead" style="float:right;"> <?php echo $_SESSION['username'];?> </section> </div><?php
    $var=$_SESSION['name'];
    $connection=mysqli_connect("localhost","root","","kavi");
     if(!$connection)
     {
		die("database connection error".mysql_error());
	 }
	 else
	{
		//echo "Connected Successfully";
	}
	$que=mysqli_query($connection,"select question from admin3 where usid='$var'");
    while($row=mysqli_fetch_array($que))
    {
    $onma=$row['question'];
    }
	//echo "<h1>".$onma."</h1>";?>
	<table>
	<form method="post" autocomplete="off">
	 <tr><td><h1> <?php echo $onma;?> </h1></td></tr>
	 <tr><td><input type='text' placeholder='Enter Your Answer Here' name='dob'></tr></td>
	 <tr><td><input type='submit' name='sub'></tr></td>
	</form>
	</table>
	<?php
	if(isset($_POST['sub']))
	{
	$que2=mysqli_query($connection,"select answer from admin3 where usid='$var'");
    while($row=mysqli_fetch_array($que2))
    {
    $onma2=$row['answer'];
    }
	$ansval=strtolower($_POST['dob']);
	if($ansval==$onma2)	
	{
		//echo "<script> location.href='sign.php'</script>";
		//echo "<script> alert('Hey welcome')</script>";
		//echo "<script> location.href='vote.php'</script>";
		if(time()-$_SESSION['otpverbtn']>120)
	    {
		$delsucc = mysqli_query($connection,"DELETE FROM users3 WHERE uid='$var'");
		if(delsucc)
		{
			echo "<script>alert('Time Exceeded Sorry , You can't vote');</script>";
			echo "<script> location.href='logout.php'</script>";
		}	
	    }
		else
		{
		   echo "<script> alert('Hey welcome')</script>";
		   echo "<script> location.href='vote.php'</script>";
		}
		
	}
	else{
		if(time()-$_SESSION['otpverbtn']>120)
	    {
		$delsucc = mysqli_query($connection,"DELETE FROM users3 WHERE uid='$var'");
		if(delsucc)
		{
			echo "<script>alert('Time Exceeded');</script>";
			echo "<script> location.href='logout.php'</script>";
		}	
	    }
		else
		{
			$delsucc = mysqli_query($connection,"DELETE FROM users3 WHERE uid='$var'");
			echo "<script>alert('Your Answer is Incorrect , so you have been terminated');</script>";
			echo "<script> location.href='logout.php'</script>";
		}
	}
}
}
?>
</body>
</html>