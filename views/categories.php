<?php 
session_start();
if(isset($_SESSION['user'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>categories</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>

		<div class="container">
			<h1>Categories</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmCategories">
						<label>category</label>
						<input type="text" class="form-control input-sm" name="category" id="category">
						<p></p>
						<span class="btn btn-primary" id="btnAddCategory">Add</span>
					</form>
				</div>
				<div class="col-sm-6">
					<div id="tableCategoryLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->

		<!-- Modal -->
		<div class="modal fade" id="updateCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Update categories</h4>
					</div>
					<div class="modal-body">
						<form id="frmCategoryU">
							<input type="text" hidden="" id="idcategory" name="idcategory">
							<label>Category</label>
							<input type="text" id="categoryU" name="categoryU" class="form-control input-sm">
						</form>


					</div>
					<div class="modal-footer">
						<button type="button" id="btnUpdateCategory" class="btn btn-warning" data-dismiss="modal">Save</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>
	<script type="text/javascript">
		$(document).ready(function(){

			$('#tableCategoryLoad').load("categories/tableCategory.php");

			$('#btnAddCategory').click(function(){

				empty=validateFormEmpty('frmCategories');

				if(empty > 0){
					alertify.alert("You must fill out all the fields!!");
					return false;
				}

				datos=$('#frmCategories').serialize();
				$.ajax({
					type:"POST",
					data:data,
					url:"../processes/categories/addCategory.php",
					success:function(r){
						if(r==1){
					//esta linea nos permite limpiar el formulario al insetar un registro
					$('#frmCategories')[0].reset();

					$('#tableCategoryLoad').load("categories/tableCategoryLoad.php");
					alertify.success("Category added successfully :D");
				}else{
					alertify.error("Could not add category");
				}
			}
		});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnUpdateCategory').click(function(){

				datos=$('#frmCategoryU').serialize();
				$.ajax({
					type:"POST",
					data:data,
					url:"../processes/categories/addCategory.php",
					success:function(r){
						if(r==1){
							$('#tableCategoryLoad').load("categories/tableCategories.php");
							alertify.success("Updated successfully :)");
						}else{
							alertify.error("could not be updated :(");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		function addData(idCategory,category){
			$('#idcategory').val(idCategory);
			$('#categoryU').val(category);
		}

		function deleteCategory(idcategory){
			alertify.confirm('¿Do you want to delete this category??', function(){ 
				$.ajax({
					type:"POST",
					data:"idcategory=" + idcategory,
					url:"../processes/categories/deleteCategory.php",
					success:function(r){
						if(r==1){
							$('#tableCategoryLoad').load("categories/tableCategories.php");
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
	<?php 
}else{
	header("location:../index.php");
}
?>