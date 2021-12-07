<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head> <title> Voting Panel </title>
<style>
body
{
	background-color:black;
}
input,label{
	font-size:25px;
}
label,h1,h2,h3{
	color:white;
}
div{
  width:40%;
  text-align:center;
  margin-left: auto;
  margin-right: auto;
  margin-top:10%;
}
section
{
	border:2px solid white;
}
</style>
</head>
<body>
<?php
if(!isset($_SESSION['name']))
{
	echo "<script> location.href='index.php'</script>";
}
else
{
	$votername=$_SESSION['username'];
	$voterid=$_SESSION['name'];
	$connection=mysqli_connect("localhost","root","","kavi");
     if(!$connection)
     {
		die("database connection error".mysql_error());
	 }
	 else
	{
		//echo "Connected Successfully";
	?>
	<div>
     <section><h1> The Nominees for this Election are <h1>
	 <h2>1. Kavin </h2>
     <h2>2. Suresh </h2>	 </section>
  <h3>Please select your Option that whom you are going to Vote :</h3><br>
  <form method="post">
  <input type="radio" id="kavin" name="voteop" value="kavin">
  <label for="kavin">kavin</label><br><br>
  <input type="radio" id="Suresh" name="voteop" value="Suresh">
  <label for="Suresh">Suresh</label><br><br>
  <input type="radio" id="other" name="voteop" value="other">
  <label for="other">Other</label><br><br>
  <br>  
  <input type="submit" name="votesub">
  </form>
  </div>
   <?php
    if(isset($_POST['votesub']))
	{	
	$voteroption=$_POST['voteop'];
	$checkvote=mysqli_query($connection,"select * from votertab where voterid='$voterid'");
	$count=mysqli_num_rows($checkvote);
	if($count>0)
	{
		echo "<script> alert('voted already');</script>voted already";
		echo "<script> location.href='logout.php'</script>";
	}
	else{
	
	/*$quevote=mysqli_query($connection,"INSERT INTO 'votertab`(`votername`, `voterid`, `votedfor`) VALUES ('sona','$voterid','$voteroption')");	
    if($quevote)
	{
		echo "<script> alert('Hey you voted')</script>";
	}
	else{
		echo "<script> alert('Hey Noooooo')</script>";
	}*/
	
	//====== Voting details updated in database
	
	$sql = "INSERT INTO votertab (votername,voterid,votedfor)VALUES ('$votername', '$voterid', '$voteroption')";

    if ($connection->query($sql) === TRUE)
	  {
      echo "<script> alert('Hey You voted successfully')</script>";
	  echo "<script> location.href='logout.php'</script>";
      } 
	else
	  {
      echo "Error: " . $sql . "<br>" . $connection->error;
      }
    $connection->close();
	//======
	}
}
}
}
?>
</body>
</html>
