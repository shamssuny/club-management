<?php
//include database class
include 'inc/db.php';

//initialize class db , then check for the table if they are exists or not.
$check_point = new db();
$check_point->check_table($pdo);

//going to check admin table to check existance of data
header("location:inc/first.php");
?>