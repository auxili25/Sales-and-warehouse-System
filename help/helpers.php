

//menu de cabecera 
https://bootsnipp.com/snippets/Kr5yV


<style type="text/css">
		
@page {
            margin-top: 0.3em;
            margin-left: 0.6em;
        }
	</style>

<script type="text/javascript">

	//script para evento click y ajax 
	$('#').click(function(){

		data=$('#').serialize();
		$.ajax({
			type:"POST",
			data:data,
			url:"../processes/",
			success:function(r){

			}
		});
	});
//////////////funcion para validar datos vacios :)
	function validateFormEmpty(form){
		data=$('#' + form).serialize();
		d=data.split('&');
		empty=0;
		for(i=0;i< d.length;i++){
            controls=d[i].split("=");
				if(controls[1]=="A" || controls[1]==""){
					empty++;
				}
		}
		return empty;
	}

</script>

<script type="text/javascript">
		$('#').click(function(){
			var formData = new FormData(document.getElementById("frm"));

				$.ajax({
					url: "../processes/articles/insertFile.php",
					type: "post",
					dataType: "html",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,

					success:function(data){
						
						if(data == 1){
							$('#frm')[0].reset();
							$('#tablaArticulos').load('articulos/tablaArticulos.php');
							alertify.success("Added successfully:D");
						}else{
							alertify.error("Failed to upload file :(");
						}
					}
				});
		});
</script>

<?php 

	public function obtenIdImg($idProducto){
			$c= new connect();
			$connection=$c->connection();

			$sql="SELECT id_imagen 
					from productos 
					where id_producto='$idProduct'";
			$result=mysql_query($connection,$sql);

			return mysql_fetch_row($result)[0];
		}

		public function getPathImage($idImg){
			$c= new connect();
			$connection=$c->connection();

			$sql="SELECT route 
					from images
					where id_image='$idImg'";

			$result=mysql_query($connection,$sql);

			return mysql_fetch_row($result)[0];
		}

		public function creaFolio(){
		$c= new connect();
		$connection=$c->connection();

		$sql="SELECT id_sales from sales group by id_sale desc";

		$resul=mysql_query($connection,$sql);
		$id=mysql_fetch_row($resul)[0];

		if($id=="" or $id==null or $id==0){
			return 1;
		}else{
			return $id + 1;
		}
	}

	///***************************************
	public function customernamegg($idCustomer){
		$c= new connect();
		$connection=$c->connection();

		$sql="SELECT lastname,name 
			from customers 
			where id_customer='$idCustomer'";
		$result=mysql_query($connection,$sql);

		$ver=mysql_fetch_row($result);

		return $ver[0]." ".$ver[1];
	}

	public function getTotal($idventa){
		$c= new connect();
		$connection=$c->connection();

		$sql="SELECT price 
				from sales 
				where id_sale='$idsale'";
		$result=mysql_query($connection,$sql);

		$total=0;

		while($ver=mysql_fetch_row($result)){
			$total=$total + $ver[0];
		}

		return $total;
	}

 ?>