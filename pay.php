<!--secure payment page modal-->
<?php
session_start();
if(!isset($_SESSION['useremail'])){
	echo "Access Denied";
}else{
$user = $_SESSION['useremail'];
include('includes/conn.php');
$payid = $_GET['payid'];
$qry = "SELECT  * FROM appointments where id='$payid'";
$res = mysqli_query($con,$qry);
while($data = mysqli_fetch_assoc($res)){
	$patid = $data['pat_id'];
	$tid = $data['tid'];
}

$qry2 = "select * from patient where email = '$user' ";
$res2 = mysqli_query($con,$qry2);

while($data2 = mysqli_fetch_assoc($res2)){
	$ses_pat = $data2['pid'];
	$ses_eml = $data2['email'];
}

if($patid == $ses_pat ){
	
	if($tid != ""){
		echo "Already Paid";
	}
else{
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Pay for Appointment</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
  <br>
    <div style="width:30%;" class="container well">
	<h4 align="center" style="font-family;calibri;"><img width="80px" src="img/mc.png"/>Secure Pay</h4><br>
	<form method="POST" action="payprocess.php">
	<input type="hidden" name="getid" value="<?php echo $payid;?>"/>
	<input type="text" class="form-control" name="cno" required placeholder="Enter card No." maxlength="16"/><br>
	<input type="password" class="form-control" name="pin" required placeholder="Enter PIN" maxlength="4"/><br>
	<input type="text" disabled class="form-control" value="<?php echo $ses_eml;?>"/><br>
	<input type="text" disabled class="form-control" value="Rs. 100"/><br>
	<center><input type="submit" value="Pay" class="btn btn-success" name="pay" /></center><br>
	</form>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
<?php }}else{
	echo "<div class='alert alert-danger'><b>Access Denied</b></div>";
}	?>
<?php } ?>
