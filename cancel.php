<?php
 session_start();
 include('includes/conn.php');
	if(!isset($_SESSION['useremail'])){
		echo "Access denied";
	}
else{
	$t= $_SESSION['useremail'];
	$q = "SELECT * FROM patient where email='$t'";
	$r = mysqli_query($con,$q);
	while($row = mysqli_fetch_assoc($r)){
		
		$type=$row['type'];
		
	}
	if(@$type=="pat"){
	$id = $_GET['aid'];
	$qry = "UPDATE appointments set status='Canceled' where id='$id'";
	mysqli_query($con,$qry);
	header("location: patient.php#viewap");
}else{
	echo "Access Denied";
}

}
?>
