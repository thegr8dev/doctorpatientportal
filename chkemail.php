<?php
include('includes/conn.php');
$email =($_POST["email"]);
$q = "SELECT * FROM doctor WHERE email='$email' ";
$res = mysqli_query($con,$q);
$numrows = mysqli_num_rows($res);

if($numrows>0){
	echo "<font color='red'>Email is already register</font>";
}else{
	echo "<font color='green'>Email is available</font>";
}
?>