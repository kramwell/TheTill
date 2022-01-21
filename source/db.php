<?php
//this is for adding the total amount
$totalTrans = 0;

	define('DB_HOST', 'localhost');

    define('DB_USER', 'root');

    define('DB_PASSWORD', '');    

    define('DB', 'shop');   

    //Connect to mysql server

	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB);

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


?>