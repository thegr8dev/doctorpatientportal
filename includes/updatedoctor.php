<?php
if(!isset($_SESSION['useremail'])){
	echo "Access Denied !";
}else{
if(isset($_POST['btn_edit']))	{
$id = $_REQUEST['id'];
$newname = $_REQUEST['newname'];
$newemail = $_REQUEST['newemail'];
$newadd = $_REQUEST['newadd'];
$newage = $_REQUEST['newage'];
$newph = $_REQUEST['newphone'];
$newpass = $_REQUEST['newpass'];


mysql_connect("localhost", "root", "") or die ("No connection");

mysql_select_db("dpp");
$q1 = "SELECT * FROM patient where email='$newemail'";
$q2 = "SELECT * FROM doctor where email='$newemail'";
$q3 = "SELECT * FROM doctor where phone_number ='$newph'";
$q4 = "SELECT * FROM patient where phone ='$newph'";

$r1 = mysqli_query($con,$q1);
$r2 = mysqli_query($con,$q2);
$r3 = mysqli_query($con,$q3);
$r4 = mysqli_query($con,$q4);


if($newemail != "" ){
if($r1->num_rows>0){
print "<script>";
print "alert('Email ID is already register')";
print "</script>";
}
elseif($r2->num_rows>0){
	print "<script>";
	print "alert('Email ID is already register')";
	print "</script>";
}
	else{
	mysql_query("UPDATE doctor SET email='$newemail' WHERE did='$id'");
	echo '<script type="text/javascript">'; 
	echo 'alert("You Update your email address hence you need to login again");'; 
	echo 'window.location.href = "logout.php";';
	echo '</script>';
	}
}

if($newph != "" ){
if($r3->num_rows>0){
print "<script>";
print "alert('Phone No is already register')";
print "</script>";
}
elseif($r4->num_rows>0){
	print "<script>";
	print "alert('Phone No is already register')";
	print "</script>";
}
	else{
	if((strlen($newph)<10) || (strlen($newph)>10)){
	echo '<script type="text/javascript">'; 
	echo 'alert("Mobile no only have 10 digit");'; 
	echo 'window.location.href = "doctor.php";';
	echo '</script>';
	}else{
	mysql_query("UPDATE doctor SET phone_number='$newph' WHERE did='$id'");
	echo '<script type="text/javascript">'; 
	echo 'alert("Your Profile Updated Successfully");'; 
	echo 'window.location.href = "doctor.php";';
	echo '</script>';
	}
	}
}

if($newname != "" ){
	mysql_query("UPDATE doctor SET name='$newname' WHERE did='$id'");
	echo '<script type="text/javascript">'; 
	echo 'alert("Your Profile Updated Successfully");'; 
	echo 'window.location.href = "doctor.php";';
	echo '</script>';
}

if($newage != "" ){
	if($newage>120){
	echo '<script type="text/javascript">'; 
	echo 'alert("Invalid Age");'; 
	echo 'window.location.href = "doctor.php";';
	echo '</script>';
	}else{
	mysql_query("UPDATE doctor SET age='$newage' WHERE did='$id'");
	echo '<script type="text/javascript">'; 
	echo 'alert("Your Profile Updated Successfully");'; 
	echo 'window.location.href = "doctor.php";';
	echo '</script>';
}}
	
if($newadd != "" ){
	mysql_query("UPDATE doctor SET address='$newadd' WHERE did='$id'");
	echo '<script type="text/javascript">'; 
	echo 'alert("Your Profile Updated Successfully");'; 
	echo 'window.location.href = "doctor.php";';
	echo '</script>';
}


if($newpass != "" ){
	mysql_query("UPDATE doctor SET password='$newpass' WHERE did='$id'");
	echo '<script type="text/javascript">'; 
	echo 'alert("Your Profile Updated Successfully");'; 
	echo 'window.location.href = "doctor.php";';
	echo '</script>';
}


mysql_close();




}}
?>