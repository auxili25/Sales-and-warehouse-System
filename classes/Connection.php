<?php 

	class connect{
		private $server="localhost";
		private $users="root";
		private $password="";
		private $bd="sales";

		public function connection(){
			$conexion=mysqli_connect($this->server,
									 $this->user,
									 $this->password,
									 $this->bd);
			return $connection;
		}
	}


 ?>