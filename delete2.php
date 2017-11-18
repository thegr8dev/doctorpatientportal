<?php
 session_start();
 include('includes/conn.php');
	if(!isset($_SESSION['useremail'])){
		echo "Access denied";
	}
else{
	$t= $_SESSION['useremail'];
	$q = "SELECT * FROM admin where email='$t'";
	$r = mysqli_query($con,$q);
	while($row = mysqli_fetch_assoc($r)){
		
		$type=$row['type'];
		
	}
	if(@$type=="admin"){
	$id = $_GET['pid'];
	$qry = "delete from patient where pid=$id";
	mysqli_query($con,$qry);
	header("location: adminpanel.php#delete");
}else{
	echo "Access Denied";
}

}
?>