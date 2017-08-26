<?php
	//include connection file
	include 'connection.php';
	// Database Class
	class db{

		//constructor
		public function __construct(){

		}


		public function check_table($pdo){
			//create admin table
			$admin_table = "CREATE TABLE IF NOT EXISTS admin (id INT primary key AUTO_INCREMENT,username varchar(200),password varchar(200))";
			$pdo->query($admin_table);
			//create front page table
			$front_page_table = "CREATE TABLE IF NOT EXISTS frontpage (id INT primary key AUTO_INCREMENT, club_name varchar(200),slider_title varchar(500),slider_image varchar(300),about text,team1_image varchar(300),team1_name varchar(200),team1_title varchar(200),team2_image varchar(300),team2_name varchar(200),team2_title varchar(200),team3_image varchar(300),team3_name varchar(200),team3_title varchar(200),team4_image varchar(300),team4_name varchar(200),team4_title varchar(200),email varchar(1000))";
			$pdo->query($front_page_table);

			//set default data in front table
			$check_front_table = "select * from frontpage";
			$result = $pdo->query($check_front_table)->rowCount();
			if($result == 0){
				//insert default data
				$default_data_query = "insert into frontpage (club_name,slider_title,slider_image,about,team1_image,team1_name,team1_title,team2_image,team2_name,team2_title,team3_image,team3_name,team3_title,team4_image,team4_name,team4_title,email) values ('The CLub','This is Club Title','clubbanner.jpg','Lorepum Ispum This is a dummy text.Lorepum Ispum This is a dummy text.Lorepum Ispum This is a dummy text.Lorepum Ispum This is a dummy text.Lorepum Ispum This is a dummy text.Lorepum Ispum This is a dummy text.Lorepum Ispum This is a dummy text.Lorepum Ispum This is a dummy text.','t1.jpg','Jhon doe','The President','t2.jpg','Jhon doe','The President','t3.jpg','Jhon doe','The President','t4.jpg','Jhon doe','The President','admin@admin.com')";
				$pdo->query($default_data_query);
			}



			//create table for noticeboard
			$notice_board = "create table if not EXISTS noticeboard (id INT primary key AUTO_INCREMENT,notice_title varchar(300),notice_details text,mark varchar(200))";
			$pdo->query($notice_board);
		}


		public function getalldata($pdo, $table_name){
			$all_query = "select * from ".$table_name;
			$output = $pdo->query($all_query);
			return $output;
		}

		public function custom_query($pdo , $query){
			$get_query = $query;

			try{
				$result = $pdo->query($get_query);
			}catch(PDOExeption $e){
				echo "error: ".$e->getMessage();
			}
			
			return $result;
		}
	}
?>