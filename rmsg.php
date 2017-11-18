<?php
session_start();
include('includes/conn.php');
if(!isset($_SESSION['useremail'])){
	echo "Access Denied";
}
else{
	if(isset($_POST['reply'])){
		$sid   = $_POST['getsid'];
		$recid = $_POST['getrid'];
		$resub = $_POST['resub'];
		$msg   = $_POST['msg'];
		$msgid = $_POST['getmid'];
		$status = "unread";
		
		$status2 = "read";
		
		$dt = date('Y-m-d');
		$tm = date('H:i');
		
		$q2 = "UPDATE sentmsg set status ='$status2' where mid = '$msgid' ";
		mysqli_query($con,$q2);
			
		
		
		
		
		$q = "INSERT INTO rmsg VALUES ('','$recid','$sid','$resub','$msg','$status','$dt','$tm');";
		if($r = mysqli_query($con,$q)){
			echo '<script>';
			echo 'alert("Replay Sent");';
			echo 'window.location.href="doctor.php"';
			echo '</script>';
		}else{
			echo '<script>';
			echo 'alert("Replay Not Sent");';
			echo 'window.location.href="doctor.php"';
			echo '</script>';
		}
		
		
		
	}else{
		echo "Invalid Action";
	}
}
?>