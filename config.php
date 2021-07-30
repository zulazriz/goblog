<?php
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $db = 'blogspot';

  //create connection
  $conn = mysqli_connect($host,$username,$password,$db);

  //check connection
	if (mysqli_connect_errno()){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	} /* else {
    echo "Connected Successfully.";
  }  */
?>
