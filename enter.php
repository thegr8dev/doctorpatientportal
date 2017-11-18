<?php

session_start();

if(isset($_SESSION['useremail'])||isset($_COOKIE['dpp'])){
	include('doctor.php');

}else{

	echo "Access denied!";

}


?>