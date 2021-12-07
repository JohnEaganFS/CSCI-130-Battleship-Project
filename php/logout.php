<?php
	//Include config
	require_once "mysqlconfig.php";
	
	session_start();
	if (isset($_SESSION["username"])) {
		// Unset all of the session variables
		$_SESSION = array();
		 
		// Destroy the session.
		session_destroy();
		exit("You have successfully been logged out!");
	}
	else {
		exit("You are not logged in");
	}
	
    // Close connection
    mysqli_close($link);
?>