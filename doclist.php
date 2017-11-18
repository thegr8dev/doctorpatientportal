
<?php
session_start();
if(isset($_POST['btn_login'])){
$useremail = $_POST['useremail'];	
$userpass =  $_POST['userpass'];

include('includes/conn.php');

$q1 = "SELECT * FROM doctor where email = '$useremail'";
$q2 = "SELECT * FROM patient where email = '$useremail'";
$q3 = "SELECT * FROM admin where email = '$useremail'";

$r = mysqli_query($con, $q1);
$rr = mysqli_query($con, $q2);
$ad = mysqli_query($con, $q3);

if(mysqli_num_rows($r)>0){
	while($row = mysqli_fetch_assoc($r)){
		$dbname = $row['name'];
		$dbemail = $row['email'];
		$dbpass = $row['password'];
		$type = $row['type'];
	}
	if($useremail == $dbemail && $userpass == $dbpass){
		$_SESSION['useremail'] =$useremail;
		$_SESSION['userpass'] = $userpass;
		header("location:doctor.php");
	}
	else
	{
		echo "<script>";
	echo "alert('Wrong Doctor Email or Password')";
	echo "</script>";
	}
	
}elseif(mysqli_num_rows($rr)>0){
	while($row = mysqli_fetch_assoc($rr)){
		$dbid = 	@$row['id'];
		$dbname = $row['name'];
		$dbemail = $row['email'];
		$dbpass = $row['password'];
		$type = $row['type'];
	}
	if($useremail == $dbemail && $userpass == $dbpass){
		$_SESSION['useremail'] =$useremail;
		$_SESSION['userpass'] = $userpass;
		$_SESSION['status'] = "Success";
		
		header("location:doclist.php");
	}
	else{
		echo "<script>";
	echo "alert('Wrong Patient Email or Password')";
	echo "</script>";
	}
}
elseif(mysqli_num_rows($ad)>0){
	while($row = mysqli_fetch_assoc($ad)){
		$dbname = $row['name'];
		$dbemail = $row['email'];
		$dbpass = $row['password'];
		}
		if($useremail == $dbemail && $userpass == $dbpass){
			$_SESSION['useremail'] = $useremail;
			$_SESSION['userpass'] = $userpass;
			$_SESSION['status'] = "Success";
			header("location:adminpanel.php");
			
		}else{
			echo "<script>";
		echo "alert('Wrong admin Email or Password')";
		echo "</script>";
		}
		
}



else{
	echo "<script>";
	echo "alert('Account not exist')";
	echo "</script>";
}

}
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
    <title>Doctor List -  Doctor Patient Portal</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="theme/home.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <style>
  .navbar-inverse .navbar-nav > .open > a, .navbar-inverse .navbar-nav > .open > a:focus, .navbar-inverse .navbar-nav > .open > a:hover{
	background-color:green;
	border-top-left-radius:1em;
	border-top-right-radius:1em;
}

