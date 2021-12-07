<?php
	//Include config
	require_once "mysqlconfig.php";
	
	$player2 = "";
	$player1 = "";
	if (isset($_POST["player2"])) {
		$player2 = $_POST["player2"];
	}
	if (isset($_POST["player1"])) {
		$player1 = $_POST["player1"];
	}
	$username = "";
	session_start();
	if (isset($_SESSION["username"])) {
		$username = $_SESSION["username"];
	}
	
	$isP1 = false;
	if ($username == $player1) {
		$isP1 = true;
	}
	
	if ($isP1) {
		$sql = "UPDATE Games SET player1super = 0 WHERE player1 = '" . $player1 . "' AND player2 = '" . $player2 . "'";
	}
	else {
		$sql = "UPDATE Games SET player2super = 0 WHERE player1 = '" . $player1 . "' AND player2 = '" . $player2 . "'";
	}

	$link->query($sql);
	

    // Close connection
    mysqli_close($link);
?>