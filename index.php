<?php 
	
	require_once "classes/Connection.php";
	$obj= new connect();
	$connection=$obj->connection();

	$sql="SELECT * from users where email='admin'";
	$result=mysqli_query($connection,$sql);
	$validate=0;
	if(mysqli_num_rows($result) > 0){
		$validate=1;
	}
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>User login</title>
	<link rel="stylesheet" type="text/css" href="bookstores/bootstrap/css/bootstrap.css">
	<script src="bookstores/jquery-3.2.1.min.js"></script>
	<script src="js/
functions.js"></script>
</head>
<body style="background-color: gray">
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-primary">
					<div class="panel panel-heading">Sales and warehouse system</div>
					<div class="panel panel-body">
						<p>
							<img src="img/ventas.jpg"  height="190">
						</p>
						<form id="frmLogin">
							<label>User</label>
							<input type="text" class="form-control input-sm" name="user" id="user">
							<label>Password</label>
							<input type="password" name="password" id="password" class="form-control input-sm">
							<p></p>
							<span class="btn btn-primary btn-sm" id="entrarSistema">Get in</span>
							<?php  if(!$validate): ?>
							<a href="record.php" class="btn btn-danger btn-sm">To register</a>
							<?php endif; ?>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#entrarSistema').click(function(){

            empty=validateFormEmpty('frmLogin');

			if(empty > 0){
				alert("You must fill out all the fields!!");
				return false;
			}

		datos=$('#frmLogin').serialize();
		$.ajax({
			type:"POST",
			data:datos,
			url:"processes/regLogin/login.php",
			success:function(r){

				if(r==1){
					window.location="views/start.php";
				}else{
					alert("Could not access :(");
				}
			}
		});
	});
	});
</script>