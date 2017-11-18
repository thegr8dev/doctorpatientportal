<html>
<head>
<!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="js/jquery.datetimepicker.full.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	 <link rel="stylesheet" href="css/jquery.datetimepicker.css">
	 <style>
	 body{
		 background:red;
		
	 }
	 
	 </style>
</head>

<?php
session_start();
if(!isset($_SESSION['useremail'])){
	echo "<div align='center' style='font-family : calibri; color:white; background:#D20D0D; padding:15px;'>Access denied ! </div>";
}else{
	$t = $_SESSION['useremail'];
	include('includes/conn.php');
	$q = "SELECT * FROM patient where email='$t' ";
	$q2 = "SELECT * FROM doctor where email ='$t' ";
	$q3 = "SELECT * FROM admin where email ='$t' ";
	
	$r2 = mysqli_query($con,$q2);
	while($row = mysqli_fetch_assoc($r2)){
		$type = $row['type'];
	}
	
	$r3 = mysqli_query($con,$q3);
	while($row = mysqli_fetch_assoc($r3)){
		$type = $row['type'];
	}
	
	$r = mysqli_query($con,$q);
	while($row = mysqli_fetch_assoc($r))
	{	$pid =  $row['pid'];
		$pnam = $row['name'];
		$pmob = $row['phone'];
		$page = $row['age'];
		$adrid = $row['adharno'];
	}
	
	if(isset($_POST['btn_sub'])){
	include('includes/conn.php');
	$did = $_REQUEST['getdid'];
	$q = "SELECT * FROM doctor where did='$did'";
	$r = mysqli_query($con,$q);
	while($row = mysqli_fetch_assoc($r)){
		if(@$type=="doc" || @$type=="admin"){
			echo "<div align='center' style='font-family : calibri; color:white; background:#D20D0D; padding:15px;'>Access denied ! </div>";
		}else{
		?>
		<br>
		<title><?php echo "Make Appointment With Dr. ".$row['name'].""?></title>
		<body>
		
		<br>
		<div style="box-shadow:0px 0px 8px black; width:55%;" class="container well">
		<center>
		<div class="row">
		<div class="col-md-4">
		  <?php
		  $dir = "patient/".$adrid."/img/";
		  $open = opendir($dir);
		  while(($files = readdir($open)) != FALSE){
		  if($files!="."&&$files!=".."&&$files !="Thumbs.db"){
		  echo "<img class='imgs2' class='pj' style='border-radius:5em; padding:5px;' width='70px' title='$pnam' src='$dir/$files'/>";
			}
		  }?>
		</div>
		<div class="col-md-4">
		<br>
		<?php echo "<b>$pnam</b>";?>
		</div>
		<div class="col-md-offset-4">
		<br>
		<a href="logout.php" title="Want to logout?">Logout ?</a>
		</div>
		</div>
		</center>
		<br>
		<?php echo "<h2 style='margin-top:-1%;'><span style='color:red;' class='glyphicon glyphicon-plus-sign'></span> Take Appointment with <font color='blue'>Dr. ".$row['name']."</font> </h2>";?>
		<br>
		<form ENCTYPE="multipart/form-data" action="singleap.php" id="makeap" method="POST">
		<input type="hidden" name="getpid" value="<?php echo $pid;?>"/>
		<input type="hidden" name="getdid" value="<?php echo $did;?>"/>
		<label>Patient Name :</label><input required type="text" name="pname" onkeyup="letters(this)" class="form-control" value="<?php echo $pnam;?>"/>
		<br>
		<label>Patient No :</label>
		<input type="text" class="form-control" required name="pmob" value="<?php echo $pmob;?>"/>
		<br>
		<label>Patient Age :</label>
		<input type="number" class="form-control" required name="age" value="<?php echo $page;?>"/>
		<br>
		<label>Appointment Date :</label>
		<input type="text" class="form-control" required id="datepicker" name="date" value="" placeholder="Select Date"/>
		<br>
		<label>Appointment Time :</label>
		<input type="text" class="form-control" required value="" id="datetimepicker" name="time" placeholder="Select Time"/>
		<br>
		<label>Problem :</label>
		<textarea class="form-control" name="problem" required placeholder="Describe your problem"/></textarea>
		<br>
		<label>Upload previous reports (in pdf format) if you have(optional) : </label>
		<br></br>
		<input style="margin-top:-1%;width:80%;" type="file" class="form-control" name="pre_report"/>
		<br>
		<input type="submit" class="btn btn-success" name="sub"/>
		<input type="button" value="Reset" onclick="rset()" class="btn btn-danger">
		</form>
		</div>
		<?php
		}
	}
	
	
	}
	
}
?>
<script>
 $( function() {
    $( "#datepicker" ).datepicker({
		dateFormat: "yy-m-dd",
		minDate: 0,
		maxDate: 4,
	});
  } );
  
  $('#datetimepicker').datetimepicker({
	datepicker:false,
	format:'H:i',
    formatTime: 'h:i A',
	allowTimes:['09:00','09:15','9:30','9:45','10:00','10:15','10:30','10:45','11:00','11:15','11:30','11:45','12:00','12:15','12:30','12:45',
				'14:00','14:15','14:30','14:45','15:00','15:15','15:30','15:45','16:00','16:15','16:30','16:45','17:00','17:15','17:30','17:45','18:00'],
	step:5
});

function letters(input) {
    var regex = /[^ a-z]/gi;
    input.value = input.value.replace(regex, "");
	}
	
	function rset() {
    document.getElementById("makeap").reset();
	}
</script>
</body>
</html>