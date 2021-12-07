<?php
	//Include config
	require_once "mysqlconfig.php";
	
	$username = "";
	session_start();
	if (isset($_SESSION["username"])) {
		$username = $_SESSION["username"];
	}
	if (isset($_POST["pb"])) {
		$pb = $_POST["pb"];
	}
	if (isset($_POST["p1"])) {
		$p1 = $_POST["p1"];
	}
	if (isset($_POST["p2"])) {
		$p2 = $_POST["p2"];
	}
	$readyPlayer = "";
	$isP1 = false;
	
	if ($username == $p1) {
		$readyPlayer = $p1;
		$isP1 = true;
	}
	else {
		$readyPlayer = $p2;
	}
	
	if ($isP1) {
		$sql = "UPDATE `games` SET ready1 = 1, player1board = '" . $pb . "' WHERE player1 = '" . $p1 . "' AND player2 = '" . $p2 . "'";
	}
	else {
		$sql = "UPDATE `games` SET ready2 = 1, player2board = '" . $pb . "' WHERE player1 = '" . $p1 . "' AND player2 = '" . $p2 . "'";
	}
	
	$link->query($sql);
	echo("You are ready to play! Wait for the other player to ready up and then rejoin this game to play or reset your ships.");

    // Close connection
    mysqli_close($link);
?>