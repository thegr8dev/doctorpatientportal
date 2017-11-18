<table border="1" width="500px" cellspacing="0">
<tr><th>Name</th>
<th>Password</th>
<th>Action</th>
</tr>
<tr>
<?php
include('includes/conn.php');
$q = "SELECT * FROM patient";
$r = mysqli_query($con,$q);
while($row = mysqli_fetch_assoc($r)){
	$id = $row['pid'];
?>
<form action="" method="POST">
<input type="hidden" name="id" value="<?php echo $id;?>"/>
<td align="center"><input type="text" name="newname" placeholder="<?php echo $row['name'];?>"/></td>	
<td align="center"><input type="text" name="newpass" placeholder="<?php echo $row['password'];?>"/></td>
<td><input type="submit" name="submit"/></td>
</form>
</tr>
<?php	
}

if(isset($_POST['submit'])){
	include('includes/conn.php');
	$id = $_POST['id'];
	$n = $_POST['newname'];
	$p = $_POST['newpass'];
	if($n != ""){
	$qr = "UPDATE patient SET name='$n' WHERE pid='$id'";
			mysqli_query($con,$qr);
			echo '<script type="text/javascript">'; 
			echo 'alert("name updated");'; 
			echo 'window.location.href = "new.php";';
			echo '</script>';
		
	}elseif($p !=""){
			$qr2 = "UPDATE patient SET password='$p' WHERE pid='$id'";
			mysqli_query($con,$qr2);
			echo '<script type="text/javascript">'; 
			echo 'alert("password updated");'; 
			echo 'window.location.href = "new.php";';
			echo '</script>';
	}
	else{
			echo '<script type="text/javascript">'; 
			echo 'alert("Nothing updated");'; 
			echo 'window.location.href = "new.php";';
			echo '</script>';
	}
	
}
?>
<!--Update script-->

</table>