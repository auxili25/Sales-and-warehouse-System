<?php 
	
	require_once "classes/Connection.php";
	$obj= new connect();
	$conexion=$obj->connection();

	$sql="SELECT * from users where email='admin'";
	$result=mysqli_query($connection,$sql);
	$validate=0;
	if(mysqli_num_rows($result) > 0){
		header("location:index.php");
	}
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>record</title>
	<link rel="stylesheet" type="text/css" href="bookstores/bootstrap/css/bootstrap.css">
	<script src="bookstores/jquery-3.2.1.min.js"></script>
	<script src="js/funciones.js"></script>

</head>
<body style="background-color: gray">
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-danger">
					<div class="panel panel-heading">
Register Administrator</div>
					<div class="panel panel-body">
						<form id="frmRegistration">
							<label>Name</label>
							<input type="text" class="form-control input-sm" name="name" id="name">
							<label>Last name</label>
							<input type="text" class="form-control input-sm" name="last-name" id="last-name">
							<label>User</label>
							<input type="text" class="form-control input-sm" name="user" id="user">
							<label>Password</label>
							<input type="text" class="form-control input-sm" name="password" id="password">
							<p></p>
							<span class="btn btn-primary" id="registro">To register</span>
							<a href="index.php" class="btn btn-default">Return login</a>
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
		$('#record').click(function(){

			empty=validateFormEmpty('frmRegistration');

			if(empty > 0){
				alert("You must fill out all the fields!!");
				return false;
			}

			data=$('#frmRegistration').serialize();
			$.ajax({
				type:"POST",
				data:data,
				url:"processes/regLogin/registerUser.php",
				success:function(r){
					alert(r);

					if(r==1){
						alert("Added successfully");
					}else{
						alert("Failed to add :(");
					}
				}
			});
		});
	});
</script>

