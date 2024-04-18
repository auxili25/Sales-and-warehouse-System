<?php 
	session_start();
	require_once "../../classes/Connection.php";
	require_once "../../classes/Users.php";

	$obj= new users();

	$datos=array(
		$_POST['user'],
	$_POST['password']
	);

	

	echo $obj->loginUser($data);

 ?>