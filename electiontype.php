<?php
session_start();
if(!isset($_SESSION['name']))
{
	echo "<script> location.href='index.php'</script>";
}
else{
$var=$_SESSION['name'];
?>
<h1> Choose the Type Of Election that You Going to Vote </h1>
<button onclick="vote.php"> Representative Election </button>
<button onclick="secretary.php"> Secretary Election </button>
<button onclick="chairman.php"> Chairman Election </button>
<?php
}
?>
