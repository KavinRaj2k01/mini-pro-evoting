<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head> <title> Vote Result </title>
<link rel="stylesheet" href="stylecommon.css">
<style>
body{
	background-color:black;
}
section{
     box-shadow: 1px 2px 2px 2px white;  
     border-radius: 12px;
     background-image: linear-gradient(to right top, #00dbff, #88e1ff, #c3e7ff, #eaf1ff, #ffffff);

}
.votecount{
    background-image: linear-gradient(to right top, #6bd171, #70d578, #75d97e, #7add85, #7fe18b, #7be596, #78e9a1, #75edac, #6af1bf, #62f5d0, #5ef8e1, #5ffbf1);
}
div{
	background-image: linear-gradient(to right top, #6b78d1, #707fd5, #7586da, #7a8dde, #7f94e2, #75a0ec, #6aacf4, #60b8fb, #40cbff, #28dcff, #39ecfb, #5ffbf1);
	float:left;
	width:95%;
	height:85px;
	margin-left:1%;
	margin-right:2%;
	margin-top:2%;
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
<table>
<form method="post">
<tr><td><input type="text" placeholder="Enter your Username" name="uname" id="un" required></td></tr>
   <tr><td><input type="password" placeholder="Enter Your Password" name="pwd" id="ps"required></td></tr>
   <tr><td><input type="submit" name="submit" id="sb"></td></tr>
 </form>
 </table>

<?php
if(isset($_POST['submit']))
{
$connection=mysqli_connect("localhost","root","","kavi");
     if(!$connection)
     {
		die("database connection error".mysql_error());
	 }
	 else
	{
		//echo "Connected Successfully";
	$una=$_POST['uname'];
	$pswd=$_POST['pwd'];
	$checkque=mysqli_query($connection,"select * from users3 where password='$pswd' and username='$una'");
	$count=mysqli_num_rows($checkque);
	if($count>0)
	{
	echo "<script> document.getElementById('un').style.display='none';  </script>";	
	echo "<script> document.getElementById('ps').style.display='none';  </script>";	
	echo "<script> document.getElementById('sb').style.display='none';  </script>";	
	//echo "Login success";
	$_SESSION['name']=$_POST['uname'];
	$result = mysqli_query($connection,"SELECT COUNT(voterid) FROM votertab where votedfor='suresh';");
	while($row=mysqli_fetch_array($result))
    {
    $onma=$row[0];
    }
	$result2 = mysqli_query($connection,"SELECT COUNT(voterid) FROM votertab where votedfor='kavin';");
	while($row=mysqli_fetch_array($result2))
    {
    $onma2=$row[0];
    }
	$result3 = mysqli_query($connection,"SELECT COUNT(voterid) FROM votertab where votedfor='other';");
	while($row=mysqli_fetch_array($result3))
    {
    $onma3=$row[0];
    }
	$result4 = mysqli_query($connection,"SELECT COUNT(uid) FROM users3;");
	while($row=mysqli_fetch_array($result4))
    {
    $onma4=$row[0];
    }
	//-----
    //----- Total number of Users 
	$result6 = mysqli_query($connection,"SELECT COUNT(usid) FROM admin3;");
	while($row=mysqli_fetch_array($result6))
    {
    $onma6=$row[0];
    }
	//-----
	//----- Total number of voters Voted till now
	$result5 = mysqli_query($connection,"SELECT COUNT(voterid) FROM votertab;");
	while($row=mysqli_fetch_array($result5))
    {
    $onma5=$row[0];
    }
	//----	
	// Voters remaining to vote
	//echo " Number of voters Crossed the Voting rules  --  :".(20-$onma6);
	}
	else
	{
		echo "<script> alert('Wrong Password')</script>";
		echo "<script> location.href='voteresult.php'</script>";
	}
	}
?>
<div style="margin-top:2%;margin-bottom:2%;"><section class="lead" style="float:right;"> Admin </section> </div>

<section style="background-color:red; width:30%; height:100px; float:left; margin:1%;text-align:center;">
<h2>  Total Number of Voters :  <?php echo $onma6;  ?> </h2>
</section>
<section style="background-color:green; width:30%; height:100px; float:left; margin:1%; text-align:center;">
<h2>  Total Number of Voters Eligible still now:  <?php echo (($onma4-1)-$onma5);  ?> </h2>
</section>
<section style="background-color:red; width:30%; height:100px; float:left; margin:1%; text-align:center;">
<h2>  Total number of voters voted till now:  <?php echo $onma5; ?> </h2>
</section>
<!--<section style="background-color:red; width:47%; height:100px; float:left; margin:1%; text-align:center;">
<h2>  Number of Voters crossed Voting rules:  <?php //echo (20-$onma6); ?> </h2>
</section>-->
<section style="background-color:red; width:94%; height:100px; float:left; margin:1%; text-align:center;">
<h2>  Number of Voters Remaining to Vote:  <?php echo (($onma4-1) - $onma5); ?> </h2>
</section>

<section class="votecount" style="background-color:red; width:30%; height:100px; float:left; margin:1%; text-align:center;">
<h2>  Total number of votes Got By Kavin:  <?php echo $onma2; ?> </h2>
</section>
<section class="votecount" style="background-color:red; width:30%; height:100px; float:left; margin:1%; text-align:center;">
<h2>  Total number of votes Got By Suresh:  <?php echo $onma; ?> </h2>
</section>
<section class="votecount" style="background-color:red; width:30%; height:100px; float:left; margin:1%; text-align:center;">
<h2>  Total number of votes Got By Nota:  <?php echo $onma3; ?> </h2>
</section>
<a href="exportreport.php" style="margin-left:1%; "><button style="height:30px; margin-top:1%;"> Click here to download the report </button></a>
<div> <marquee><section class="lead"> <?php 
   if(($onma==$onma2)&&($onma==$onma3))
   {
	 echo "All are equal";
   }
   elseif(($onma>$onma2)&&($onma>$onma3))
   {
	echo " Leading : Suresh   --  ".$onma;
   }
   elseif($onma2>$onma3)
   {
	if(($onma==$onma2)&&($onma2>$onma3))
   {
	   echo "Got Equal Votes : Suresh == Kavin";
   }
   else{
	   echo " Leading : Kavin  --  ".$onma2;
   }
   }
   elseif($onma2<$onma3){
	if($onma==$onma3)
   {
	   echo "Got Equal Votes : Suresh == Nota";
   }   
   else{   
	echo " Leading : Nota  -- ".$onma3;
   }
   }
   else
   {
	  echo "Got Equal Votes : Kavin == Nota";
   } 
?> </section></marquee></div>
   
<?php }?>
</body>
</html>