.navbar-inverse .navbar-nav > .open > a:hover{
	 background-color:red;
	 border-top-left-radius:1em;
	 border-top-right-radius:1em;
	 border-bottom-left-radius:0em;
	 border-bottom-right-radius:0em;
 }
 
 .tt th{
	 width:500px;
	 color:white;
	 font-weight:400;
	 padding:5px;
	 background:#E90303;
	 border:1px solid black;
 }
 
 .tt td{
	 border:1px solid black;
	 text-align:center;
 }
  </style>
  <body>
	<br>
	<?php
	include('includes/conn.php');
	@$eml = $_SESSION['useremail'];
	$qry = "SELECT * FROM doctor where email = '$eml'";
	$qry2 = "SELECT * FROM patient where email = '$eml'";
	$qry3 = "SELECT * FROM admin where email = '$eml'";
	$h = mysqli_query($con, $qry);
	$h2 = mysqli_query($con, $qry2);
	$h3 = mysqli_query($con, $qry3);
	while($row = mysqli_fetch_assoc($h)){
		$id = $row['did'];
		$user = $row['name'];
		$type = $row['type'];
		$docpd = $row['docid'];
		$age = $row['age'];
		$phone = $row['phone_number'];
		$email = $row['email'];
		$sex = $row['gender'];
	}
	while($row = mysqli_fetch_assoc($h2)){
		$pid = $row['pid'];
		$user = $row['name'];
		$type = $row['type'];
		$patid = $row['pid'];
		$agep = $row['age'];
		$mob = $row['phone'];
		$sexp = $row['gender'];
		$adrid = $row['adharno'];
		$emailp = $row['email'];
	}
	while($row = mysqli_fetch_assoc($h3)){
		$user = $row['name'];
		$type = $row['type'];
	}
	?>

	<?php if(@$type != "doc"){?>
	<?php if(!isset($_SESSION['useremail'])){?>

    <div  style="padding:25px; border-top-left-radius:0.5em; border-top-right-radius:0.5em;" class="mainmenu container nav navbar-inverse" data-spy="affix" data-offset-top="100">
	<button type="button" style="background:#005173; border-color:#005173;" class="navbar-toggle" data-toggle="collapse" data-target="#coo">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand"><img width="85px" height="85px" style="margin-top:-38%;" title="Doctor Patient Portal" class="logomain" src="img/logom.png"/></a>
	<div class="collapse navbar-collapse" id="coo">
	
	
	<ul class="nav navbar-nav pull-right">
	<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
	<li><a href="about.php"><span class="glyphicon glyphicon-info-sign"></span> About</a></li>
	<li><a href="contact.php"><span class="glyphicon glyphicon-earphone"></span> Contact Us</a></li>
	<li><a href="help.php"><span class="glyphicon glyphicon-question-sign"></span> Help</a></li>
	<li class="a"><a data-toggle="modal" data-target="#login" href="#"><span class="glyphicon glyphicon-user"></span> Login</a></li>
	<li class="ar"><a data-toggle="modal" data-target="#register" href="#"><span class="glyphicon glyphicon-registration-mark"></span> Register</a></li>
	</ul>
	</div>
	
	</div><?php }else{
		?>
	 <div  style="padding:25px; border-top-left-radius:0.5em; border-top-right-radius:0.5em;" class="mainmenu container nav navbar-inverse" data-spy="affix" data-offset-top="100">
	<button style="border:0px;" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#co">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand"><img width="85px" height="85px" style="margin-top:-38%;" title="Doctor Patient Portal" class="logomain" src="img/logom.png"/></a>
	
	<div id="co" class="collapse navbar-collapse">
	<ul class="nav navbar-nav pull-right">
	<li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
	<li><a href="about.php"><span class="glyphicon glyphicon-info-sign"></span> About</a></li>
	<li><a href="contact.php"><span class="glyphicon glyphicon-earphone"></span> Contact Us</a></li>
	<li><a href="help.php"><span class="glyphicon glyphicon-question-sign"></span> Help</a></li>
	<?php if($type=="doc"){?>
	<li class="a" ><a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Hi <?php echo $user?>
	<span class="caret"></span></a>
	<ul class="dropdown-menu">
    <li><a data-toggle="modal" data-target="#profiletab" href="#"><span class="glyphicon glyphicon-pencil"></span> Your Profile</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="doctor.php"><span class="glyphicon glyphicon-th-list"></span> Your Dashboard</a></li>
	<li role="separator" class="divider"></li>
	 <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
  </ul>
	
	
	</li>
	<?php } ?>
	<?php if($type=="pat"){?>
	<li class="a" ><a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Hi <?php echo $user?>
	<span class="caret"></span></a>
	<ul  class="dropdown-menu">
    <li><a data-toggle="modal" data-target="#profiletab2"><span class="glyphicon glyphicon-pencil"></span> Your Profile</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="patient.php"><span class="glyphicon glyphicon-th-list"></span> Your Dashboard</a></li>
	<li role="separator" class="divider"></li>
	 <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
  </ul>
	
	
	</li>
	<?php } ?>
	<?php if($type=="admin"){?>
	<li class="a" ><a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Hi <?php echo $user?>
	<span class="caret"></span></a>
	<ul class="dropdown-menu">
    <li><a href="adminpanel.php"><span class="glyphicon glyphicon-th-list"></span> Your Dashboard</a></li>
	<li role="separator" class="divider"></li>
	 <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
  </ul>
	
	
	</li>
	<?php } ?>
	</div>
	</ul>
	
	</div>

		<?php } ?>
	<div class="container">
	<div style="float:left; margin-left:-1.2%;width:102.5%;" class="jumbotron">
	<div style="box-shadow:2px 2px 5px grey; margin-top:-3%;" class="alert alert-success">
	<span style="color:#059216; font-size:16px;" class="glyphicon glyphicon-ok-circle" ></span> 
	Here is our verified doctor list
	</div>
<?php 
 $qr = "SELECT * FROM doctor where status='success' AND availability='Available' ";
 $r = mysqli_query($con,$qr);
 
foreach($r as $row){
	 $did = $row['did'];
	 $docnam = $row['name'];
	 $spcl = $row['specialist'];
	 $docid = $row['docid'];
	 $avbl = $row['availability'];
	 $add = $row['address'];
	 
	 ?>
	 <div style="box-shadow:3px 3px 5px grey;" class="well">
	 <table border="0" width="1000px" cellspacing="0">
	 <tr>
	 <td align="center"><?php 
	 $dir = "doctor/".$docid."/img/";
	 $open = opendir($dir);
	 while(($files = readdir($open)) != FALSE){
	 if($files!="."&&$files!=".."&&$files !="Thumbs.db"){
		echo "<img class='imgs2' style='border-radius:5em; padding:5px;' width='70px' title='$docnam' src='$dir/$files'/><br/>";
	
		}
	 }?>
	 <font style="font-family:calibri;"><b><?php echo $docnam;?></b></font><br>
	 <i><font style="font-size: 15px; font-family:calibri"><?php echo $spcl;?></i></font>
	 <br>
	 <a href="#feedbox<?php echo $row['did'];?>" data-toggle="modal">• View Feedback</a>
	 
	 <div class="modal fade" id="feedbox<?php echo $row['did'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	 
  <div style="width:70%" class="modal-dialog" role="document">
    <div class="modal-content">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Feedbacks for <?php echo "Dr.$docnam";?></h4><br>
		<?php
	$fq = "SELECT * FROM feedback where did = '$did' ";
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
</div>
</div>
</div>

</td>
	 <td style="background:#FFFFBE; border-radius:0.5em; padding:5px; width:18%;font-family:calibri" align="center"><?php echo $add;?></td>
	 <td align="center"><font style="font-size:14px; font-family:calibri">Status</font>  <br><b><font style="color:green;font-size:16px; font-family:calibri"><?php echo $avbl;?></font></b></td>
	 <td align="center">
	 <?php
	 if(!isset($_SESSION['useremail'])){
	 ?>
	 <button data-toggle="modal" data-target="#login" style="background-color:#059216; border-radius:2em;" class="btn btn-success">
	 +</button>
	 <?php }else{
		?>
		<form action="makeap.php" method="POST">
		<input type="hidden" name="getdid" value="<?php echo $did;?>"/>
		<input style="background-color:#059216; border-radius:2em;" class="btn btn-success" type="submit" name="btn_sub" value="+"/>
		</form></td>
		<td style="width:25%;" align="center">
		
		<form id="myForm" action="feed.php" method="POST">
		<input type="hidden" name="pid" value="<?php echo $pid;?>"/>
		<input type="hidden" name="did" value="<?php echo $did;?>"/>
		<textarea  rows="5" col="5" required name="postfeed" placeholder="Enter your feedback" class="form-control"></textarea>
		<input style="margin-top:2%;" type="submit" class="btn btn-primary" value="Submit" name="feed"/>
		</form>
		

		</td>
		<!--Appointment Form-->
	
<!--Apporintment form end-->
		<?php
	  } ?>
	  </tr>
	  </table>
    </div>
	 <?php
 }
 
?>
	</div>
	<div style="width:102.5%; margin-left:-1.2%;margin-top:-5%;" class="container footer"><center>&copy; 2017 | All Rights Reserved | Themed By <a style="color:white; cursor:pointer; target="_blank" href="https://www.facebook.com/ankitthegr8">@nkit</a> |
	<a style="color:white;" href="sitemap.php">Sitemap</a></center></div>
	</div>
	<?php }else{
		echo "Sorry You can't view the page";
	}?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
