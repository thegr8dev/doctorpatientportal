<?php
 session_start();
 include('includes/conn.php');
	if(!isset($_SESSION['useremail'])){
		echo "Access denied";
	}
else{
	$t= $_SESSION['useremail'];
	$q = "SELECT * FROM doctor where email='$t'";
	$r = mysqli_query($con,$q);
	while($row = mysqli_fetch_assoc($r)){
		
		$type=$row['type'];
		
	}
	if(@$type=="doc"){
	$id = $_GET['aid'];
	$qry = "UPDATE appointments set status='Completed' where id='$id'";
	mysqli_query($con,$qry);
	header("location: doctor.php#viewap");
}else{
	echo "Access Denied";
}

}
?>
