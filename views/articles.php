<?php 
session_start();
if(isset($_SESSION['user'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>articles</title>
		<?php require_once "menu.php"; ?>
		<?php require_once "../classes/Connection.php"; 
		$c= new connect();
		$connection=$c->connection();
		$sql="SELECT id_category,nameCategory
		from categories";
		$result=mysql_query($connection,$sql);
		?>
	</head>
	<body>
		<div class="container">
			<h1>Articles</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmArticles" enctype="multipart/form-data">
						<label>Category</label>
						<select class="form-control input-sm" id="categorySelect" name="categorySelect">
							<option value="A">Select Category</option>
							<?php while($ver=mysql_fetch_row($result)): ?>
								<option value="<?php echo $ver[0] ?>"><?php echo $see[1]; ?></option>
							<?php endwhile; ?>
						</select>
						<label>Name</label>
						<input type="text" class="form-control input-sm" id="name" name="name">
						<label>Description</label>
						<input type="text" class="form-control input-sm" id="description" name="description">
						<label>Amount</label>
						<input type="text" class="form-control input-sm" id="amount" name="amount">
						<label>Price</label>
						<input type="text" class="form-control input-sm" id="price" name="price">
						<label>Image</label>
						<input type="file" id="image" name="image">
						<p></p>
						<span id="btnAddArticle" class="btn btn-primary">Add</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tableArticlesLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->
		
		<!-- Modal -->
		<div class="modal fade" id="abremodalUpdateArticle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Update Article</h4>
					</div>
					<div class="modal-body">
						<form id="frmArticulosU" enctype="multipart/form-data">
							<input type="text" id="idArticle" hidden="" name="idArticle">
							<label>Category</label>
							<select class="form-control input-sm" id="categorySelectU" name="categorySelectU">
								<option value="A">Select Category</option>
								<?php 
								$sql="SELECT id_category,nameCategory
								from categories";
								$result=mysql_query($connection,$sql);
								?>
								<?php while($ver=mysql_fetch_row($result)): ?>
									<option value="<?php echo $see[0] ?>"><?php echo $ver[1]; ?></option>
								<?php endwhile; ?>
							</select>
							<label>Name</label>
							<input type="text" class="form-control input-sm" id="nameU" name="nameU">
							<label>Description</label>
							<input type="text" class="form-control input-sm" id="descriptionU" name="descriptionU">
							<label>Amount</label>
							<input type="text" class="form-control input-sm" id="amountU" name="amountU">
							<label>Price</label>
							<input type="text" class="form-control input-sm" id="priceU" name="priceU">
							
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnUpdatearticle" type="button" class="btn btn-warning" data-dismiss="modal">Update</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function addDataArticle(idarticle){
			$.ajax({
				type:"POST",
				data:"idart=" + idarticle,
				url:"../processes/articles/getDataArticle.php",
				success:function(r){
					
					dato=jQuery.parseJSON(r);
					$('#idArticle').val(data['id_product']);
					$('#categorySelectU').val(data['id_category']);
					$('#nameU').val(data['name']);
					$('#descriptionU').val(data['description']);
					$('#amountU').val(data['amount']);
					$('#priceU').val(data['price']);

				}
			});
		}

		function deleteArticle(idArticle){
			alertify.confirm('¿Do you want to delete this article?', function(){ 
				$.ajax({
					type:"POST",
					data:"idarticle=" + idArticle,
					url:"../processes/articles/deleteArticle.php",
					success:function(r){
						if(r==1){
							$('#tableArticleLoad').load("article/tableArticles.php");
							alertify.success("Successfully removed!!");
						}else{
							alertify.error("Could not delete :(");
						}
					}
				});
			}, function(){ 
				alertify.error('I cancel !')
			});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnUpdatearticle').click(function(){

				datos=$('#frmArticlesU').serialize();
				$.ajax({
					type:"POST",
					data:data,
					url:"../processes/articles/updateArticles.php",
					success:function(r){
						if(r==1){
							$('#tableArticlesLoad').load("articles/tableArticles.php");
							alertify.success("Updated successfully :D");
						}else{
							alertify.error("Error updating :(");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#tableArticlesLoad').load("articles/tableArticles.php");

			$('#btnAddArticle').click(function(){

				empty=validateEmptyForm('frmArticles');

				if(empty > 0){
					alertify.alert("You must fill out all the fields!!");
					return false;
				}

				var formData = new FormData(document.getElementById("frmArticles"));

				$.ajax({
					url: "../processes/articles/insertArticles.php",
					type: "post",
					dataType: "html",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,

					success:function(r){
						
						if(r == 1){
							$('#frmArticles')[0].reset();
							$('#tableArticlesLoad').load("articles/tableArticles.php");
							alertify.success("Added successfully :D");
						}else{
							alertify.error("Failed to upload file:(");
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