</script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<!--Login Form-->
	<div  class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="background:#005173; color:white;" class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span style="color:white;" aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-user"></span> Login Form Portal</h4>
      </div>
      <div class="modal-body">
	  <br>
        <form action="" name="lfrom" method="POST">
		<div class="input-group">
		<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-envelope"></span></span>
		<input type="email" class="form-control" required name="useremail" placeholder="Enter your email" aria-describedby="sizing-addon2">
		</div><br>
		<div class="input-group">
		<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
		<input type="password" required class="form-control" name="userpass" placeholder="Enter your password" aria-describedby="sizing-addon2">
		</div>
		<div class="modal-footer">
        <center><input type="submit" value="Login" name="btn_login" class="btn btn-success"></center>
      </div>
		</form>
      </div>
    </div>
  </div>
</div>
<!--Login form end-->

<!--Register Form-->
	<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div style="background:#005173; color:white;" class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span style="color:white;" aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel2"><span class="glyphicon glyphicon-saved" aria-hidden="true"></span> Register to Portal</h4>
      </div>
	  <div class="modal-body">
       
		<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#patient" aria-controls="patient" role="tab" data-toggle="tab">
		<span class="glyphicon glyphicon-user"></span> Patient</a></li>
		<li role="presentation"><a href="#doctor" aria-controls="doctor" role="tab" data-toggle="tab">
		<span class="glyphicon glyphicon-education"></span> Doctor</a></li>
		</ul>
	   <div class="tab-content">
		<!--Patient Registration-->
		<div role="tabpanel" class="tab-pane fade in active" id="patient">
		<br>
		<form method="POST" action="dp.php" ENCTYPE="multipart/form-data" action="" id="form1">
       <input type="text" name="pname" class="form-control" onkeyup="letters(this)" required placeholder="Enter your name"><br>
       <input type="email" name="pemail" class="form-control" required placeholder="Enter your email"><br>
       <input type="number" name="p_age" class="form-control" required placeholder="Enter your age"><br>
       <input type="password" name="p_password" class="form-control" required placeholder="Enter your password"><br>
	   <input type="text" name="adridpt" class="form-control" required placeholder="Enter your Aadhar ID"><br>
       <input type="text" name="paddress" class="form-control" required placeholder="Enter your address"><br>
	   
	   <label>Gender : </label>
	   <input type="radio" value="Male" name="pgender" required> Male 
	   <input type="radio" value="Female" name="pgender" required> Female <br></br>
		<div class="input-group form-group ">
		<span class="input-group-addon">+91</span>
		<input type="number" name="p_phone" class="form-control" id="user" maxlength="10"  placeholder="Enter your contact no." required >
		</div>
		<label>Your Picture</label>
		<input type="file" class="form-control" required name="pupload"/><br>

		<center><input type="submit" value="Register" name="btn_pat" class="btn btn-danger">
		<input type="button" value="Reset" onclick="rset()" class="btn btn-warning"></center>
		</form>
		
		</div>
		<!--Doctor Registration-->
		<div role="tabpanel" class="tab-pane fade" id="doctor">
		<br>
		 <form ENCTYPE="multipart/form-data" method="POST" action="dp.php" id="form2">
       <input type="text" name="name" class="form-control" onkeyup="letters(this)" required placeholder="Enter your name"><br>
       <input type="email" name="email" class="form-control" required placeholder="Enter your email"><br>
       <input type="number" name="age" class="form-control" required placeholder="Enter your age"><br>
       <input type="password" name="password" class="form-control" required placeholder="Enter your password"><br>
       <input type="text" name="address" class="form-control" required placeholder="Enter your address"><br>
	   <label>Gender : </label>
	   <input type="radio" value="Male" name="gender" required> Male 
	   <input type="radio" value="Female" name="gender" required> Female <br></br>
	   <input type="text" name="docid" class="form-control" required placeholder="Enter your Doctor ID"><br>
		<input type="text" name="adrid" class="form-control" required placeholder="Enter your Aadhar ID"><br>
		<label>Specialist in : </label>
		<select style="color:solid #ccc; border-radius:0.2em; padding:5px;" name="doccat">
		<option>Choose</option>
		<option value="Denitst">Denitst</option>
		<option value="Cardiologist">Cardiologist</option>
		<option value="Allergist">Allergist</option>
		<option value="Physcit">Physcit</option>
		<option value="Gynoclogist">Gyncologist</option>
		</select><sup style="color:red;"> *Required</sup><br></br>
		<div class="input-group form-group ">
		<span class="input-group-addon">+91</span>
		<input type="number" name="phone" class="form-control" id="user" maxlength="10"  placeholder="Enter your contact no." required >
		</div>
		<label data-toggle="tooltip" data-placement="right" title="PDF File Supported Only">Upload Your ID*</label>
		<input type="file" class="form-control" name="file" required /><br>
		<label>Your Picture</label>
		<input type="file" class="form-control" required name="newpic"/><br>
		<center><input type="submit" value="Register" name="btn_doc" class="btn btn-danger">
		<input type="button" value="Reset" onclick="rrset()" class="btn btn-warning"></center>
		</form>
		
		</div>
	</div>
		</div>
		
		
     
		
		
			 </div>
  </div>
