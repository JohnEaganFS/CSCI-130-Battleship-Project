<?php
	//Include config
	require_once "mysqlconfig.php";
	
	session_start();
	if (isset($_SESSION["username"])) {
		echo $_SESSION["username"];
	}
	else {
		echo 2;
	}
	
    // Close connection
    mysqli_close($link);
?>