
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Forget Password?</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

  </head>
  <body>
	<br>
	<div align="center" class="container well">
    <form action="forgetprocess1.php" method="POST" id="form1">
	<input style="width:30%" type="email" class="form-control" name="femail" placeholder="Enter your account email"/>
	<input style="float:right; margin-right:28%; margin-top:-3%;" type="submit" name="btn_forget" value="Submit" class="btn btn-success">
	<input style="float:right;margin-right:-12.2%; margin-top:-3%;" type="button" value="Reset" onclick="rsett()" class="btn btn-danger">
	</div>
	</form>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script>
	function rsett(){
    document.getElementById("form1").reset();
	}
	</script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
