<?php
if(isset($_POST['sub_app'])){
$pid = $_POST['pid'];
$pname = $_POST['name'];
$phone = $_POST['phone'];
$page = $_POST['age'];
$adate = $_POST['date'];
$atime = $_POST['time'];
$prob = $_POST['problem'];
$doclist = $_POST['doccat'];
@$docid = $_POST['docho'];

$rname = $_FILES['pre_report']['name'];
$type  = $_FILES['pre_report']['type'];
$temp  = $_FILES['pre_report']['tmp_name'];

if($doclist && $docid !="" ){
if((strlen($phone)<10) || (strlen($phone)>10)){
	echo '<script type="text/javascript">'; 
	echo 'alert("Enter 10 Digit valid mobile no");'; 
	echo 'window.location.href = "patient.php#makeap";';
	echo '</script>';
}
elseif(strlen($page>120)){
	echo '<script type="text/javascript">'; 
	echo 'alert("Invalid age");'; 
	echo 'window.location.href = "patient.php#makeap";';
	echo '</script>';
}else{	
include('includes/conn.php');
$status = "pending";

$qry = "SELECT * FROM appointments WHERE doc_id='$docid' AND a_time='$atime' AND a_date='$adate' AND status='pending' " ;
$res = mysqli_query($con,$qry);

$qrt = "SELECT * FROM appointments WHERE '$adate'=CURRENT_DATE AND '$atime'<CURRENT_TIME ";
$rt = mysqli_query($con,$qrt);



if(mysqli_num_rows($res)>0){
	echo '<script type="text/javascript">'; 
	echo 'alert("Appointment Already Booked");'; 
	echo 'window.location.href = "patient.php#makeap";';
	echo '</script>';
}elseif(date('Y-m-d') == date('Y-m-d', strtotime($adate)) && $atime<=date('H:i') ){
	
	echo '<script type="text/javascript">'; 
	echo 'alert("Check the time its already gone....");'; 
	echo 'window.location.href = "patient.php#makeap";';
	echo '</script>';
	
}
else{
if(($rname !="" && $type == "application/pdf")){
$location = "./patient/reports/$pid";
$q = "INSERT INTO appointments values ('','$pname','$phone','$page','$adate','$atime','$prob','$docid','$pid','$status','$location/$rname','')";
if($r = mysqli_query($con,$q)){
	mkdir($location, 0777, true);
    move_uploaded_file($temp, "patient/reports/$pid/$rname");
	echo '<script type="text/javascript">'; 
	echo 'alert("Redirecting you to payment page Done...");'; 
	echo 'window.location.href = "patient.php";';
	echo '</script>';
}
}elseif($rname =="" ){
$q = "INSERT INTO appointments values ('','$pname','$phone','$page','$adate','$atime','$prob','$docid','$pid','$status','','')";
if($r = mysqli_query($con,$q)){
	echo '<script type="text/javascript">'; 
	echo 'alert("Redirecting you to payment page Done...");'; 
	echo 'window.location.href = "patient.php";';
	echo '</script>';
}
}
else{
	echo "Not Submitted";
}
}
}
}else{
	echo '<script type="text/javascript">'; 
	echo 'alert("Choose a doctor category or you did not select doctor");'; 
	echo 'window.location.href = "patient.php#makeap";';
	echo '</script>';
}

}



?>