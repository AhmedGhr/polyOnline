<?php
include('includes/connect.php');
echo("hello");
 if(isset($_POST['opp']))
 {
	 echo("hi");
 	$sup=$_POST['opp'];
 		foreach ($sup as $key => $value) {
 		$sql="DELETE FROM `etudiant` WHERE id={$value}";
 		mysqli_query($connect,$sql);
 		header('location: indexx.php');
 	}
 }
 else
 {
 	echo("problem");
 }
 
$connect->close();
?>