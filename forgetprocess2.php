<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Reset your password</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
   
   <?php 
   if(isset($_POST['btn_sub'])){
	 
	$email = $_POST['getdemail'];
	$ques  = $_POST['getques'];
	$answer = $_POST['getans'];
	include('includes/conn.php');
	$q = "SELECT * FROM doctor where email = '$email' ";
	$r = mysqli_query($con,$q);
	
	while($row = mysqli_fetch_assoc($r)){
		$setques = $row['squestion'];
		$setanswer = $row['answer'];
	}
	   if($ques == $setques && $answer == $setanswer){
		  ?>
		  <div class="container">
		  <center>
		  <br>
		  <div style="font-family:calibri; font-size:14px; width:60%;" class="panel panel-default">
		  <div class="panel-body">
		  <div class="alert alert-success">
		  <b>You Successfully verified ! Reset the password below</b>
		  </div>
		  <form action="forgetprocess3.php" id="form1" method="POST">
		  <input type="hidden" value="<?php echo $email;?>" name="getdocemail">
		  <input type="password" name="newpass" placeholder="Enter new password" required class="form-control">
		  <br>
		  <input type="password" name="cnfpass" placeholder="Confirm new password" required class="form-control">
		  <br>
		  <input type="submit" name="btn_up" value="Reset Password" class="btn btn-primary"/>
		 <input type="button" value="Reset" onclick="rset()" class="btn btn-danger">
		  </form>
		  </div>
		  </div>
		  </center>
		  </div>
		  <?php
	   }else{
		   echo "<div align='center' class='alert alert-danger'>Sorry Wrong Answer</div>";
	   }
	   
   }elseif(isset($_POST['btn_psub'])){
	   
	$email = $_POST['getdemail'];
	$ques  = $_POST['getques'];
	$answer = $_POST['getans'];
	include('includes/conn.php');
	$q = "SELECT * FROM patient where email = '$email' ";
	$r = mysqli_query($con,$q);
	
	while($row = mysqli_fetch_assoc($r)){
		$setques = $row['question'];
		$setanswer = $row['answer'];
	}
	   if($ques == $setques && $answer == $setanswer){
		  ?>
		  <div class="container">
		  <center>
		  <br>
		  <div style="font-family:calibri; font-size:14px; width:60%;" class="panel panel-default">
		  <div class="panel-body">
		  <div class="alert alert-success">
		  <b>You Successfully verified ! Reset the password below</b>
		  </div>
		  <form action="forgetprocess3.php" id="form2" method="POST">
		  <input type="hidden" value="<?php echo $email;?>" name="getpemail">
		  <input type="password" name="newpass" placeholder="Enter new password" required class="form-control">
		  <br>
		  <input type="password" name="cnfpass" placeholder="Confirm new password" required class="form-control">
		  <br>
		  <input type="submit" name="btn_pp" value="Reset Password" class="btn btn-primary"/>
		 <input type="button" value="Reset" onclick="rsett()" class="btn btn-danger">
		  </form>
		  </div>
		  </div>
		  </center>
		  </div>
		  <?php
	   }else{
		   echo "<div align='center' class='alert alert-danger'>Sorry Wrong Answer</div>";
	   } 
	   
   }
   
   else{
	   echo "<div align='center' class='alert alert-danger'>Invalid Action</div>";
   }
   
   ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script>
	function rset(){
    document.getElementById("form1").reset();
	}
	
	function rsett(){
    document.getElementById("form2").reset();
	}
	
	</script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>