</div>


<div  class="modal fade" id="ap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="background:#005173; color:white;" class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span style="color:white;" aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-user"></span> Login Form Portal</h4>
      </div>
      <div class="modal-body">
	  <br>
        <form action="" name="lfrom" method="POST">
		<div class="input-group">
		<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-envelope"></span></span>
		<input type="email" class="form-control" required name="useremail" placeholder="Enter your email" aria-describedby="sizing-addon2">
		</div><br>
		<div class="input-group">
		<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
		<input type="password" required class="form-control" name="userpass" placeholder="Enter your password" aria-describedby="sizing-addon2">
		</div>
		<div class="modal-footer">
        <center><input type="submit" value="Login" name="btn_login" class="btn btn-success"></center>
      </div>
		</form>
      </div>
    </div>
  </div>
</div>
<!--Login form end-->

<!--Profile tab start-->
	<div class="modal fade" id="profiletab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div style="width:35%; border-radius:0em;" class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="background:#005173; height:35px; color:white;" class="modal-header">
        <button style="margin-top:-1.5%;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span style="color:white;" aria-hidden="true">&times;</span></button>
        <h5 style="font-family:calibri; margin-top:-1.5%;" class="modal-title" id="myModalLabel"><b><?php echo "#$id $user";?></b></h5>
      </div>
      <div style="border-bottom-left-radius:0px;" class="modal-body">
	  
       <div class="row">
		
		<div class="col-md-4">
		<?php
	$dir = "doctor/".$docid."/img/";
	$open = opendir($dir);

	while(($files = readdir($open)) != FALSE){
	if($files!="."&&$files!=".."&&$files !="Thumbs.db"){
		echo "<img id='hello' style='float:left; margin-left:15%; border-radius:6em;' width='100' height='100' title='$user' src='$dir/$files'>";
	}
	
	
	}
	?>
	<p align="center" style="font-family:calibri;">&nbsp;&nbsp;&nbsp;</p>
	<p align="center" style="font-family:calibri; margin-top:-18%;"><?php echo "&nbsp;&nbsp;&nbsp;<b>ID : $docpd</b>";?></p>
		</div>
		<div class="col-md-4">
		<img src="img/line.png"/>
		</div>
		
		<div class="col-md-4">
		<div style="font-family:calibri; float:left;margin-left:-70%;">
		<label>Name  </label>&nbsp;&nbsp; : <?php echo $user;?><br>
		<label>Email </label>&nbsp;&nbsp; : <?php echo $email;?><br>
		<label>Phone </label>&nbsp;:  <?php echo "+91-$phone";?><br>
		<label>Gender   </label>&nbsp;:&nbsp;<?php echo $sex;?><br>
		<label>Age   </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;<?php echo $age;?><br>
		
		</div>
		</div>
		
		</div>
		
      </div>
    </div>
  </div>
