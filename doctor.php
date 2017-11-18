<?php
session_start();
if(isset($_SESSION['useremail'])||isset($_COOKIE['dpp'])){
if(!isset($_SESSION['useremail'])){
	echo "<div align='center' style='font-family : calibri; color:white; background:#D20D0D; padding:15px;'>Access Denied ! </div>";
}else{
$email = $_SESSION['useremail'];
include('includes/conn.php');
$query = "SELECT * FROM doctor WHERE email ='".$email."'";
$rec = mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($rec)){
	$id = $row['did'];
	$newname=$row['name'];
	$age= $row['age'];
	$sts = $row['status'];
	$sex = $row['gender'];
	$email = $row['email'];
	$type = $row['type'];
	$add = $row['address'];
	$ph = $row['phone_number'];
	$gender= $row['gender'];
	$adhar = $row['adrid'];
	$docid = $row['docid'];
	$st = $row['availability'];
}


if(@$type == "doc"){
	
	if($sts == "fail"){
		echo "<div align='center' style='font-family : calibri; color:white; background:#D20D0D; padding:15px;'>
			Your Account is under review it may take up to 3 or 4 days to verify !</div>";
	}elseif($sts == "success"){
		
	
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
	$q3 = "SELECT COUNT(*) as cnt FROM sentmsg where did='$id' AND status = 'unread' ";
	$r2 = mysqli_query($con,$q3);
	$res = mysqli_fetch_array($r2);
	$pen = $res ['cnt'];
	?>
  <!-- Nav tabs -->
  <ul style="margin-top:-12%;" class="nav nav-stacked nav-pills nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#apt" aria-controls="apt" role="tab" data-toggle="tab"><span style="color:#5DC91A" class="glyphicon glyphicon-paste"></span>&nbsp;&nbsp;Today's Appointments</a></li>
    <li role="presentation"><a href="#upapt" aria-controls="apt" role="tab" data-toggle="tab"><span style="color:#EB1212" class="glyphicon glyphicon-time"></span>&nbsp;&nbsp;Upcoming Appointments</a></li>
    <li role="presentation"><a href="#missapt" aria-controls="apt" role="tab" data-toggle="tab"><span style="color:#5DC91A" class="glyphicon glyphicon-minus"></span>&nbsp;&nbsp;Missed Appointments</a></li>
    <li role="presentation"><a href="#comap" aria-controls="comap" role="tab" data-toggle="tab"><span style="color:#5DC91A" class="glyphicon glyphicon-ok-circle"></span>&nbsp;&nbsp;Completed Appointments</a></li>
    <li role="presentation"><a href="#canap" aria-controls="canap" role="tab" data-toggle="tab"><span style="color:#EB1212" class="glyphicon glyphicon-remove-circle"></span>&nbsp;&nbsp;Canceled Appointments</a></li>
    <li role="presentation"><a href="#feed" aria-controls="feed" role="tab" data-toggle="tab"><span style="color:#5DC91A" class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;View Feedbacks</a></li>
	<li role="presentation"><a href="#msger" aria-controls="msg" role="tab" data-toggle="tab"><span style="color:#5DC91A" class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;Messenger <span class="badge"><?php echo $pen;?></span></a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><span style="color:#1754AB" class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;Your Profile</a></li>
  </ul>
</div>
  <!-- Tab panes -->
  <div class="col-md-9">
  <div style="margin-top:-10%;" class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="apt">
	<br></br>
	<br>
	<table class="tt table-hover" border="1" cellspacing="0">
	<tr>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">Appointment ID</th>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">Appointment Date</th>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">Appointment Time</th>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">Patient Name</th>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">View Previous Report Uploaded By Patient</th>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">Appointment Status</th>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">Complete</th>
			<?php
			$qq1 = "SELECT * FROM appointments where a_date=CURRENT_DATE AND a_time>CURRENT_TIME AND status='pending' ";
		$rrr = mysqli_query($con,$qq1);
		while($rows = mysqli_fetch_assoc($rrr)){
			$ttid = $rows['tid'];
		}
		if(@$ttid !=""){?>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">Trans. ID</th>
		<?php } ?>
		</tr>
		<?php
		include('includes/conn.php');
		
		$q1 = "SELECT * FROM appointments where a_date=CURRENT_DATE AND a_time>CURRENT_TIME AND status='pending' ";
		$r = mysqli_query($con,$q1);
		while($row = mysqli_fetch_assoc($r)){
			$aid = $row['id'];
			$did = $row['doc_id'];
			$docid = $row['doc_id'];
			$patid = $row['pat_id'];
			$ad= $row['a_date'];
			$apt = $row['a_time'];
			$s = $row['status'];
			$pname = $row['pname'];
			$tid = $row ['tid'];
			$rpath= $row['pre_reprt'];
		   $dt = date("d-M-Y", strtotime($ad));
		   $tt  = date("h:i A", strtotime($apt));
		   
			$q2 = "SELECT * FROM patient where pid = '$patid' ";
			$r1 = mysqli_query($con,$q2);
			
			
			
			
			if($id == $did ){
				
			if($tid == ""){
				echo "<div class='alert alert-info'><b>No Appointments Pending</b></div>";
			}else{
			?>
			<tr><td style="font-size:13px;text-align:center;"><?php echo $aid;?></td>
			<td style="font-size:13px;text-align:center;"><?php echo $dt ;?></td>
			<td style="font-size:13px;text-align:center;"><?php echo $tt;?></td>
			<td style="font-size:13px;text-align:center;"><?php echo $pname ?></td>
			<td style="text-align:center;"><?php if($rpath ==""){ 
			echo "No report uploaded by Patient";
			}else{?><a target="_blank" href="<?php echo $rpath;?>">View Report</a>
			<?php } ?></td>
			<td style="font-size:13px;text-align:center;"><?php echo $s; ?></td>
			<td style="font-size:13px;text-align:center; "><a href="complete.php?aid=<?php echo $row['id'];?>"  onclick="return confirm('Appointment Complete?')">
		Complete</a></td>
			<?php 
				if($tid != ""){
					echo "<td style='font-size:13px;'>$tid</td>";
				}
			?>
			</tr>
			<?php
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
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">Appointment ID</th>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">Appointment Date</th>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">Appointment Time</th>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">Patient Name</th>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">View Previous Report Uploaded By Patient</th>
		<?php
			$qq1 = "SELECT * FROM appointments where a_date>CURRENT_DATE AND status='pending' ";
		$rrr = mysqli_query($con,$qq1);
		while($rows = mysqli_fetch_assoc($rrr)){
			$ttid = $rows['tid'];
		}
		if(@$ttid !=""){?>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">Trans. ID</th>
		<?php } ?>
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
			$rpath = $row['pre_reprt'];
		    $dt = date("d-M-Y", strtotime($ad));
		    $tt  = date("h:i A", strtotime($apt));
		   
			
			
			
			
			if($id == $docid ){
			
			if($tid == ""){
				echo "<div class='alert alert-info'><b>No Upcoming Appointments are Pending</b></div>";
			}
	else{
			?>
			<tr><td style="font-size:13px;text-align:center;"><?php echo $aid;?></td>
			<td style="font-size:13px;text-align:center;"><?php echo $dt ;?></td>
			<td style="font-size:13px;text-align:center;"><?php echo $tt;?></td>
			<td style="font-size:13px;text-align:center;"><?php echo $name;?></td>
			<td style="font-size:13px;text-align:center;"><?php if($rpath ==""){ 
			echo "No report uploaded by Patient";
			}else{?><a target="_blank" href="<?php echo $rpath;?>">View Report</a>
			<?php } ?></td>

			<?php 
				if($tid != ""){
					echo "<td align='center'>$tid</td>";
				}
			?>

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
		<th width="15%" style="text-align:center; color:white; background:#E90303;">Patient Name</th>
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
		   
			
			
			
			
			if($id == $docid ){
				
			if($tid !=""){
			?>
			<tr><td style="text-align:center;"><?php echo $aid;?></td>
			<td style="text-align:center;"><?php echo $dt ;?></td>
			<td style="text-align:center;"><?php echo $tt;?></td>
			<td style="text-align:center;"><?php echo $name;?></td>
			<td style="text-align:center;"><?php echo "Missed"; ?></td>

			</tr>
			<?php
			}
		}
		}
		
		
		?>
	</tr>
	</table>
	
	
	
	</div>
	
  
	
	<div role="tabpanel" class="tab-pane fade" id="comap">
	<br></br>
	<br>
	<table class="tt table-hover" border="1" cellspacing="0">
	<tr>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">Appointment ID</th>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">Appointment Date</th>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">Appointment Time</th>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">Patient Name</th>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">View Previous Reports Uploaded By Patient</th>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">Appointment Status</th>
		<th width="15%" style="font-size:13px;text-align:center; color:white; background:#E90303;">Trans .ID</th>
		
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
			
			
			if($id == $docid ){

			?>
			<tr><td style="font-size:13px;text-align:center;"><?php echo $aid;?></td>
			<td style="font-size:13px;text-align:center;"><?php echo $dt ;?></td>
			<td style="font-size:13px;text-align:center;"><?php echo $tt;?></td>
			<td style="font-size:13px;text-align:center;"><?php echo $name;?></td>
			<td style="text-align:center;"><?php if($rpath ==""){ 
			echo "No report uploaded by Patient";
			}else{?><a target="_blank" href="<?php echo $rpath;?>">View Report</a>
			<?php } ?></td>
			<td style="font-size:13px;text-align:center;"><?php echo $s; ?></td>
			<?php echo "<td style='font-size:13px;' align='center'>$tid</td>";?>
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
		</tr>
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
		
			if($id == $docid ){

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
	<div role="tabpanel" class="tab-pane fade" id="feed">
	<br></br>
	<h4>Feebacks From Patient :</h4> 
		<?php
	$fq = "SELECT * FROM feedback where did = '$id' ";
	$fres = mysqli_query($con,$fq);
	while($frow = mysqli_fetch_assoc($fres)){
		$fpid = $frow['pid'];
		$feed = $frow ['feed'];
		$dt = $frow['dt'];
		
		$date = date("d-M-Y", strtotime($dt));
		$fp = "SELECT * FROM patient where pid ='$fpid'";
		$fpres = mysqli_query($con,$fp);
		
		while($fprow = mysqli_fetch_assoc($fpres)){
			$name = $fprow['name'];
			$adrid = $fprow['adharno'];
			?>
			<div style="text-align:justify" class="well">
				<?php
	$dir = "patient/".$adrid."/img/";
	$open = opendir($dir);

	while(($files = readdir($open)) != FALSE){
	if($files!="."&&$files!=".."&&$files !="Thumbs.db"){
		echo "
		<img style=border-radius:6em;' width='38' height='38' title='$name' src='$dir/$files'>&nbsp;&nbsp;Given by <b>$name</b> on <font style='font-family:calibri'>$date</font><br><br>  ";
	}
	
	
	}
	?>
			<font style="font-family:calibri;"><?php echo "$feed";?></font>
			</div>
			<?php
		}
	}
	?>
      
	</div>
	<div role="tabpanel" class="tab-pane fade" id="msger">
	<br></br>
<br>	
	<div>
	
  <!-- Nav tabs -->
  <ul class="nav nav-pills" role="tablist">
    <li role="presentation" class="active"><a href="#inbox" aria-controls="inbox" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-comment"></span> Inbox <span style="background:red; color:white; border:1px white dotted;" class="badge"><?php echo $pen;?></span></a></li>
    <li role="presentation"><a href="#sent" aria-controls="sent" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-new-window"></span> Sent</a></li>
   
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="inbox">
	<br>
	<table border="0" cellspacing="0" width="800px">
	<tr>
	<th style="text-align:center; padding:5px; background:red; color:white; border:1px solid red;">&nbsp;</th>
	<th style="text-align:center; padding:5px; background:red; color:white; border:1px solid red;">From</th>
	<th style="text-align:center; padding:5px; background:red; color:white; border:1px solid red;">Subject</th>
	<th style="text-align:center; padding:5px; background:red; color:white; border:1px solid red;">Message</th>
	<th style="text-align:center; padding:5px; background:red; color:white; border:1px solid red;">Reply</th>
	</tr>
	<?php
	$q = "SELECT * FROM `sentmsg` where did='$id' ORDER BY `mid` DESC ";
	$r = mysqli_query($con,$q);
	
	
	
	while($row = mysqli_fetch_assoc($r)){
		$sts = $row['status'];
		$sid = $row['sid'];
		$mid = $row['mid'];
		
		$q2 = "SELECT * from patient WHERE pid='$sid' ";
		$r2 = mysqli_query($con,$q2);
		
		foreach ($r2 as $row2){
			$pat_dp = $row2['adharno'];
			if($sts == "unread"){
		?>
		
		
		<tr>
		<tr><td>&nbsp;</td></tr>
		<td width="20%" align="center">	
	<?php
	$dir = "patient/".$pat_dp."/img/";
	$open = opendir($dir);

	while(($files = readdir($open)) != FALSE){
	$altu = $_SESSION['useremail'];
	if($files!="."&&$files!=".."&&$files !="Thumbs.db"){
		echo "<img style=border-radius:6em;' width='50' height='50' title='$newname' src='$dir/$files'></center>";
	}
	
	
	}
	?>
	
		</td>		
		<td align="center" width="20%;"><b><?php echo $row2['name'];?></b></td>
		<td align="center" width="20%;"><b><?php echo $row['subject'];?></b></td>
		<td align="center" width="45%"><b><a href="#readmsg<?php echo $row['mid'];?>" data-toggle="modal">View Message</a></b>
		
			<div class="modal fade" id="readmsg<?php echo $row['mid'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Message From <?php echo $row2['name'];?></h4>
      </div>
      <div class="modal-body">
	  <?php
	  $d = $row['dte'];
	  $t = $row['tme'];
	  $date = date("d-M-Y", strtotime($d));
	  $time = date("h:i A", strtotime($t));
	  $st = "read";
	  $testq = "UPDATE sentmsg set status ='$st' where mid ='$mid' ";
	  $reslt = mysqli_query($con,$testq);
	  ?>
	  <blockquote style="font-family:calibri;text-align:justify;">
	  <font style="font-size:15px;">Sent By <?php echo $row2['name'];?> on <?php echo $date;?> • <?php echo $time;?></font> <br><?php echo $row['msg'];?>
	  </blockquote>
			
      </div>
    </div>
  </div>
</div>
		
		</td>
		<td align="center" width="20%;"><a data-toggle="modal" href="#rmodal<?php echo $row['mid'];?>" >Reply</a>
		
		<div class="modal fade" id="rmodal<?php echo $row['mid'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Reply to Message From <?php echo $row2['name'];?></h4>
      </div>
      <div class="modal-body">
	  <form action="rmsg.php" method="POST" >
	  <input type="hidden" name="getsid" value="<?php echo $id;?>"/>
	  <input type="hidden" name="getrid" value="<?php echo $row['sid'];?>"/>
        <label>Subject: </label><input type="text" class="form-control" value="Re: <?php echo $row['subject'];?>" name="resub"/>
		<br>
		<label>Message: </label>
		<textarea rows="5" col="5" name="msg" placeholder="Enter your message" class="form-control"></textarea>
		<br>
		<input type="hidden" name="getmid" value="<?php echo $row['mid'];?>"/>
		<input type="submit" name="reply" class="btn btn-success" value="Reply"/>
		</form>
			
      </div>
    </div>
  </div>
</div>
		
		</td>
		</tr>
	<?php }elseif($sts == "read"){ ?>
		
		<tr><td>&nbsp;</td></tr>
		<tr>
		<td width="20%" align="center">	
	<?php
	$dir = "patient/".$pat_dp."/img/";
	$open = opendir($dir);

	while(($files = readdir($open)) != FALSE){
	$altu = $_SESSION['useremail'];
	if($files!="."&&$files!=".."&&$files !="Thumbs.db"){
		echo "<img style=border-radius:6em;' width='50' height='50' title='$newname' src='$dir/$files'></center>";
	}
	
	
	}
	?>
	
		</td>
		<td align="center" width="20%;"><?php echo $row2['name'];?></td>
		<td align="center" width="20%;"><?php echo $row['subject'];?></td>
		<td align="center" width="45%"><a href="#readmsg<?php echo $row['mid'];?>" data-toggle="modal">View Message</a>
		
			<div class="modal fade" id="readmsg<?php echo $row['mid'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Message From <?php echo $row2['name'];?></h4>
      </div>
      <div class="modal-body">
	  
	  <?php
	  $d = $row['dte'];
	  $t = $row['tme'];
	  $date = date("d-M-Y", strtotime($d));
	  $time = date("h:i A", strtotime($t));
	  ?>
	  <blockquote style="font-family:calibri;text-align:justify;">
	  <font style="font-size:15px;">Sent By <?php echo $row2['name'];?> on <?php echo $date;?> • <?php echo $time;?></font> <br><?php echo $row['msg'];?>
	  </blockquote>
			
      </div>
    </div>
  </div>
</div>
		
		</td>
		<td align="center" width="20%;"><a data-toggle="modal" href="#rmodal<?php echo $row['mid'];?>" >Reply</a>
		
		<div class="modal fade" id="rmodal<?php echo $row['mid'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Reply to Message From <?php echo $row2['name'];?></h4>
      </div>
      <div class="modal-body">
	  <form action="rmsg.php" method="POST" >
	  <input type="hidden" name="getsid" value="<?php echo $id;?>"/>
	  <input type="hidden" name="getrid" value="<?php echo $row['sid'];?>"/>
        <label>Subject: </label><input type="text" class="form-control" value="<?php echo $row['subject'];?>" name="resub"/>
		<br>
		<label>Message: </label>
		<textarea rows="5" col="5" name="msg" placeholder="Enter your message" class="form-control"></textarea>
		<br>
		<input type="hidden" name="getmid" value="<?php echo $row['mid'];?>"/>
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
    
    <div role="tabpanel" class="tab-pane fade in" id="sent">
	<table border="0" cellspacing="0" width="800px">
	<tr>
	
	<th style="text-align:center; padding:5px; background:red; color:white; border:1px solid red;">To </th>
	<th style="text-align:center; padding:5px; background:red; color:white; border:1px solid red;">Subject</th>
	<th style="text-align:center; padding:5px; background:red; color:white; border:1px solid red;">Message</th>
	</tr>
	
	
	<br>
	<?php 
	$qr = "SELECT * FROM `rmsg` where did='$id' ORDER BY `rid` DESC ";
	$rr = mysqli_query($con,$qr);
	
	while($res = mysqli_fetch_assoc($rr)){
		
		$patid = $res['sid'];
		
		$q2 = "SELECT * from patient WHERE pid='$patid' ";
		$r2 = mysqli_query($con,$q2);
		
		while($row2 = mysqli_fetch_assoc($r2)){
		?>
		<tr>
		
		<tr><td>&nbsp;</td></tr>
		
		<td align="center" width="5%;"><input type="checkbox" name="chk" value="<?php echo $res['rid'];?>"></td>
		<td align="center" width="5%;"><?php echo $row2['name'];?></td>
		<td align="center" width="10%;"><?php echo $res['sub'];?></td>
		<td align="justify" width="10%"><?php echo $res['msg'];?></td>
		
		</tr>
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
	<br><br><br>
	<div class="alert alert-success">
	
	<div class="row">
	<div class="col-md-6">
	
	Current Status : 
	<?php 
	if($st == ""){
		echo "<span style='color:red'>Set your status first</span>";
	}else{
		echo $st;
	}
	?>
	</div>
	
	<div class="col-md-6">
	<form method="POST" action="updatestatus.php">
	<input type="hidden" name="getupid" value="<?php echo $id;?>"/>
	<input type="radio" name="update" value="Available"> Available
	<input type="radio" name="update" value="Not Available"> <span style="color:red;">Not Available</span>&nbsp;
	<input type="submit" value="Update" name="updt" class="btn btn-info"/>
	</form>
	</div>
	
	</div>
	
	</div>
	<div style="margin-top:-2%;" class="row">
	<br>
	<div class="col-md-6" style="width:45%;">
	
	<div class="well">
	<b><i><span class="glyphicon glyphicon-user"></span> Your Current Profile</i></b>
	<br></br>
	<?php
	$query = "SELECT * FROM doctor where email ='$email' ";
	$result = mysqli_query($con,$query);
	while($rows = mysqli_fetch_assoc($result)){
		$docs_id = $rows['docid'];
	}
	
	$dir = "doctor/".$docs_id."/img/";
	$open = opendir($dir);
	
	while(($files = readdir($open)) != FALSE){
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
	<?php require_once('includes/updatedoctor.php');?>
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
 
<form method="POST" ENCTYPE="multipart/form-data" action="profilechange2.php">
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
<?php }}?>
<?php
}
}else{
	echo "<div align='center' style='font-family : calibri; color:white; background:#D20D0D; padding:15px;'>You're Not a Patient</div>";
}

?>
