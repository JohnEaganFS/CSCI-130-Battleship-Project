<?php
	//Include config
	require_once "mysqlconfig.php";
	
	session_start();
	if (isset($_SESSION["username"])) {
		$str = "Current Login: " . trim($_SESSION["username"], '"') . "\n" . "I see you have already logged in and are ready to play some Battleship.\nGo ahead and click the 'Play' option in the menu.";
		echo $str;
		//echo "yeah, it's good my man! Have fun " . $_SESSION["username"] . "!";
	}

    // Close connection
    mysqli_close($link);
?>