
<?php
session_start();
if(!isset($_SESSION['useremail'])){
echo "<div align='center' style='font-family : calibri; color:white; background:#D20D0D; padding:15px;'>Access denied ! </div>";
}else{
if(isset($_POST['sub'])){
	$pid     = 	$_POST['getpid'];
	$did     = 	$_POST['getdid'] ;
	$pname   = 	$_POST['pname'];
	$pmob    =  $_POST['pmob'];
	$age     = 	$_POST['age'];
	$problem = 	$_POST['problem'];
	$date    = 	$_POST['date'];
	$time    = 	$_POST['time'];
	
	$rname = $_FILES['pre_report']['name'];
	$type  = $_FILES['pre_report']['type'];
	$temp  = $_FILES['pre_report']['tmp_name'];
	
	$status  =  "pending";
	
if((strlen($pmob)<10) || (strlen($pmob)>10)){
	echo '<script type="text/javascript">'; 
	echo 'alert("Enter 10 Digit valid mobile no");'; 
	echo '</script>';
}
elseif(strlen($age>120) || strlen($age<1)){
	echo '<script type="text/javascript">'; 
	echo 'alert("Invalid age");'; 
	echo '</script>';
}else{
	include('includes/conn.php');
	$qry = "SELECT * FROM appointments WHERE doc_id='$did' AND a_time='$time' AND a_date='$date' AND status='pending' " ;
	$res = mysqli_query($con,$qry);
	
	$qrt = "SELECT * FROM appointments WHERE '$date'=CURRENT_DATE AND '$time'<CURRENT_TIME";
	$rt = mysqli_query($con,$qrt);

if($res->num_rows>0){
	echo '<script type="text/javascript">'; 
	echo 'alert("Appointment Already Booked");'; 
	echo 'window.location.href = "doclist.php";';
	echo '</script>';
}elseif(date('Y-m-d') == date('Y-m-d', strtotime($date)) && $time<date('H') ){
	echo '<script type="text/javascript">'; 
	echo 'alert("Time is passed you are late");'; 
	echo 'window.location.href = "doclist.php";';
	echo '</script>';
}
else{
	if(($rname !="" && $type == "application/pdf")){
	$location = "./patient/reports/$pid";
	$q = "INSERT into appointments values('','$pname','$pmob','$age','$date','$time','$problem','$did','$pid','$status','$location/$rname','')";
	if($r = mysqli_query($con,$q)){
		mkdir($location, 0777, true);
		move_uploaded_file($temp, "patient/reports/$pid/$rname");
		echo '<script type="text/javascript">'; 
		echo 'alert("Redirecting you to payment page");'; 
		echo 'window.location.href = "patient.php#viewap";';
		echo '</script>';
	}
	}
	elseif($rname ==""){
	$location = "./patient/reports/$pid";
	$q = "INSERT into appointments values('','$pname','$pmob','$age','$date','$time','$problem','$did','$pid','$status','','')";
	if($r = mysqli_query($con,$q)){
		echo '<script type="text/javascript">'; 
		echo 'alert("Redirecting you to payment page");'; 
		echo 'window.location.href = "patient.php#viewap";';
		echo '</script>';
	}
	}else{
		echo '<script type="text/javascript">'; 
		echo 'alert("Not Done...");'; 
		echo 'window.location.href = "doclist.php';
		echo '</script>';
	}
}
}

	
}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}


?>