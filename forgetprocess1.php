 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Answer the security question</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

  </head>
<body>
<?php
if(isset($_POST['btn_forget'])){
	$email = $_POST['femail'];
	include('includes/conn.php');
	$q = "SELECT * FROM doctor where email = '$email' ";
	$qq = "SELECT * FROM patient where email = '$email' ";
	$r = mysqli_query($con,$q);
	$rr = mysqli_query($con,$qq);
	
	if($r->num_rows>0){
		while($row = mysqli_fetch_assoc($r)){
			
			?>
			<br>
			<div class="container">
			<center>
			<div style="font-family:calibri; font-size:14px; width:60%;" class="panel panel-default">

			<div class="panel-body">
			Hi !<b> <?php echo $row['name'];?></b> in order to reset your password answer this security question that you set on the time of registration.
			<hr style="margin-top:1%;border-color:darkgrey;">
				<?php
		$dir = "doctor/".$row['docid']."/img/";
		$open = opendir($dir);

		while(($files = readdir($open)) != FALSE){
		if($files!="."&&$files!=".."&&$files !="Thumbs.db"){
		echo "<center>
		<img style=border-radius:6em;' width='60' height='60' src='$dir/$files'></center>";
		}
	
	
		}
	?>
	<br>
	<form action="forgetprocess2.php" method="POST">
	<input type="text" disabled class="form-control" value="<?php echo $row['squestion'];?>">
	<input type="hidden" class="form-control" name="getques" value="<?php echo $row['squestion'];?>">
	<input type="hidden" class="form-control" name="getdemail" value="<?php echo $row['email'];?>">
	<br>
	<input type="text" class="form-control" placeholder="Enter your answer" name="getans" value=""/>
	<br>
	<input type="submit" name="btn_sub" class="btn btn-primary" value="Submit"/>
	</form>
			</div>
			</div>
			</center>
			</div>
			<?php
			
		}
	}
	elseif($rr->num_rows>0){
		
		while($row = mysqli_fetch_assoc($rr)){
			
			?>
			<br>
			<div class="container">
			<center>
			<div style="font-family:calibri; font-size:14px; width:60%;" class="panel panel-default">

			<div class="panel-body">
			Hi !<b> <?php echo $row['name'];?></b> in order to reset your password answer this security question that you set on the time of registration.
			<hr style="margin-top:1%;border-color:darkgrey;">
				<?php
		$dir = "patient/".$row['adharno']."/img/";
		$open = opendir($dir);

		while(($files = readdir($open)) != FALSE){
		if($files!="."&&$files!=".."&&$files !="Thumbs.db"){
		echo "<center>
		<img style=border-radius:6em;' width='60' height='60' src='$dir/$files'></center>";
		}
	
	
		}
	?>
	<br>
	<form action="forgetprocess2.php" id="form1" method="POST">
	<input type="text" disabled class="form-control" value="<?php echo $row['question'];?>">
	<input type="hidden" class="form-control" name="getques" value="<?php echo $row['question'];?>">
	<input type="hidden" class="form-control" name="getdemail" value="<?php echo $row['email'];?>">
	<br>
	<input type="text" class="form-control" placeholder="Enter your answer" required name="getans" value=""/>
	<br>
	<input type="submit" name="btn_psub" class="btn btn-primary" value="Submit"/>
	</form>
			</div>
			</div>
			</center>
			</div>
			<?php
			
		}
		
	}
	else{
		echo '<script type="text/javascript">'; 
		echo 'alert("No Account found");'; 
		echo 'window.location.href = "forgetpass.php";';
		echo '</script>';
	}
	
}else{
	echo "<div align='center' class='alert alert-danger'>Invalid Action</div>";
}
?>
</body>
<script>
function rsett(){
    document.getElementById("form1").reset();
	}
</script>
</html>