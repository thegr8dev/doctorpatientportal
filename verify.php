<?php
 session_start();
 include('includes/conn.php');
	if(!isset($_SESSION['useremail'])){
		echo "Access denied";
	}
else{
	if(isset($_GET['did'])){
	$id = $_GET['did'];
	$t= $_SESSION['useremail'];
	$q = "SELECT * FROM admin where email='$t'";
	$r = mysqli_query($con,$q);
	while($row = mysqli_fetch_assoc($r)){
		
		$type=$row['type'];
		
	}
	if(@$type=="admin"){
	$qry = "UPDATE doctor SET status='success' WHERE did='$id'";
	mysqli_query($con,$qry);
	header("location: adminpanel.php#verify");
}else{
	echo "Access Denied";
}
}
}
?>