<?php 
session_start();
if(isset($_SESSION['user'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>customers</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Customers</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmCustomers">
						<label>Name</label>
						<input type="text" class="form-control input-sm" id="name" name="name">
						<label>Lastname</label>
						<input type="text" class="form-control input-sm" id="lastname" name="lastname">
						<label>Address</label>
						<input type="text" class="form-control input-sm" id="address" name="address">
						<label>Email</label>
						<input type="text" class="form-control input-sm" id="email" name="email">
						<label>Phone</label>
						<input type="text" class="form-control input-sm" id="phone" name="phone">
						<label>RFC</label>
						<input type="text" class="form-control input-sm" id="rfc" name="rfc">
						<p></p>
						<span class="btn btn-primary" id="btnAgregarCliente">Add</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaCustomersLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalCustomersUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Update customer</h4>
					</div>
					<div class="modal-body">
						<form id="frmClientesU">
							<input type="text" hidden="" id="idclienteU" name="idclienteU">
							<label>Name</label>
							<input type="text" class="form-control input-sm" id="nameU" name="nameU">
							<label>Lastname</label>
							<input type="text" class="form-control input-sm" id="lastnameU" name="lastnameU">
							<label>Address</label>
							<input type="text" class="form-control input-sm" id="addressU" name="addressU">
							<label>Email</label>
							<input type="text" class="form-control input-sm" id="emailU" name="emailU">
							<label>Phone</label>
							<input type="text" class="form-control input-sm" id="phoneU" name="phoneU">
							<label>RFC</label>
							<input type="text" class="form-control input-sm" id="rfcU" name="rfcU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAgregarClienteU" type="button" class="btn btn-primary" data-dismiss="modal">Update</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function addCustomerData(idcustomer){

			$.ajax({
				type:"POST",
				data:"idcustomer=" + idcustomer,
				url:"../processes/customers/getCustomerData.php",
				success:function(r){
					dato=jQuery.parseJSON(r);
					$('#idcustomerU').val(data['id_customer']);
					$('#nameU').val(data['name']);
					$('#lastnameU').val(data['lastname']);
					$('#addressU').val(data['address']);
					$('#emailU').val(data['email']);
					$('#phoneU').val(data['phone']);
					$('#rfcU').val(data['rfc']);

				}
			});
		}

		function deletecustomer(idcustomer){
			alertify.confirm('¿Do you want to delete this customer?', function(){ 
				$.ajax({
					type:"POST",
					data:"idcustomer=" + idcustomer,
					url:"../processes/customers/deletecustomer.php",
					success:function(r){
						if(r==1){
							$('#tableCustomersLoad').load("customers/tableCustomers.php");
							alertify.success("Successfully removed!!");
						}else{
							alertify.error("Could not delete:(");
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

			$('#tableCustomersLoad').load("customers/tableCustomers.php");

			$('#btnAddCustomer').click(function(){

				empty=validateFormEmpty('frmCustomers');

				if(empty > 0){
					alertify.alert("You must fill out all the fields!!");
					return false;
				}

				data=$('#frmCustomers').serialize();

				$.ajax({
					type:"POST",
					data:data,
					url:"../processes/customers/addCustomer.php",
					success:function(r){

						if(r==1){
							$('#frmCustomers')[0].reset();
							$('#tableCustomersLoad').load("customers/tableCustomers.php");
							alertify.success("Customer successfully added :D");
						}else{
							alertify.error("Could not add customer");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAddCustomerU').click(function(){
				datos=$('#frmCustomersU').serialize();

				$.ajax({
					type:"POST",
					data:data,
					url:"../processes/customers/updateCustomer.php",
					success:function(r){

						if(r==1){
							$('#frmCustomers')[0].reset();
							$('#tableCustomersLoad').load("customers/tableCustomers.php");
							alertify.success("Customer successfully updated :D");
						}else{
							alertify.error("Could not update customer");
						}
					}
				});
			})
		})
	</script>


	<?php 
}else{
	header("location:../index.php");
}
?>