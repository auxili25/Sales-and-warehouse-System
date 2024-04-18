<?php 

	class users{
		public function registerUser($data){
			$c=new connect();
			$connection=$c->connection();

			$fecha=date('Y-m-d');

			$sql="INSERT into users (name,
								lastname,
								email,
								password,
								dateCapture)
						values ('$data[0]',
								'$data[1]',
								'$data[2]',
								'$data[3]',
								'$date')";
			return mysql_query($connection,$sql);
		}
		public function loginUser($data){
			$c=new connect();
			$connection=$c->connection();
			$password=sha1($data[1]);

			$_SESSION['users']=$data[0];
			$_SESSION['iduser']=self::bringID($data);

			$sql="SELECT * 
					from users 
				where email='$data[0]'
				and password='$password'";
			$result=mysql_query($connection,$sql);

			if(mysql_num_rows($result) > 0){
				return 1;
			}else{
				return 0;
			}
		}
		public function bringID($data){
			$c=new connect();
			$connection=$c->connection();

			$password=sha1($data[1]);

			$sql="SELECT id_user 
					from users
					where email='$data[0]'
					and password='$password'"; 
			$result=mysql_query($connection,$sql);

			return mysql_fetch_row($result)[0];
		}

		public function getUserData($iduser){

			$c=new connect();
			$connection=$c->connection();

			$sql="SELECT id_user,
							name,
							lastname,
							email
					from users 
					where id_user='$iduser'";
			$result=mysql_query($connection,$sql);

			$see=mysql_fetch_row($result);

			$data=array(
						'id_user' => $see[0],
							'name' => $see[1],
							'lastname' => $see[2],
							'email' => $see[3]
						);

			return $data;
		}

		public function updateUser($data){
			$c=new connect();
			$connection=$c->connection();

			$sql="UPDATE users set name='$data[1]',
									lastname='$data[2]',
									email='$data[3]'
						where id_user='$data[0]'";
			return mysql_query($connection,$sql);	
		}

		public function deleteUser($iduser){
			$c=new connect();
			$connection=$c->connection();

			$sql="DELETE from users 
					where id_user='$iduser'";
			return mysql_query($connection,$sql);
		}
	}

 ?>