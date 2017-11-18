<?php
include('includes/conn.php');
if(isset($_POST['feed'])){
	$pid = $_POST['pid'];
	$did = $_POST['did'];
	$feed = $_POST['postfeed'];
	$dt = date('Y-m-d');
	
	$q = "INSERT INTO feedback values('','$pid','$did','$feed','$dt')";
	if($r = mysqli_query($con,$q)){
		echo '<script>';
		echo 'alert("Thanks for feedback");';
		echo 'window.location.href="doclist.php" ';
		echo '</script>';
	}
}else{
	echo "Invalid Action";
}
?>