<?php
session_start();
if(!isset($_SESSION['useremail'])){
	echo "<div align='center' style='font-family : calibri; color:white; background:#D20D0D; padding:15px;'>Access Denied</div>";
}
else{
include('includes/conn.php');
$q = "SELECT * FROM patient WHERE email ='".$_SESSION['useremail']."'";
$r = mysqli_query($con,$q);
while($row = mysqli_fetch_assoc($r)){
	$type = $row['type'];
}

if(@$type=="pat"){
	echo "<div align='center' style='font-family : calibri; color:white; background:#D20D0D; padding:15px;'>Access Denied</div>";
}
else{
$email = $_SESSION['useremail'];
$mypic = $_FILES['newupload']['name'];
$type = $_FILES['newupload']['type'];
$temp = $_FILES['newupload']['tmp_name'];

include('includes/conn.php');
$query = "SELECT * FROM doctor WHERE email ='".$email."'";
$rec = mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($rec)){
	$docid = $row['docid'];
}


if(($type=="image/jpeg") || ($type=="image/jpg") || ($type=="image/png")){
	$dir = "doctor/".$docid."/img";
	$files = 0;
	$handle = opendir($dir);
		while(($file = readdir($handle))!=FALSE){
			if($file!="."&&$file!=".."&&$file !="Thumbs.db"){
				unlink($dir."/".$file);
				$files++;
			}
		}
		closedir($handle);
		sleep(1); 
		move_uploaded_file($temp,"doctor/$docid/img/$mypic");
		echo '<script type="text/javascript">'; 
	echo 'alert("Your Profile Picture has been updated successfully");'; 
	echo 'window.location.href = "doctor.php#profile";';
	echo '</script>';
}else{
	echo "Invalid Image";
}
}
}
?>