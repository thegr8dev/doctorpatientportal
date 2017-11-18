<?php
if(isset($_POST['btn_up'])){
	
	@$email = $_REQUEST['getdocemail'];
	$newpass = $_POST['newpass'];
	$cnfpass = $_POST['cnfpass'];
	
	if($newpass == $cnfpass){
		include('includes/conn.php');
		$q = "UPDATE doctor set password='$newpass' where email='$email'";
		if($r = mysqli_query($con,$q)){
		echo '<script type="text/javascript">'; 
		echo 'alert("Your password has been reset");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
		}
	}else{
		echo "Password Not match Go Back and type correct password";
	}
	
	
	
}
elseif(isset($_POST['btn_pp'])){
	
	$email = $_REQUEST['getpemail'];
	$newpass = $_POST['newpass'];
	$cnfpass = $_POST['cnfpass'];
	
	if($newpass == $cnfpass){
		include('includes/conn.php');
		$q = "UPDATE patient set password='$newpass' where email='$email'";
		if($r = mysqli_query($con,$q)){
		echo '<script type="text/javascript">'; 
		echo 'alert("Your password has been reset");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
		}
	}else{
		echo "Password Not match Go Back and type correct password";
	}	
	
}else{
	echo "Invalid Action";
}
?>