</div>
<!--profile tab end-->

<!--patient Profile tab start-->
	<div class="modal fade" id="profiletab2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div style="width:35%; border-radius:0em;" class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="background:#005173; height:35px; color:white;" class="modal-header">
        <button style="margin-top:-1.5%;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span style="color:white;" aria-hidden="true">&times;</span></button>
        <h5 style="font-family:calibri; margin-top:-1.5%;" class="modal-title" id="myModalLabel"><b><?php echo "#$patid $user";?></b></h5>
      </div>
      <div style="border-bottom-left-radius:0px;" class="modal-body">
	  
       <div class="row">
		
		<div class="col-md-4">
		<?php
	$dir = "patient/".$adrid."/img/";
	$open = opendir($dir);

	while(($files = readdir($open)) != FALSE){
	if($files!="."&&$files!=".."&&$files !="Thumbs.db"){
		echo "<img id='hello' style='float:left; margin-left:15%; border-radius:6em;' width='100' height='100' title='$user' src='$dir/$files'>";
	}
	
	
	}
	?>
	<p align="center" style="font-family:calibri;">&nbsp;&nbsp;&nbsp;</p>
	<p align="center" style="font-family:calibri; margin-top:-18%;"><?php echo "&nbsp;&nbsp;&nbsp;<b>A. ID : $adrid</b>";?></p>	</div>
		<div class="col-md-4">
		<img src="img/line.png"/>
		</div>
		
		<div class="col-md-4">
		<div style="font-family:calibri; float:left;margin-left:-70%;">
		<label>Name  </label>&nbsp;&nbsp; : <?php echo $user;?><br>
		<label>Email </label>&nbsp;&nbsp; : <?php echo $emailp;?><br>
		<label>Phone </label>&nbsp;:  <?php echo "+91-$mob";?><br>
		<label>Gender   </label>&nbsp;:&nbsp;<?php echo $sexp;?><br>
		<label>Age   </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;<?php echo $agep;?><br>
		
		</div>
		</div>
		
		</div>
		
      </div>
    </div>
  </div>
</div>
<!--patint profile tab end-->

<!--feedback box-->


<script>
function rset() {
    document.getElementById("form1").reset();
}

function rrset() {
    document.getElementById("form2").reset();
}

function letters(input) {
    var regex = /[^ a-z]/gi;
    input.value = input.value.replace(regex, "");
}
</script>


  </body>
</html>