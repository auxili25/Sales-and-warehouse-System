<?php 
	session_start();
	if(isset($_SESSION['user'])){
		
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>sales</title>
	<?php require_once "menu.php"; ?>
</head>
<body>

	<div class="container">
		 <h1>Product sales</h1>
		 <div class="row">
		 	<div class="col-sm-12">
		 		<span class="btn btn-default" id="saleProductsBtn">Sell ​​product</span>
		 		<span class="btn btn-default" id="salesMadeBtn">Sales made</span>
		 	</div>
		 </div>
		 <div class="row">
		 	<div class="col-sm-12">
		 		<div id="saleProducts"></div>
		 		<div id="salesMade"></div>
		 	</div>
		 </div>
	</div>
</body>
</html>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#saleProductsBtn').click(function(){
				hideSectionSale();
				$('#saleProducts').load('sales/saleProducts.php');
				$('#saleProducts').show();
			});
			$('#salesMadeBtn').click(function(){
				hideSectionSale();
				$('#salesMade').load('sales/salesandReports.php');
				$('#salesMade').show();
			});
		});

		function hideSectionSale(){
			$('#saleProducts').hide();
			$('#salesMade').hide();
		}

	</script>

<?php 
	}else{
		header("location:../index.php");
	}
 ?>