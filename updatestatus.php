<?php
session_start();
if(!isset($_SESSION['useremail'])){
	echo "<div align='center' style='font-family : calibri; color:white; background:#D20D0D; padding:15px;'>Access denied ! </div>";
}else{
if(isset($_POST['updt'])){
$id = $_POST['getupid'];
$av = @$_POST['update'];
include('includes/conn.php');

if($av !=""){
	$q = "update doctor set availability='$av' where did='$id' ";
	if($r = mysqli_query($con,$q)){
		?>
		<script>
		alert ('<?php echo "Status Changed to $av"; ?>');
		window.location.href="doctor.php";
		</script>
		<?php

	}
}else{
	?>
		<script>
		alert('Select Option first');
		window.location.href="doctor.php";
		</script>
	<?php
	
}
	
}
}
?>