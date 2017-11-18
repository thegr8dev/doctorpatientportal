<?php
session_start();
if(!isset($_SESSION['useremail'])){
	echo "Access Denied";
}else{
	if(isset($_POST['pay'])){
	include('includes/conn.php');
	$cardnum = $_POST['cno'];
	$pin = $_POST['pin'];
	
	if((strlen($cardnum)<16) || (strlen($pin)<4) ){
		echo "Invalid Pin or card No. Go back and Correct";
	}elseif((strlen($cardnum)>16) || (strlen($pin)>4) ){
		echo "Invalid Pin or card No. Go back and Correct";
	}
	elseif((strlen($cardnum)==16) && (strlen($pin)==4) ){
		
		$getid = $_POST['getid'];
		function generateRandomString($length = 12) {
    $characters = '201725782593';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}
	$tid = generateRandomString();
	
	$q = "UPDATE appointments SET tid = '$tid' where id = '$getid' ";
	$r = mysqli_query($con,$q);
	
	if($r = true){
		echo '<script>';
		echo 'alert("Payment Successfull");';
		echo '</script>';
		echo '<br><img style="margin-top:-2%;float:left;" width="50px" src="img/loading.gif">Redirecting you to dashboard......';
		header("Refresh:2; url=patient.php");
	}else{
		echo "Payment fail";
		}
	}
		
	?>	
	
	
	
	<?php
	}else{
		echo "Invalid Action";
}
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>