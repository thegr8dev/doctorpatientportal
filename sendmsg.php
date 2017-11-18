<?php
session_start();
if(!isset($_SESSION['useremail'])){
	echo "Access Denied";
}else{
if(isset($_POST['submit'])){
	
	$sender = $_POST['senderid'];
	$r = $_POST['doccat2'];
	@$to = $_POST['docho2'];
	$subject = $_POST['sub'];
	$msg  = $_POST['msg'];
	$dt = date('Y-m-d');
	$tm = date('H:i');
	if($r == "Choose" || $tm == "Choose"){
		echo '<script>';
		echo 'alert("Oh ! You forget to select doctor");';
		echo 'window.location.href="patient.php" ';
		echo '</script>';
	}else{
	include('includes/conn.php');
	$status = "unread";
	$q = "INSERT INTO sentmsg VALUES ('','$sender','$to','$subject','$msg','$status','$dt','$tm');";
	$r = mysqli_query($con,$q);
	
	if($r = true){
		echo '<script>';
		echo 'alert("Message Sent Successfully");';
		echo 'window.location.href="patient.php" ';
		echo '</script>';
	}else{
		echo '<script>';
		echo 'alert("Message Not Sent");';
		echo 'window.location.href="patient.php" ';
		echo '</script>';
	}
	}
}else{
	echo "Invalid Action";
}
}
?>