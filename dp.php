<?php
#doctor register
if(isset($_POST['btn_doc'])){
	
$mydoc = $_FILES['file']['name'];
$type = $_FILES['file']['type'];
$temp = $_FILES['file']['tmp_name'];

$docpic = $_FILES['newpic']['name'];
$type1 = $_FILES['newpic']['type'];
$temp2 = $_FILES['newpic']['tmp_name'];

$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['password'];
$age = $_POST['age'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$docid = $_POST['docid'];
$adrid = $_POST['adrid'];
$cat = $_POST['doccat'];
$question = $_POST['psques'];
$answer = $_POST['answer'];

include('includes/conn.php');
$q = "SELECT * FROM doctor where email ='$email'";
$q2 = "SELECT * FROM patient where email ='$email'";
$q3 = "SELECT * FROM doctor where phone_number ='$phone'";
$q4 = "SELECT * FROM patient where phone ='$phone'";
$q5 = "SELECT * FROM doctor where docid ='$docid'";
$q6 = "SELECT * FROM doctor where adrid ='$adrid'";
$q7 = "SELECT * FROM patient where adharno ='$adrid'";

$r = mysqli_query($con,$q);
$r2 = mysqli_query($con,$q2);
$r3 = mysqli_query($con,$q3);
$r4 = mysqli_query($con,$q4);
$r5 = mysqli_query($con,$q5);
$r6 = mysqli_query($con,$q6);
$r7 = mysqli_query($con,$q7);

if($r->num_rows>0){
		echo '<script type="text/javascript">'; 
		echo 'alert("Email id is already registered");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
}
elseif($r2->num_rows>0){
		echo '<script type="text/javascript">'; 
		echo 'alert("Email id is already registered");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
}
elseif($r3->num_rows>0){
	echo '<script type="text/javascript">'; 
		echo 'alert("Mobile no is already registered");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
}
elseif($r4->num_rows>0){
		echo '<script type="text/javascript">'; 
		echo 'alert("Mobile no is already registered");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
}
elseif($r5->num_rows>0){
		echo '<script type="text/javascript">'; 
		echo 'alert("Doctor id is already registered");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
}
elseif($r6->num_rows>0){
		echo '<script type="text/javascript">'; 
		echo 'alert("Adhar no is already registered");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
}

else if($r7->num_rows>0){
		echo '<script type="text/javascript">'; 
		echo 'alert("Adhar no is already registered");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
}
else{
	
if(($type1=="image/jpeg") || ($type1=="image/jpg") || ($type1=="image/png")){
	if((strlen($phone)<10) || (strlen($phone)>10)){
		echo '<script type="text/javascript">'; 
		echo 'alert("Did you know mobile no have 10 digit?");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
	}
	elseif($age>120){
		echo '<script type="text/javascript">'; 
		echo 'alert("Invalid Age");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
	}
	elseif($cat == "Choose"){
		echo '<script type="text/javascript">'; 
		echo 'alert("Select a doctor category first!");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
	}elseif($question == "Choose a security question"){
		echo '<script type="text/javascript">'; 
		echo 'alert("Select a security question first!");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
		}
		else{
	
	if(($type == "application/pdf")){
		$location2 = "./verify/$docid/docs/";
		$status = "fail";
		$type = "doc";
		
		$q = "insert into doctor values('', '$name', '$email', '$pass', '$age', '$phone', '$status', '$type', '$address', '$gender', '$docid', '$adrid', '$cat','$location2','', '$question', '$answer')";
		if($t = mysqli_query($con, $q)){
		$location = "./doctor/$docid/img/";
		mkdir($location, 0777, true);
		move_uploaded_file($temp2, "doctor/$docid/img/$docpic");
		
		
		mkdir($location2, 0777, true);
		move_uploaded_file($temp, "verify/$docid/docs/$mydoc");
		
		
		
		echo '<script type="text/javascript">'; 
		echo 'alert("Doctor Registration successfully");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
	}}

}}
else{
	echo '<script type="text/javascript">'; 
		echo 'alert("Doctor Registration Failed..");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';	
}
}
}
#php script end here-->	
?>
<?php 
#register for patient script
if(isset($_POST['btn_pat'])){
	
$mypic = $_FILES['pupload']['name'];
$type = $_FILES['pupload']['type'];
$temp = $_FILES['pupload']['tmp_name'];

$name = $_POST['pname'];
$email = $_POST['pemail'];
$pass = $_POST['p_password'];
$age = $_POST['p_age'];
$address = $_POST['paddress'];
$gender = $_POST['pgender'];
$phone = $_POST['p_phone'];
$adrpt = $_POST['adridpt'];
$question = $_POST['sques'];
$answer = $_POST['answer'];

include('includes/conn.php');
$q = "SELECT * FROM doctor where email ='$email'";
$q2 = "SELECT * FROM patient where email ='$email'";
$q3 = "SELECT * FROM doctor where phone_number ='$phone'";
$q4 = "SELECT * FROM patient where phone ='$phone'";
$q5 = "SELECT * FROM patient where adharno ='$adrpt'";
$q6 = "SELECT * FROM doctor where adrid ='$adrpt'";
$r = mysqli_query($con,$q);
$r2 = mysqli_query($con,$q2);
$r3 = mysqli_query($con,$q4);
$r4 = mysqli_query($con,$q3);
$r5 = mysqli_query($con,$q5);
$r6 = mysqli_query($con,$q6);
if($r->num_rows>0){
		echo '<script type="text/javascript">'; 
		echo 'alert("Email id is already registered");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
}
elseif($r2->num_rows>0){
		echo '<script type="text/javascript">'; 
		echo 'alert("Email id is already registered");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
}
if($r4->num_rows>0){
	echo '<script type="text/javascript">'; 
		echo 'alert("Mobile no is already registered");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
}
elseif($r3->num_rows>0){
		echo '<script type="text/javascript">'; 
		echo 'alert("Mobile no is already registered");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
}
if($r5->num_rows>0){
	echo '<script type="text/javascript">'; 
		echo 'alert("Adhar no is already registered");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
}
elseif($r6->num_rows>0){
		echo '<script type="text/javascript">'; 
		echo 'alert("Adhar no is already registered");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
}

else{
	if(($type=="image/jpeg") || ($type=="image/jpg") || ($type=="image/png")){
	if((strlen($phone)<10) || (strlen($phone)>10)){
		echo '<script type="text/javascript">'; 
		echo 'alert("Did you know mobile no have 10 digit?");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
	}
	elseif($age>120){
		echo '<script type="text/javascript">'; 
		echo 'alert("Invalid age");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
	}elseif($question == "Choose a security question")
	{
		echo '<script type="text/javascript">'; 
		echo 'alert("Choose a security question !");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
	}
	else{
	$location = "./patient/$adrpt/img/";
	
	$type = "pat";
	$q2 = "insert into patient values('', '$name', '$email', '$pass', '$age' , '$phone', '$type', '$address', '$gender', '$location', '$adrpt', '$question', '$answer')";
	if(mysqli_query($con, $q2)){
		mkdir($location, 0777, true);
	    move_uploaded_file($temp, "patient/$adrpt/img/$mypic");
		
		echo '<script type="text/javascript">'; 
		echo 'alert("Patient Registration successfully");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
	}}
}elseif(($type!="image/jpeg") || ($type!="image/jpg") || ($type!="image/png")){
	echo '<script type="text/javascript">'; 
		echo 'alert("Invalid Image");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
}
else{
		echo '<script type="text/javascript">'; 
		echo 'alert("Registration failed..");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
}
}
}
#patient script end here
?>
