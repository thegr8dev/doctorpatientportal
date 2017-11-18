<?php
session_start();
if(!isset($_SESSION['useremail'])){
	echo "Access denied";
}
else{
	include('includes/conn.php');
	$t= $_SESSION['useremail'];
	$q = "SELECT * FROM admin where email = '$t' ";
	$r = mysqli_query($con,$q);
	while($row = mysqli_fetch_assoc($r)){
		$name = $row['name'];
		$type = $row['type'];
	}
	if(@$type == "admin"){
?>
	 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo "Welcome $name to admin panel";?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="theme/admin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <style>
  .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{
	background:#E90303;
	color:white;
}

.nav-tabs>li>a{
	color:black;
	border-bottom:red;
}

.nav-tabs{
	border-bottom:1px solid #E90303;
}

.tt td{
	width:500px;
	border:1px solid #005173;
	padding:5px;
}

.tt th{
	border:1px solid #005173;
	padding:5px;
}

  </style>
  <body>
	
<div class="ad nav navbar-inverse navbar-top-fixed">
<button type="button" style="background:#E62C2C; border-color:#E62C2C;" class="navbar-toggle" data-toggle="collapse" data-target="#coo">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	</button>
	<div class="collapse navbar-collapse" id="coo">
	<div class="row container">
	<div class="col-md-2">
	<img width="60px" class="img-responsive" id="ba" title="Doctor Patient Portal" src="img/logom.png"/>
	</div>
	<div class="col-md-3">
	<a style="margin-top:2.2%;" class="br navbar-brand">Welcome <?php echo "$name";?></a>
	</div>
	<div class="col-md-offset-6">
	<ul style="margin-top:1%;" align="center" class="nav navbar-nav">
	<li class="la active"><a href="#"><span class="glyphicon glyphicon-info-sign"></span> Dashboard</a></li>
	<li ><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
	<li ><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
	</ul>
	</div>
	<div class="col-md-offset-1">
	<a style="margin-top:0.9%;" class="pull-right navbar-brand"><span style="color:white;" class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Admin Panel</a>
	</div>
	</div>
	</div>
</div>

<div style="margin-top:0.2%;" class="container jumbotron">
<ul style="margin-top:-3%;" class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#static" aria-controls="home" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-stats"></span> Site Statics</a></li>
    <li role="presentation"><a href="#mdoc" aria-controls="mdoc" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span> Manage Doctors</a></li>
    <li role="presentation"><a href="#verify" aria-controls="verify" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Verify Doctor</a></li>
    <li role="presentation"><a href="#patient" aria-controls="patient" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span> Manage Patients</a></li>
    <li role="presentation"><a href="#feed" aria-controls="feed" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span> Manage Feedbacks</a></li>
  </ul>
<div class="tab-content">
<div style="margin-top:1%;" role="tabpanel" class="tab-pane fade in active well" id="static">
<h2 style="margin-top:-0.5%;">Site Statics</h2>
<div class="row">
<div class="col-md-6">

<div class="panel panel-primary">
  <div class="panel-heading"><span class="glyphicon glyphicon-signal"></span> User Statics</div>
  <div class="panel-body">
  <?php
$con = mysqli_connect("localhost", "root", "",'dpp');
$doccnt = mysqli_query($con,"SELECT COUNT(*) as cnt FROM doctor");
$res = mysqli_fetch_array($doccnt);
$doc = $res ['cnt'];

$docvr = mysqli_query($con,"SELECT COUNT(*) as cnt FROM doctor WHERE status='success'");
$res = mysqli_fetch_array($docvr);
$docv = $res ['cnt'];

$docunv = mysqli_query($con,"SELECT COUNT(*) as cnt FROM doctor WHERE status='fail'");
$res = mysqli_fetch_array($docunv);
$docuv = $res ['cnt'];

$patcnt = mysqli_query($con,"SELECT COUNT(*) as cnt FROM patient");
$res = mysqli_fetch_array($patcnt);
$pat = $res ['cnt'];

$total = $doc + $pat;
  ?>
    <table width="400px" cellpadding="2" border="0">
	<tr><td style="padding:5px;">Total Doctor Registered :  </td><td style="padding:5px;"><span class="badge"><?php echo $doc;?></span></td></tr>
    <tr><td style="padding:5px;">Verified Doctor Registered :  </td><td style="padding:5px;"><span class="badge"><?php echo $docv;?></span></td></tr>
    <tr><td style="padding:5px;">Unverified Doctor Registered :</td><td style="padding:5px;">  <span class="badge"><?php echo $docuv;?></span></td></tr>
    <tr><td style="padding:5px;">Total Patient Registered : </td><td style="padding:5px;"> <span class="badge"><?php echo $pat;?></span></td></tr>
    <tr><td style="padding:5px;">Total Registered : </td><td style="padding:5px;"> <span class="badge"><?php echo $total;?></span></td></tr>
	</table>
  </div>
</div>

</div>
<div class="col-md-6">

<div class="panel panel-primary">
  <div class="panel-heading"><span class="glyphicon glyphicon-equalizer"></span> Appointment Statics</div>
  <div class="panel-body">
    <?php
	$con = mysqli_connect("localhost", "root", "",'dpp');
	$totalp = mysqli_query($con,"SELECT COUNT(*) as cnt FROM appointments where status='pending'");
	$res = mysqli_fetch_array($totalp);
	$pen = $res ['cnt'];
	
	$totalca = mysqli_query($con,"SELECT COUNT(*) as cnt FROM appointments where status='Completed'");
	$res = mysqli_fetch_array($totalca);
	$com = $res ['cnt'];
	
	$totalcan = mysqli_query($con,"SELECT COUNT(*) as cnt FROM appointments where status='Canceled'");
	$res = mysqli_fetch_array($totalcan);
	$can = $res ['cnt'];
	
	$totalap = mysqli_query($con,"SELECT COUNT(*) as cnt FROM appointments");
	$res = mysqli_fetch_array($totalap);
	$ap = $res ['cnt'];
	
	?>
	<table width="400px" cellpadding="2" border="0">
	<tr><td style="padding:5px;">Total Pending Appointments :  </td><td style="padding:5px;"><span class="badge"><?php echo $pen;?></span></td></tr>
    <tr><td style="padding:5px;">Total Completed Appointments :  </td><td style="padding:5px;"><span class="badge"><?php echo $com;?></span></td></tr>
    <tr><td style="padding:5px;">Total Canceled Appointments :  </td><td style="padding:5px;"><span class="badge"><?php echo $can;?></span></td></tr>
    <tr><td style="padding:5px;">Total Appointments :</td><td style="padding:5px;">  <span class="badge"><?php echo $ap;?></span></td></tr>
	</table>
  </div>
</div>

</div>
</div>
</div>


	
	<div role="tabpanel" class="tab-pane fade" id="mdoc">
	
	<br>
	<table class="tt table-hover" border="1" cellspacing="0">
	<tr>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Profile pic</th>
		<th width="10%" style="text-align:center; color:white; background:#E90303;">ID</th>
		<th width="20%" style="text-align:center; color:white; background:#E90303;">Name</th>
		<th width="20%" style="text-align:center; color:white; background:#E90303;">Email</th>
		<th width="20%" style="text-align:center; color:white; background:#E90303;">Specialist in</th>
		<th width="25%" style="text-align:center; color:white; background:#E90303;">Status</th>
		<th style="text-align:center; color:white; background:#E90303;">Delete?</th>
	</tr>
	
<?php
$sql = "SELECT * FROM doctor";
$r1= mysqli_query($con,$sql);
while($row = $r1->fetch_array())
{
	$docid = $row['docid'];
?>
<tr >
<?php 

$dir = "doctor/".$docid."/img/";
$open = opendir($dir);

while(($files = readdir($open)) != FALSE){
	if($files!="."&&$files!=".."&&$files !="Thumbs.db"){
		echo "<tr><center><td style='padding:5px' align='center'>
		<img class='imgs2' width='50px' title='$docid' src='$dir/$files'></td></center>";
	
	}
}


?>
<td style="text-align:center; "><?php echo $row['did']; ?></td>
<td style="text-align:center; "><?php echo $row['name'];?></td>
<td style="text-align:center; "><?php echo $row['email'];?></td>
<td style="text-align:center; "><?php echo $row['specialist'];?></td>
<td style="text-align:center; "><?php echo $row['status'];?></td>
<th style="text-align:center; "><a href="delete3.php?did=<?php echo $row['docid'];?>"  onclick="return confirm('Are you sure want to delete?')">
<span class="glyphicon glyphicon-trash"></span></a></th></tr>
<?php
}
?>
</table>
	
	</div>

	<div role="tabpanel" class="tab-pane fade" id="verify">
	
	<br>
	<table class="tt table-hover" border="1" cellspacing="0">
	<tr>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Profile pic</th>
		<th width="10%" style="text-align:center; color:white; background:#E90303;">ID</th>
		<th width="20%" style="text-align:center; color:white; background:#E90303;">Name</th>
		<th width="20%" style="text-align:center; color:white; background:#E90303;">Email</th>
		<th width="20%" style="text-align:center; color:white; background:#E90303;">Specalist in</th>
		<th width="35%" style="text-align:center; color:white; background:#E90303;">Docs Path</th>
		<th style="text-align:center; color:white; background:#E90303;">&nbsp;Verify?&nbsp;</th>
	</tr>
	
<?php
$sql = "SELECT * FROM `doctor` WHERE `status`='fail'";
$r1= mysqli_query($con,$sql);
while($row = $r1->fetch_array())
{
	$docid = $row['docid'];

?>
<tr >
<?php 

$dir = "doctor/".$docid."/img/";
$open = opendir($dir);

while(($files = readdir($open)) != FALSE){
	if($files!="."&&$files!=".."&&$files !="Thumbs.db"){
		echo "<tr><center><td style='padding:5px' align='center'>
		<img class='imgs2' width='50px' title='$docid' src='$dir/$files'></td></center>";
	
	}
}


?>
<input type="hidden" name="did" value="<?php echo $row['did'];?>"/>
<td style="text-align:center; "><?php echo $row['did']; ?></td>
<td style="text-align:center; "><?php echo $row['name'];?></td>
<td style="text-align:center; "><?php echo $row['email'];?></td>
<td style="text-align:center; "><?php echo $row['specialist'];?></td>
<td style="text-align:center; "><?php echo $row['docs'];?></td>
<th style="text-align:center; "><a href="verify.php?did=<?php echo $row['did'];?>"  onclick="return confirm('Are you sure want to verify?')">
<span style="font-size:25px; color:green;" class="glyphicon glyphicon-ok-circle"></span></a></th></tr>

<?php
}
?>
</table>
	
	</div>
   
    <div role="tabpanel" class="tab-pane fade" id="feed">
	
	<br>
	<table style="text-align:center;" align="center" class="tt table-hover" border="1" cellspacing="0">
	<tr>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">S.No</th>
		<th width="25%" style="text-align:center; color:white; background:#E90303;">Feedback To</th>
		<th width="25%" style="text-align:center; color:white; background:#E90303;">Feedback From</th>
		<th width="35%" style="text-align:center; color:white; background:#E90303;">Feedback</th>
		<th style="text-align:center; color:white; background:#E90303;">&nbsp;Delete?&nbsp;</th>
	</tr>
	
<?php
$qu1 = "SELECT * FROM feedback";
$res1 = mysqli_query($con,$qu1);
$i=0;
while($row = mysqli_fetch_assoc($res1)){
	$d = $row['did'];
	$p= $row['pid'];
	$i++;
	$qu2 = "SELECT * FROM doctor WHERE did='$d' ";
	$ru2 = mysqli_query($con,$qu2);
	
	$qu3 = "SELECT * FROM patient WHERE pid='$p' ";
	$ru3 = mysqli_query($con,$qu3);
	
	while($rr1 = mysqli_fetch_assoc($ru3)){
		
		$pname = $rr1['name'];
	
	while($rr = mysqli_fetch_assoc($ru2)){
		$dname = $rr['name'];
	?>
	<tr>
	<td><?php echo $i;?></td>
	<td><?php echo $dname;?></td>
	<td><?php echo $pname;?></td>
	<td><?php echo $row['feed'];?></td>
	<td><form action="" method="POST">
	<input type="hidden" name="getid" value="<?php echo $row['id'];?>"/>
	<input type="submit" value="Delete" name="delf" class="btn btn-danger" onclick="return confirm('Delete Feedback?');"/>
	</form>
	</td>
	<?php
	}
	}
}
?>
</table>
	<?php
	if(isset($_POST['delf'])){
		$id = $_POST['getid'];
		$q = "DELETE FROM feedback where id = '$id'";
		if($r = mysqli_query($con,$q)){
			echo '<script>';
			echo 'alert("Feedback deleted");';
			echo 'window.location.href="adminpanel.php"';
			echo '</script>';
		}
	}
	?>
	</div>
	
	<div role="tabpanel" class="tab-pane fade" id="patient">
	
	<br>
	<table class="tt table-hover" border="1" cellspacing="0">
	<tr>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Profile pic</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">ID</th>
		<th width="35%" style="text-align:center; color:white; background:#E90303;">Name</th>
		<th width="35%" style="text-align:center; color:white; background:#E90303;">Email</th>
		<th style="text-align:center; color:white; background:#E90303;">&nbsp;Delete?&nbsp;</th>
	</tr>
	
<?php
$sql = "SELECT * FROM patient";
$r1= mysqli_query($con,$sql);
while($row = $r1->fetch_array())
{
	$adr = $row['adharno'];
?>
<tr >
<?php 

$dir = "patient/".$adr."/img/";
$open = opendir($dir);

while(($files = readdir($open)) != FALSE){
	if($files!="."&&$files!=".."&&$files !="Thumbs.db"){
		echo "<tr><center><td style='padding:5px' align='center'>
		<img class='imgs2' width='50px' title='$adr' src='$dir/$files'></td></center>";
	
	}
}


?>
<td style="text-align:center; "><?php echo $row['pid']; ?></td>
<td style="text-align:center; "><?php echo $row['name'];?></td>
<td style="text-align:center; "><?php echo $row['email'];?></td>
<th style="text-align:center; "><a href="delete2.php?pid=<?php echo $row['pid'];?>"  onclick="return confirm('Are you sure want to delete?')">
<span class="glyphicon glyphicon-trash"></span></a></th></tr>
<?php
}
?>
</table>
	
	</div>


</div><!--content of tabs end-->
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
		
<?php
	}else{
		echo "Access Denied";
	}
}
	?>