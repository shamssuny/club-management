<?php
	//import config.php file for get connection info
	include 'config.php';
	
	$host = HOST;
	$db = DB;
	$user = USER;
	$pass = PASS;
	//make connection
	$pdo = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);

	if($pdo){
		//echo "Connected!";
	}else{
		echo "Error";
	}
?>