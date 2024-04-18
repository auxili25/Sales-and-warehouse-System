<?php 

	class connect{
		private $servidor="localhost";
		private $usuario="root";
		private $password="";
		private $bd="sales";

		public function Connection(){
			$Connection=mysql_connect($this->server,
									 $this->user,
									 $this->password,
									 $this->bd);
			return $Connection;
		}
	}


 ?>