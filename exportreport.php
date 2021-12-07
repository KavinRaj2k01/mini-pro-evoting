<?php
session_start();
if(!isset($_SESSION['name']))
{
	echo "<script> location.href='voteresult.php'</script>";
}
else
{
$connection=mysqli_connect("localhost","root","","kavi");
    if(!$connection)
    {
		die("database connection error".mysql_error());
	}
	else
	{
		//echo "Connected Successfully";
		$result = mysqli_query($connection,"SELECT * FROM votertab");
		$html='<table><tr><th> VoterName </th><th> VoterID </th><th> VotedFor </th></tr>';
	    while($row=mysqli_fetch_array($result))
        {
			$html.='<tr><td>'.$row['votername'].'</td><td>'.$row['voterid'].'</td><td>'.$row['votedfor'].'</td></tr>';
        }
		$html.='</table>';
		echo $html;
		header('Content-Type:application/xls');
		header('Content-Disposition:attachment;filename=report.xls');
	}
}

?>