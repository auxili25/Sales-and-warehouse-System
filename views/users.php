<?php 
session_start();
if(isset($_SESSION['user']) and $_SESSION['user']=='admin'){
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>users</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Manage users</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmRegistro">
						<label>Name</label>
						<input type="text" class="form-control input-sm" name="name" id="name">
						<label>Lastname</label>
						<input type="text" class="form-control input-sm" name="lastname" id="lastname">
						<label>User</label>
						<input type="text" class="form-control input-sm" name="user" id="user">
						<label>Password</label>
						<input type="text" class="form-control input-sm" name="password" id="password">
						<p></p>
						<span class="btn btn-primary" id="registro">To register</span>

					</form>
				</div>
				<div class="col-sm-7">
					<div id="tableUsersLoad"></div>
				</div>
			</div>
		</div>


		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="updatesUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Update User</h4>
					</div>
					<div class="modal-body">
						<form id="frmRecordU">
							<input type="text" hidden="" id="idUser" name="idUser">
							<label>Name</label>
							<input type="text" class="form-control input-sm" name="nameU" id="nameU">
							<label>Lastname</label>
							<input type="text" class="form-control input-sm" name="lastnameU" id="lastnameU">
							<label>User</label>
							<input type="text" class="form-control input-sm" name="userU" id="userU">

						</form>
					</div>
					<div class="modal-footer">
						<button id="btnUpdateUser" type="button" class="btn btn-warning" data-dismiss="modal">Update User</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function addUserData(iduser){

			$.ajax({
				type:"POST",
				data:"iduser=" + iduser,
				url:"../processes/users/getUserData.php",
				success:function(r){
					data=jQuery.parseJSON(r);

					$('#idUser').val(data['id_user']);
					$('#nameU').val(data['name']);
					$('#lastnameU').val(data['lastname']);
					$('#userU').val(data['email']);
				}
			});
		}

		function deleteUser(iduser){
			alertify.confirm('¿Do you want to delete this user?', function(){ 
				$.ajax({
					type:"POST",
					data:"iduser=" + iduser,
					url:"../processes/users/deleteUser.php",
					success:function(r){
						if(r==1){
							$('#tableUsersLoad').load('user/tableUsers.php');
							alertify.success("Successfully removed!!");
						}else{
							alertify.error("Could not delete :(");
						}
					}
				});
			}, function(){ 
				alertify.error('I cancel!')
			});
		}


	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnUpdateUser').click(function(){

				data=$('#frmRecordU').serialize();
				$.ajax({
					type:"POST",
					data:data,
					url:"../processes/users/UpdateUser.php",
					success:function(r){

						if(r==1){
							$('#tableUsersLoad').load('user/tableUsers.php');
							alertify.success("Updated successfully:D");
						}else{
							alertify.error("Could not update :(");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tableUsersLoad').load('user/tableUsers.php');

			$('#record').click(function(){

				empty=validateFormEmpty('frmRecord');

				if(empty > 0){
					alertify.alert("You must fill out all the fields!!");
					return false;
				}

				datos=$('#frmRecord').serialize();
				$.ajax({
					type:"POST",
					data:data,
					url:"../processes/regLogin/registerUser.php",
					success:function(r){
						//alert(r);

						if(r==1){
							$('#frmRecord')[0].reset();
							$('#tableUsersLoad').load('user/tableUsers.php');
							alertify.success("Added successfully");
						}else{
							alertify.error("Failed to add:(");
						}
					}
				});
			});
		});
	</script>

	<?php 
}else{
	header("location:../index.php");
}
?>