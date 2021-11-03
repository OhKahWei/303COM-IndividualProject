<?php
	session_start();
	
	
	$_SESSION['fruit']=array();
	 // Declaring session array
   
     array_push($_SESSION['fruit'], 'Apple','Orange');

	print_r($_SESSION['fruit']);

?>

