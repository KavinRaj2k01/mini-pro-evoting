<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head> <title> Send OTP </title>
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
else
{?>
<link rel="stylesheet" href="stylecommon.css">
<div style="margin-top:2%;margin-bottom:2%;"><section class="lead" style="float:right;"> <?php echo $_SESSION['username'];?> </section> </div>
<table>
 <form method="post">
   <tr><td><h1> Click below to Send OTP </h1></td></tr>
   <tr><td><h3> You have to click Send OTP within 120 Seconds ,otherwise after that you won't be able to Vote</h3></td></tr>
   <tr><td><input type="submit" name="submit" value="Send OTP"> </input></td></tr>
 </form>
 </table>
<?php

if(isset($_POST["submit"]))
{
	$var=$_SESSION['name'];
	$usrname = $_SESSION['username'];
	$_SESSION['otpsendbtn']=time();
	$connection=mysqli_connect("localhost","root","","kavi");
	if(time()-$_SESSION['last_login_timestamp']>120)
	{
		if(!$connection)
		{
        die("database connection error".mysql_error());
        }
        else
        {
		$delsucc = mysqli_query($connection,"DELETE FROM users3 WHERE uid='$var'");
		if(delsucc)
		{
			echo "<script>alert('Time Exceeded You have been terminated');</script>";
			echo "<script> location.href='logout.php'</script>";
		}
			
	    }
    }
	else{
$randomnumber=rand(10000,99999);
if(!$connection)
{
die("database connection error".mysql_error());
}
else
{
	$queotp=mysqli_query($connection,"select email from admin3 where usid='$var'");
    while($row=mysqli_fetch_array($queotp))
    {
    $onma=$row['email'];
    }
    $sqlquery = "UPDATE admin3 SET otp='$randomnumber' where usid='$var'";
   if ($connection->query($sqlquery) === TRUE) {
   echo "Record updated successfully";
   }
   else {
   echo "Error updating record: " . $connection->error;
   }
$connection->close();
}  


require 'PHPMailerAutoload.php';
$mail = new PHPMailer();

$mail->SMTPDebug = 4;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.ethereal.email';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'deangelo.stark81@ethereal.email';                 // SMTP username
$mail->Password = '2DgGdatycrqRmZQzaS';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587; 
$mail->Timeout = 10;

// TCP port to connect to

$mail->setFrom('jobs8464@gmail.com', 'Mailer');
$mail->addAddress($onma, $usrname);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'One Time Password Verification';
$mail->Body    = 'This is the one time password : '.$randomnumber;
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
var_dump($mail);
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
	echo "<script> location.href='verifyotp.php'</script>";
}
}
}
}
?>
</body>
</html>
