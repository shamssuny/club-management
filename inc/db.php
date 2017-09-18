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

			//create table for users
			$create_user = "create table if not EXISTS users (uid int primary key AUTO_INCREMENT,username varchar(200),email varchar(300),password varchar(300),name varchar(300),blood varchar(20),doner varchar(20),contact varchar(30),location text)";
			$pdo->query($create_user);

			//create event table 
			$event_q = "create table if not EXISTS events (ev_id int primary key AUTO_INCREMENT,name varchar(300),detail text,new varchar(20))";
			$pdo->query($event_q);

			//event register table
			$ev_reg_table = "create table if not EXISTS event_reg_users (reg_id int primary key AUTO_INCREMENT,uid int,eid int,apprv varchar(20),foreign key (uid) REFERENCES users(uid),foreign key (eid) REFERENCES events(ev_id))";
			$pdo->query($ev_reg_table);

			//create blog table
			$blog_table = "create table if not exists blog (b_id int primary key AUTO_INCREMENT,title varchar(300),detail text)";
			$pdo->query($blog_table);

			//create cost table
			$cost_query = "create table if not exists cost (c_id int primary key AUTO_INCREMENT,name varchar(500),date varchar(200),cost DOUBLE)";
			$pdo->query($cost_query);

			//create blog comment table
			$blog_comment = "create table if not exists blog_comment (b_c_id int primary key AUTO_INCREMENT,uid int,bid int,comment text,foreign key (uid) REFERENCES users(uid),foreign key (bid) REFERENCES blog (b_id))";
			$pdo->query($blog_comment);
		}


		public function getalldata($pdo, $table_name){
			$all_query = "select * from ".$table_name;
			$output = $pdo->query($all_query);
			return $output;
		}

		public function getalldatadesc($pdo, $table_name,$order){
			$all_query = "select * from ".$table_name." ORDER BY ".$order." DESC";
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