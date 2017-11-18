<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
</head>
<script type="text/javascript">
function chkuserfun(val){
$.ajax({
	type:"POST",
	url:"chkemail.php",
	data:'gr='+val,
	success: function(data){
		$("#msg").html(data);
	}});
}


</script>
Enter email : <input type="email" placeholder="enter email" name="gr" onkeyup="chkuserfun(this.value)" />
<div id="msg"></div>
</html>