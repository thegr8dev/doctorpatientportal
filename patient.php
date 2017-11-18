<?php
session_start();
if(!isset($_SESSION['useremail'])){
	echo "<div align='center' style='font-family : calibri; color:white; background:#D20D0D; padding:15px;'>Access Denied ! </div>";
}else{
if(isset($_SESSION['useremail'])||isset($_COOKIE['dpp'])){
$email = $_SESSION['useremail'];
include('includes/conn.php');
$query = "SELECT * FROM patient WHERE email ='".$email."'";
$rec = mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($rec)){
	$id = $row['pid'];
	$newname=$row['name'];
	$age= $row['age'];
	$sex = $row['gender'];
	$email = $row['email'];
	$type = $row['type'];
	$add = $row['address'];
	$ph = $row['phone'];
	$gender= $row['gender'];
	$adhar = $row['adharno'];
}


if(@$type == "pat"){
	?>
	<!DOCTYPE html>
<html lang="en">
<noscript>
  <META HTTP-EQUIV="Refresh" CONTENT="0;URL=nojs.html">
</noscript>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo "Welcome $newname To Your Dashboard";?></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="js/jquery.datetimepicker.full.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	 <link rel="stylesheet" href="css/jquery.datetimepicker.css">
	<link href="theme/verify.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
	.editpro{
	color:#2A689D;
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
	
  </head>
  
  <body>
    <div style="border-radius:0em; padding:8px;" class="mainmenu nav navbar navbar-inverse navbar-top-fixed">
	<div class="row container">
	<div class="col-md-2">
	
	<img width="60px" class="img-responsive" title="Doctor Patient Portal" src="img/logom.png"/>
	
	
	
	</div>
	<div class="col-md-3">
	<a style="margin-top:2.2%;" class="navbar-brand"><?php echo "Welcome $newname";?></a>
	</div>
	<div class="col-md-offset-6">
	<ul style="margin-top:1%;" align="center" class="nav navbar-nav">
	<li class="la active"><a href="#"><span class="glyphicon glyphicon-info-sign"></span> Dashboard</a></li>
	<li ><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
	<li ><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
	</ul>
	</div>
	<div class="col-md-offset-1">
	<a style="margin-top:0.9%;"  class="pull-right navbar-brand"><span style="color:#5DC91A;" class="glyphicon glyphicon-copy"></span> Patient Dashboard</a>
	</div>
	</div>
	</div>
	<div style="margin-top:-1%;" class="container jumbotron">
	<div class="row">
	<div class="col-md-3">
	<?php
	$q3 = "SELECT COUNT(*) as cnt FROM rmsg where sid='$id' AND status = 'unread' ";
	$r2 = mysqli_query($con,$q3);
	$res = mysqli_fetch_array($r2);
	$pen = $res ['cnt'];
	?>
  <!-- Nav tabs -->
  <ul style="margin-top:-12%;" class="nav nav-stacked nav-pills nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#papt" aria-controls="papt" role="tab" data-toggle="tab"><span style="color:#EB1212" class="glyphicon glyphicon-usd"></span>&nbsp;&nbsp;Pay For Appointments</a></li>
    <li role="presentation" ><a href="#apt" aria-controls="apt" role="tab" data-toggle="tab"><span style="color:#5DC91A" class="glyphicon glyphicon-paste"></span>&nbsp;&nbsp;Today's Appointments</a></li>
    <li role="presentation"><a href="#upapt" aria-controls="apt" role="tab" data-toggle="tab"><span style="color:#EB1212" class="glyphicon glyphicon-time"></span>&nbsp;&nbsp;Upcoming Appointments</a></li>
    <li role="presentation"><a href="#missapt" aria-controls="apt" role="tab" data-toggle="tab"><span style="color:#5DC91A" class="glyphicon glyphicon-minus"></span>&nbsp;&nbsp;Missed Appointments</a></li>
    <li role="presentation"><a href="#makeap" aria-controls="makeap" role="tab" data-toggle="tab"><span style="color:#EB1212" class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Make Appointment</a></li>
    <li role="presentation"><a href="#comap" aria-controls="comap" role="tab" data-toggle="tab"><span style="color:#5DC91A" class="glyphicon glyphicon-ok-circle"></span>&nbsp;&nbsp;Completed Appointments</a></li>
    <li role="presentation"><a href="#canap" aria-controls="canap" role="tab" data-toggle="tab"><span style="color:#EB1212" class="glyphicon glyphicon-remove-circle"></span>&nbsp;&nbsp;Canceled Appointments</a></li>
	<li role="presentation"><a href="#msger" aria-controls="msg" role="tab" data-toggle="tab"><span style="color:#5DC91A" class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;Messenger <span class="badge"><?php echo $pen;?></span></a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><span style="color:#1754AB" class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;Your Profile</a></li>
  </ul>
</div>
  <!-- Tab panes -->
  <div class="col-md-9">
  <div style="margin-top:-10%;" class="tab-content">
   <div role="tabpanel" class="tab-pane fade in active" id="papt">
   <br><br><br>
   <div style="border:1px solid #E9EB91;  background:#FFF395;" class="alert alert-danger">
   <span class="glyphicon glyphicon-download"></span> Payments Pending For <b>Todays</b> Appointments Shown Here <span class="glyphicon glyphicon-arrow-right"><span></div>
   <table class="tt table-hover" border="1" cellspacing="0">
	<tr>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment ID</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment Date</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment Time</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment With</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Doctor Contact No.</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment Status</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Pay</th>
		</tr>
		<?php
		include('includes/conn.php');
		
		$q1 = "SELECT * FROM appointments where a_date=CURRENT_DATE AND a_time>CURRENT_TIME AND status='pending' ";
		$r = mysqli_query($con,$q1);
		while($row = mysqli_fetch_assoc($r)){
			$aid = $row['id'];
			$pid = $row['pat_id'];
			$docid = $row['doc_id'];
			$name = $row['pname'];
			$ad= $row['a_date'];
			$apt = $row['a_time'];
			$s = $row['status'];
			$tid = $row['tid'];
			
		   $dt = date("d-M-Y", strtotime($ad));
		   $tt  = date("h:i A", strtotime($apt));
		   
			$q2 = "SELECT name,phone_number,address FROM doctor where did='$docid' ";
			$r1 = mysqli_query($con,$q2);
			while($rw = mysqli_fetch_assoc($r1)){
				$docname = $rw['name'];
				$docadd = $rw['address'];
				$ph = $rw['phone_number'];
			
			
			
			
			if($id == $pid ){
				
			if($tid == ""){
			?>
			<tr><td style="text-align:center;"><?php echo $aid;?></td>
			<td style="text-align:center;"><?php echo $dt ;?></td>
			<td style="text-align:center;"><?php echo $tt;?></td>
			<td style="text-align:center;"><?php echo "Dr. $docname";?></td>
			<td style="text-align:center;"><?php echo $ph;?></td>
			<td style="text-align:center;"><?php 
			echo "Payment Not Done";
			?></td>
		
			<td align="center"><a href="pay.php?payid=<?php echo $row['id'];?>">Pay</a></td>
			
			</tr>
			<?php
			}
			
		}
		}
		}
		
		
		?>
	</tr>
	</table>
	<br>
	<!--upcoming events-->
	<div class="alert alert-info">
   <span class="glyphicon glyphicon-time"></span> Payments Pending For <b>Upcoming</b> Appointments Shown Here <span class="glyphicon glyphicon-arrow-right"></span></div>
   <table class="tt table-hover" border="1" cellspacing="0">
	<tr>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment ID</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment Date</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment Time</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment With</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Doctor Contact No.</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment Status</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Pay</th>
		</tr>
		<?php
		include('includes/conn.php');
		
		$q1 = "SELECT * FROM appointments where a_date>CURRENT_DATE AND status='pending' ";
		$r = mysqli_query($con,$q1);
		while($row = mysqli_fetch_assoc($r)){
			$aid = $row['id'];
			$pid = $row['pat_id'];
			$docid = $row['doc_id'];
			$name = $row['pname'];
			$ad= $row['a_date'];
			$apt = $row['a_time'];
			$s = $row['status'];
			$tid = $row['tid'];
			
		   $dt = date("d-M-Y", strtotime($ad));
		   $tt  = date("h:i A", strtotime($apt));
		   
			$q2 = "SELECT name,phone_number,address FROM doctor where did='$docid' ";
			$r1 = mysqli_query($con,$q2);
			while($rw = mysqli_fetch_assoc($r1)){
				$docname = $rw['name'];
				$docadd = $rw['address'];
				$ph = $rw['phone_number'];
			
			
			
			
			if($id == $pid ){
				
			if($tid == ""){
			
			?>
			<tr><td style="text-align:center;"><?php echo $aid;?></td>
			<td style="text-align:center;"><?php echo $dt ;?></td>
			<td style="text-align:center;"><?php echo $tt;?></td>
			<td style="text-align:center;"><?php echo "Dr. $docname";?></td>
			<td style="text-align:center;"><?php echo $ph;?></td>
			<td style="text-align:center;"><?php 
			echo "Payment Not Done";
			?></td>
			<td align="center"><a href="pay.php?payid=<?php echo $row['id'];?>">Pay</a></td>
			
			</tr>
			<?php
			}
			
		}
		}
		}
		
		
		?>
	</tr>
	</table>
   </div>
    <div role="tabpanel" class="tab-pane fade in" id="apt">
	<br></br>
	<br>
	<table class="tt table-hover" border="1" cellspacing="0">
	<tr>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Appointment No</th>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Appo. Date</th>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Appo. Time</th>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Appo. With</th>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Uploded Report By You</th>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Clinic Address</th>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Doctor Contact No.</th>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Status</th>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Cancel</th>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Trans. ID</th>
		</tr>
		<?php
		include('includes/conn.php');
		
		$q1 = "SELECT * FROM appointments where a_date=CURRENT_DATE AND a_time>CURRENT_TIME AND status='pending' ";
		$r = mysqli_query($con,$q1);
		while($row = mysqli_fetch_assoc($r)){
			$aid = $row['id'];
			$pid = $row['pat_id'];
			$docid = $row['doc_id'];
			$name = $row['pname'];
			$ad= $row['a_date'];
			$apt = $row['a_time'];
			$s = $row['status'];
			$tid = $row['tid'];
			$rpath = $row['pre_reprt'];
			
		   $dt = date("d-M-Y", strtotime($ad));
		   $tt  = date("h:i A", strtotime($apt));
		   
			$q2 = "SELECT name,phone_number,address FROM doctor where did='$docid' ";
			$r1 = mysqli_query($con,$q2);
			while($rw = mysqli_fetch_assoc($r1)){
				$docname = $rw['name'];
				$docadd = $rw['address'];
				$ph = $rw['phone_number'];
			
			
			
			
			if($id == $pid ){
				
			if($tid == ""){
				echo "<div class='alert alert-info'><span class='glyphicon glyphicon-info-sign'></span> No Appointments To Show</div>";
			}else{
			?>
			<tr><td style="font-size:12px;text-align:center;"><?php echo $aid;?></td>
			<td style="font-size:12px;text-align:center;"><?php echo $dt ;?></td>
			<td style="font-size:12px;text-align:center;"><?php echo $tt;?></td>
			<td style="font-size:12px;text-align:center;"><?php echo "Dr. $docname";?></td>
			<td style="text-align:center;"><?php if($rpath ==""){ 
			echo "No report uploaded by you";
			}else{?><a target="_blank" href="<?php echo $rpath;?>">Click to see</a>
			<?php } ?></td>
			<td style="text-align:center;"><a data-toggle="modal" href="#viewadd<?php echo $aid;?>">View Address</a>
			<div class="modal fade" id="viewadd<?php echo $aid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Clinic Address</h4>
      </div>
      <div class="modal-body">
        <?php echo $docadd;?>
      </div>
    </div>
  </div>
</div>
			</td>
			<td style="font-size:12px;text-align:center;"><?php echo $ph;?></td>
			<td style="font-size:12px;text-align:center;"><?php 
			echo $s;
			?></td>
		<td style="font-size:12px;text-align:center; ">
		<a href="cancel.php?aid=<?php echo $row['id'];?>"  onclick="return confirm('Are you sure want to cancel?')">
		Cancel</a>
		</td>
			
				<td style="font-size:12px;"><?php echo $tid;?></td>
			
			</tr>
			<?php
			}
			
		}
		}
		}
		
		
		?>
	</tr>
	</table>
	
	
	
	</div>
	
	 <div role="tabpanel" class="tab-pane fade in" id="upapt">
	<br></br>
	<br>
	<table class="tt table-hover" border="1" cellspacing="0">
	<tr>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">App.No</th>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Appo. Date</th>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Appo. Time</th>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Appo. With</th>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Clinic Address</th>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Uploded Report By You</th>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Doctor Contact No.</th>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Status</th>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Cancel?</th>
		<th width="15%" style="font-size:12px;text-align:center; color:white; background:#E90303;">Trans. ID</th>
		</tr>
		<?php
		include('includes/conn.php');
		
		$q1 = "SELECT * FROM appointments where a_date>CURRENT_DATE AND status='pending' ";
		$r = mysqli_query($con,$q1);
		while($row = mysqli_fetch_assoc($r)){
			$aid = $row['id'];
			$pid = $row['pat_id'];
			$docid = $row['doc_id'];
			$name = $row['pname'];
			$ad= $row['a_date'];
			$apt = $row['a_time'];
			$s = $row['status'];
			$rpath = $row['pre_reprt'];
			
		   $dt = date("d-M-Y", strtotime($ad));
		    $tt  = date("h:i A", strtotime($apt));
		   
			$q2 = "SELECT name,phone_number,address FROM doctor where did='$docid' ";
			$r1 = mysqli_query($con,$q2);
			while($rw = mysqli_fetch_assoc($r1)){
				$docname = $rw['name'];
				$docadd = $rw['address'];
				$ph = $rw['phone_number'];
				$tid = $row['tid'];
			}
			
			
			
			if($id == $pid ){
				
				if($tid == ""){
				echo "<div class='alert alert-info'><span class='glyphicon glyphicon-info-sign'></span> No Appointments To Show</div>";
			}
				else{
			?>
			<tr><td style="font-size:12px;text-align:center;"><?php echo $aid;?></td>
			<td style="font-size:12px;text-align:center;"><?php echo $dt ;?></td>
			<td style="font-size:12px;text-align:center;"><?php echo $tt;?></td>
			<td style="font-size:12px;text-align:center;"><?php echo "Dr. $docname "?></td>
			<td style="font-size:12px;text-align:center;"><a data-toggle="modal" href="#viewadd<?php echo $aid;?>">View Address</a>
			<div class="modal fade" id="viewadd<?php echo $aid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Clinic Address</h4>
      </div>
      <div class="modal-body">
        <?php echo $docadd;?>
      </div>
    </div>
  </div>
</div>
			</td>
			<td style="text-align:center;"><?php if($rpath ==""){ 
			echo "No report uploaded by you";
			}else{?><a target="_blank" href="<?php echo $rpath;?>">Click to see</a>
			<?php } ?></td>
			<td style="font-size:12px;text-align:center;"><?php echo $ph;?></td>
			<td style="font-size:12px;text-align:center;"><?php echo "$s";?></td>
			<td style="font-size:12px;text-align:center; ">
			<a href="cancel.php?aid=<?php echo $row['id'];?>"  onclick="return confirm('Are you sure want to cancel?')">
			Cancel</a></td>
			<td style="font-size:12px;"><?php echo $tid;?></td>
			
			</tr>
			<?php
				}
		}
		}
		
		
		?>
	</tr>
	</table>
	
	
	
	</div>
	
	 <div role="tabpanel" class="tab-pane fade in" id="missapt">
	<br></br>
	<br>
	<table class="tt table-hover" border="1" cellspacing="0">
	<tr>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment ID</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment Date</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment Time</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment With</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Clinic Address</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Doctor Contact No.</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment Status</th>
		</tr>
		<?php
		include('includes/conn.php');
		
		$q1 = "SELECT * FROM appointments where a_date<=CURRENT_DATE AND a_time<CURRENT_TIME AND status='pending' ";
		$r = mysqli_query($con,$q1);
		while($row = mysqli_fetch_assoc($r)){
			$aid = $row['id'];
			$pid = $row['pat_id'];
			$docid = $row['doc_id'];
			$name = $row['pname'];
			$ad= $row['a_date'];
			$apt = $row['a_time'];
			$tid = $row['tid'];
		   $dt = date("d-M-Y", strtotime($ad));
		   $tt  = date("h:i A", strtotime($apt));
		   
			$q2 = "SELECT name,phone_number,address FROM doctor where did='$docid' ";
			$r1 = mysqli_query($con,$q2);
			while($rw = mysqli_fetch_assoc($r1)){
				$docname = $rw['name'];
				$docadd = $rw['address'];
				$ph = $rw['phone_number'];
			}
			
			
			
			if($id == $pid ){
				

			?>
			<tr><td style="text-align:center;"><?php echo $aid;?></td>
			<td style="text-align:center;"><?php echo $dt ;?></td>
			<td style="text-align:center;"><?php echo $tt;?></td>
			<td style="text-align:center;"><?php echo "Dr. $docname "?></td>
			<td style="text-align:center;"><a data-toggle="modal" href="#viewadd<?php echo $aid;?>">View Address</a>
			<div class="modal fade" id="viewadd<?php echo $aid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Clinic Address</h4>
      </div>
      <div class="modal-body">
        <?php echo $docadd;?>
      </div>
    </div>
  </div>
</div>
			</td>
			<td style="text-align:center;"><?php echo $ph;?></td>
			<td style="text-align:center;"><?php echo "Missed"; ?></td>

			</tr>
			<?php
			
		}
		}
		
		
		?>
	</tr>
	</table>
	
	
	
	</div>
	
    <div role="tabpanel" class="tab-pane fade" id="makeap"><br></br>
	<div class="well">
	<BR>
	<form action="test.php" method="POST" ENCTYPE="multipart/form-data" id="res">
	<h2 style="margin-top:-2%;" >Appointment Form</h2>
	<input type="hidden" name="pid" value="<?php echo $id;?>"/><br>
	<label> Patient Name : </label><input style="width:80%;" required class="form-control" type="text" name="name" value="<?php echo $newname;?>" onkeyup="letters1(this)"/><br>
	<label> Contact No : </label><input style="width:80%;" required class="form-control" type="number" name="phone" value="<?php echo $ph;?>"/><br>
	<label> Patient Age : </label><input style="width:80%;" required class="form-control" type="number" name="age" value="<?php echo $age;?>"/><br>
	<label> Appointment Date : </label><input style="width:80%;" type="text" name="date" placeholder="Select Date" class="form-control" id="datepicker"/><br>
	<label> Appointment Time : </label><input style="width:80%;" type="text" name="time" placeholder="Select Time" class="form-control" id="datetimepicker"/><br><br>
	<div id="msg"></div>
	<label> Problem : </label><textarea style="width:80%;" required class="form-control" name="problem" placeholder="Describe what problem you have in short description"></textarea><br>
	<label>Choose Doctor Type : </label>
	<select style="color:solid #ccc; border-radius:0.2em; padding:5px;" name="doccat" onchange="getId(this.value);">
		<option>Choose</option>
		<?php 
		$qu = "SELECT DISTINCT specialist FROM doctor WHERE status='success'";
		$res = mysqli_query($con,$qu);
		while($row=mysqli_fetch_assoc($res)){
		?>
		<option value="<?php echo $row['specialist']; ?>"><?php echo $row['specialist']; ?></option>
		<?php }?>
		</select>
		<br></br>
		<label>Choose Doctor : </label>
		<select style="color:solid #ccc; border-radius:0.2em; padding:5px;" name="docho" id="doclist">
		<option value="">Choose</option>
		</select>
		<br></br>
		<label>Upload previous reports (in pdf format) if you have(optional) : </label>
		<br></br>
		<input style="margin-top:-1%;width:80%;" type="file" class="form-control" name="pre_report"/>
		<br></br>
		<input type="submit" name="sub_app" class="btn btn-success" />	
		<input type="button" value="Reset" onclick="rset1()" class="btn btn-danger"></center>	
	
	
	</form>
	</div>
	</div>
	
	<div role="tabpanel" class="tab-pane fade" id="comap">
	<br></br>
	<br>
	<table class="tt table-hover" border="1" cellspacing="0">
	<tr>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment ID</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment Date</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment Time</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment With</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Uploaded reports by you</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment Status</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Trans. ID</th>
		</tr>
		<?php
		include('includes/conn.php');
		$q1 = "select * from appointments where status='Completed'";
		$r = mysqli_query($con,$q1);
		while($row = mysqli_fetch_assoc($r)){
			$aid = $row['id'];
			$pid = $row['pat_id'];
			$docid = $row['doc_id'];
			$name = $row['pname'];
			$ad = $row['a_date'];
			$apt = $row['a_time'];
			$s = $row['status'];
			$tid = $row['tid'];
			$rpath = $row['pre_reprt'];
			
			$q2 = "SELECT name FROM doctor where did='$docid' ";
			$r1 = mysqli_query($con,$q2);
			while($rw = mysqli_fetch_assoc($r1)){
				$docname = $rw['name'];
			}
			
			$dt  = date("d-M-Y", strtotime($ad));
		    $tt  = date("h:i A", strtotime($apt));
			
			
			if($id == $pid ){

			?>
			<tr><td style="text-align:center;"><?php echo $aid;?></td>
			<td style="text-align:center;"><?php echo $dt ;?></td>
			<td style="text-align:center;"><?php echo $tt;?></td>
			<td style="text-align:center;"><?php echo "Dr. $docname "?></td>
			<td style="text-align:center;"><?php if($rpath ==""){ 
			echo "No Report Uploaded by you";
			}else{?><a target="_blank" href="<?php echo $rpath;?>">Click to see</a>
			<?php } ?></td>
			<td style="text-align:center;"><?php echo $s; ?></td>
			<td style="text-align:center;"><?php echo $tid; ?></td>
			</tr>
			<?php
		}
		}
		
		
		?>
	</tr>
	</table>
	</div>
    <div role="tabpanel" class="tab-pane fade" id="canap">
	<br></br>
	<br>
	<table class="tt table-hover" border="1" cellspacing="0">
	<tr>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment ID</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment Date</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment Time</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment With</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Appointment Status</th>
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Trans. ID</th>
			<?php
		include('includes/conn.php');
		$q1 = "select * from appointments where status='Canceled'";
		$r = mysqli_query($con,$q1);
		while($row = mysqli_fetch_assoc($r)){
			$aid = $row['id'];
			$pid = $row['pat_id'];
			$docid = $row['doc_id'];
			$name = $row['pname'];
			$ad = $row['a_date'];
			$apt = $row['a_time'];
			$s = $row['status'];
			$tid = $row['tid'];
			
			$q2 = "SELECT name FROM doctor where did='$docid' ";
			$r1 = mysqli_query($con,$q2);
			while($rw = mysqli_fetch_assoc($r1)){
				$docname = $rw['name'];
			}
			
			$dt = date("d-M-Y", strtotime($ad));
			$tt  = date("h:i A", strtotime($apt));
		
			if($id == $pid ){

			?>
			<tr><td style="text-align:center;"><?php echo $aid;?></td>
			<td style="text-align:center;"><?php echo $dt ;?></td>
			<td style="text-align:center;"><?php echo $tt;?></td>
			<td style="text-align:center;"><?php echo "Dr. $docname "?></td>
			<td style="text-align:center;"><?php echo $s; ?></td>
			<td style="text-align:center;"><?php echo $tid; ?></td>
			</tr>
			<?php
		}
		}
		
		
		?>
	</tr>
	</table>
	
	
	</div>
	<div role="tabpanel" class="tab-pane fade" id="msger">
	<br></br>
<br>	
	<div>

  <!-- Nav tabs -->
  <ul class="nav nav-pills" role="tablist">
    <li role="presentation" class="active"><a href="#inbox" aria-controls="inbox" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-comment"></span> Inbox <span style="background:red; color:white; border:1px white dotted;" class="badge"><?php echo $pen;?></span></a></li>
    <li role="presentation"><a href="#compose" aria-controls="compose" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-edit"></span> Compose </a></li>
    <li role="presentation"><a href="#sent" aria-controls="sent" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-new-window"></span> Sent</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="inbox">
	<br>
	<table border="0" cellspacing="0" width="800px">
	<tr>
	<th  style="padding:5px; text-align:center; background:red; color:white; border:1px solid red;">&nbsp;</th>
	<th  style="padding:5px; text-align:center; background:red; color:white; border:1px solid red;">From</th>
	<th  style="padding:5px; text-align:center; background:red; color:white; border:1px solid red;">Subject</th>
	<th  style="padding:5px; text-align:center; background:red; color:white; border:1px solid red;">Message</th>
	<th  style="padding:5px; text-align:center; background:red; color:white; border:1px solid red;">Reply</th>
	</tr>
	<?php
	$q = "SELECT * FROM `rmsg` where sid='$id' ORDER BY `rid` DESC ";
	$r = mysqli_query($con,$q);
	
	
	
	while($row = mysqli_fetch_assoc($r)){
		$sts = $row['status'];
		$oid = $row['did'];
		$mid = $row['rid'];
		
		$q2 = "SELECT * from doctor WHERE did='$oid' ";
		$r2 = mysqli_query($con,$q2);
		
		foreach ($r2 as $row2){
			if($sts == "unread"){
				$doc_dp = $row2['docid'];
		?>
		
		
		<tr>
		<tr><td>&nbsp;</td></tr>
		<td width="20%" align="center">	
	<?php
	$dir = "doctor/".$doc_dp."/img/";
	$open = opendir($dir);

	while(($files = readdir($open)) != FALSE){
	$altu = $_SESSION['useremail'];
	if($files!="."&&$files!=".."&&$files !="Thumbs.db"){
		echo "<img style=border-radius:6em;' width='50' height='50' title='$newname' src='$dir/$files'></center>";
	}
	
	
	}
	?>
	
		</td>
		<td align="center" width="20%"><b>Dr. <?php echo $row2['name'];?></b></td>
		<td align="center" width="20%"><b><?php echo $row['sub'];?></b></td>
		<td align="center" width="45%"><b><a href="#readmsg<?php echo $row['rid'];?>" data-toggle="modal">View Message</a></b>
		
			<div class="modal fade" id="readmsg<?php echo $row['rid'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Message From Dr. <?php echo $row2['name'];?></h4>
      </div>
      <div class="modal-body">
	  <?php
	  $d = $row['dte'];
	  $t = $row['tme'];
	  $date = date("d-M-Y", strtotime($d));
	  $time = date("h:i A", strtotime($t));
	  $st = "read";
	  $testq = "UPDATE rmsg set status ='$st' where rid ='$mid' ";
	  $reslt = mysqli_query($con,$testq);
	  ?>
	  <blockquote style="font-family:calibri;text-align:justify;">
	  <font style="font-size:15px;">Sent By Dr.<?php echo $row2['name'];?> on <?php echo $date;?> • <?php echo $time;?></font> <br><?php echo $row['msg'];?>
	  </blockquote>
			
      </div>
    </div>
  </div>
</div>
		
		</td>
		<td align="center" width="20%"><a data-toggle="modal" href="#rmodal<?php echo $row['rid'];?>" >Reply</a>
		
		<div class="modal fade" id="rmodal<?php echo $row['rid'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Reply to Message From Dr. <?php echo $row2['name'];?></h4>
      </div>
      <div class="modal-body">
	  <form action="rmsg2.php" method="POST" >
	  <input type="hidden" name="getsid" value="<?php echo $id;?>"/>
	  <input type="hidden" name="getrid" value="<?php echo $row['did'];?>"/>
        <label>Subject: </label><input type="text" class="form-control" value="<?php echo $row['sub'];?>" name="resub"/>
		<br>
		<label>Message: </label>
		<textarea rows="5" col="5" name="msg" placeholder="Enter your message" class="form-control"></textarea>
		<br>
		<input type="hidden" name="getmid" value="<?php echo $row['rid'];?>"/>
		<input type="submit" name="reply" class="btn btn-success" value="Reply"/>
		</form>
			
      </div>
    </div>
  </div>
</div>
		
		</td>
		</tr>
	<?php }elseif($sts == "read"){ ?>
		<tr>
		<tr><td>&nbsp;</td></tr>
		<td align="center" width="20%">Dr. <?php echo $row2['name'];?></td>
		<td align="center" width="20%"><?php echo $row['sub'];?></td>
		<td align="center" width="45%"><a data-toggle="modal" href="#viewmsg<?php echo $row['rid']?>">View Message</a>
		<div class="modal fade" id="viewmsg<?php echo $row['rid'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Message From Dr. <?php echo $row2['name'];?></h4>
      </div>
      <div class="modal-body">
	  
	 <?php
	  $d = $row['dte'];
	  $t = $row['tme'];
	  $date = date("d-M-Y", strtotime($d));
	  $time = date("h:i A", strtotime($t));
	  ?>
	  <blockquote style="font-family:calibri;text-align:justify;">
	  <font style="font-size:15px;">Sent By Dr.<?php echo $row2['name'];?> on <?php echo $date;?> • <?php echo $time;?></font> <br><?php echo $row['msg'];?>
	  </blockquote>
			
      </div>
    </div>
  </div>
</div>

		</td>
		<td align="center" width="20%"><a data-toggle="modal" href="#rmodal<?php echo $row['rid'];?>" >Reply</a>
		
		<div class="modal fade" id="rmodal<?php echo $row['rid'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Reply to Message From Dr. <?php echo $row2['name'];?></h4>
      </div>
      <div class="modal-body">
	  <form action="rmsg2.php" method="POST" >
	  <input type="hidden" name="getsid" value="<?php echo $id;?>"/>
	  <input type="hidden" name="getrid" value="<?php echo $row['did'];?>"/>
        <label>Subject: </label><input type="text" class="form-control" value="<?php echo $row['sub'];?>" name="resub"/>
		<br>
		<label>Message: </label>
		<textarea rows="5" col="5" name="msg" placeholder="Enter your message" class="form-control"></textarea>
		<br>
		<input type="hidden" name="getmid" value="<?php echo $row['rid'];?>"/>
		<input type="submit" name="reply" class="btn btn-success" value="Reply"/>
		</form>
			
      </div>
    </div>
  </div>
</div>
		
		</td>
		</tr>
		<?php } ?>
		<?php
	}
	}
	
	?>
	</table>
	</div>
	
    <div role="tabpanel" class="tab-pane fade in" id="compose">
	
	<form method="POST" action="sendmsg.php">
	<br>
	<div style="float:left; margin-left:2%; width:70%;" class="well">
	<label>Choose Doctor Type : </label>
	<select style="color:solid #ccc; border-radius:0.2em; padding:5px;" name="doccat2" onchange="getIdd(this.value);">
		<option value="Choose">Choose</option>
		<?php 
		$qu = "SELECT DISTINCT specialist FROM doctor WHERE status='success'";
		$res = mysqli_query($con,$qu);
		while($row=mysqli_fetch_assoc($res)){
		?>
		<option value="<?php echo $row['specialist']; ?>"><?php echo $row['specialist']; ?></option>
		<?php }?>
		</select>
		<br><br>
	<label>Choose Doctor : </label>
		<select style="color:solid #ccc; border-radius:0.2em; padding:5px;" name="docho2" id="doclist2">
		<option value="Choose">Choose</option>
		</select>
		<br></br>
		<label>Subject : </label> <input type="text" name="sub" required placeholder="Enter your subject name" class="form-control"/><br>
		<label>Message : </label><textarea name="msg" required placeholder="Enter your message" class="form-control"/></textarea><br>
		<input name="senderid" type="hidden" value="<?php echo $id;?>"/>
		<input type="submit" value="Send" name="submit" class="btn btn-success"/> 
	</form>
	</div>
	</div>
    <div role="tabpanel" class="tab-pane fade in" id="sent">
	<br>
	<table border="0" cellspacing="0" width="800px">
	<tr>
	<th style="text-align:center; padding:5px; background:red; color:white; border:1px solid red;">To </th>
	<th style="text-align:center; padding:5px; background:red; color:white; border:1px solid red;">Subject</th>
	<th style="text-align:center; padding:5px; background:red; color:white; border:1px solid red;">Message</th>
	</tr>
	<?php
	$q = "SELECT * from sentmsg WHERE sid='$id' ORDER BY `mid` DESC";
	$r = mysqli_query($con,$q);
	
	
	while($row = mysqli_fetch_assoc($r)){
		
		$docid = $row['did'];
		
		$q2 = "SELECT * from doctor WHERE did='$docid' ";
		$r2 = mysqli_query($con,$q2);
		
		while($row2 = mysqli_fetch_assoc($r2)){
		?>
		<tr><td><br></td></tr>
		<tr>
		
		<td align="center" width="20%" >Dr. <?php echo $row2['name'];?></td>
		<td align="center" width="20%"><?php echo $row['subject'];?></td>
		<td align="justify" width="50%"><?php echo $row['msg'];?></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<?php
	}
	}
	
	?>
	</table>
	</div>
   </div>

</div>

	</div>
    <div role="tabpanel" class="tab-pane fade" id="profile">
	<br></br>
	<div class="row">
	<br>
	<div class="col-md-6" style="width:45%;">
	<div class="well">
	<b><i><span class="glyphicon glyphicon-user"></span> Your Current Profile</i></b>
	<br></br>
	<?php
	$dir = "patient/".$adhar."/img/";
	$open = opendir($dir);

	while(($files = readdir($open)) != FALSE){
	$altu = $_SESSION['useremail'];
	if($files!="."&&$files!=".."&&$files !="Thumbs.db"){
		echo "<center>
		<img id='hello' style=border-radius:6em;' width='150' height='150' title='$newname' src='$dir/$files'></center>";
		echo "<a data-toggle='modal' class='editpro' title='Edit your profile picture' href='#profilepic'><span  style='margin-top:-5%;margin-right:80px;font-size:18px; float:right' class='glyphicon glyphicon-camera'></span></a><br></br>";
	}
	
	
	}
	?>
	<label>Name : </label> <?php echo $newname;?><hr style="border-color:#BCBCBC; margin-top:-0.2%;">
	<label>Age : </label> <?php echo $age;?><hr style="border-color:#BCBCBC; margin-top:-0.2%;">
	<label>Gender : </label> <?php echo $sex;?><hr style="border-color:#BCBCBC; margin-top:-0.2%;">
	<label>Email : </label> <?php echo $email;?><hr style="border-color:#BCBCBC; margin-top:-0.2%;">
	<label>Address : </label> <?php echo $add;?><hr style="border-color:#BCBCBC; margin-top:-0.2%;">
	<label>Aadhar No : </label> <?php echo $adhar;?><hr style="border-color:#BCBCBC; margin-top:-0.2%;">
	<label>Phone No : </label> <?php echo $ph;?><br>
	</div>
	</div>
	
	<div class="col-md-3" style="width:50%;" >
	<div class="well">
	<b><i><span class="glyphicon glyphicon-pencil"></span> Edit Current Profile</i></b>
	<br></br>
	<form action="" method="POST" id="ep"> 
	<?php require_once('includes/updatepatient.php');?>
	<input type="hidden" name="id" value="<?php echo $id;?>"/>
	<label>Name : </label><input type="text" class="form-control" onkeyup="letters(this)" name="newname" placeholder="<?php echo $newname;?>"/><br>
	<label>Email : </label><input type="text" class="form-control" name="newemail" placeholder="<?php echo $email;?>"/><br>
	<label>Password : </label><input type="password" class="form-control" name="newpass" placeholder="Leave blank if you dont want to change" /><br>
	<label>Age : </label><input type="number" class="form-control" name="newage" placeholder="<?php echo $age;?>"/><br>
	<label>Address : </label><textarea class="form-control" name="newadd" placeholder="<?php echo $add;?>"/></textarea><br>
	<label>Phone No. : </label><input type="number" class="form-control" name="newphone" placeholder="<?php echo $ph;?>"/><br>
	<input type="submit" name="btn_edit" class="btn btn-info"/> 
	<input type="button" value="Reset" onclick="rset()" class="btn btn-danger"></center>
	</form>
	</div>
	</div>
	
	</div>
	</div>
  </div>
</div>
</div>
	</div>
	
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	
	<script>
	function rset() {
    document.getElementById("ep").reset();
	}
	
	function rset1() {
    document.getElementById("res").reset();
	}
	
	$(function () {
	$('[data-toggle="tooltip"]').tooltip()
	});
	
	function letters(input) {
    var regex = /[^ a-z]/gi;
    input.value = input.value.replace(regex, "");
	}
	
	function letters1(input) {
    var regex = /[^ a-z]/gi;
    input.value = input.value.replace(regex, "");
	}
	
	function getId(val){
		$.ajax({
		type: "POST",
		url : "getdata.php",
		data: "specialist="+val,
		success: function(data){
			$("#doclist").html(data);
		}
		});
		
	}
	
	function getIdd(val){
		$.ajax({
		type: "POST",
		url : "getdata.php",
		data: "specialist="+val,
		success: function(data){
			$("#doclist2").html(data);
		}
		});
		
	}
	
	 $( function() {
    $( "#datepicker" ).datepicker({
		dateFormat: "yy-m-dd",
		minDate: 0,
		maxDate: 4,
	});
  } );
  


</script>
<script>/*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}*/

$('#datetimepicker').datetimepicker({
	datepicker:false,
	format:'H:i',
    formatTime: 'h:i A',
	allowTimes:['09:00','09:15','9:30','9:45','10:00','10:15','10:30','10:45','11:00','11:15','11:30','11:45','12:00','12:15','12:30','12:45',
				'14:00','14:15','14:30','14:45','15:00','15:15','15:30','15:45','16:00','16:15','16:30','16:45','17:00','17:15','17:30','17:45','18:00'],
	step:5
});

</script>
	
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
<!-- Modal -->
<div class="modal fade" id="profilepic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Change Profile Picture</h4>
      </div>
      <div class="modal-body">
 
<form method="POST" ENCTYPE="multipart/form-data" action="profilechange.php">
<label>Choose a new profie picture</label>
<input type="file" class="form-control" name="newupload">
<hr>
		
		<input type="submit" class="btn btn-primary" value="Update" name="submit"/>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
     
</form>

	
      </div>
      
    </div>
  </div>
</div>
</html>
<?php
}else{
	echo "<div align='center' style='font-family : calibri; color:white; background:#D20D0D; padding:15px;'>You're Not a Patient</div>";
}
}
}
?>
