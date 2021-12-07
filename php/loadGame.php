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
		$sql = "SELECT player1super, player1board, player2board, turn, starttime, endtime, active FROM Games WHERE player1 = '" . $player1 . "' AND player2 = '" . $player2 . "' AND active = 1";
	}
	else {
		$sql = "SELECT player2super, player1board, player2board, turn, starttime, endtime, active FROM Games WHERE player1 = '" . $player1 . "' AND player2 = '" . $player2 . "' AND active = 1";
	}
	$result = $link->query($sql);
	
	$newSortedArray = Array();
	while ($row = $result->fetch_assoc()) {
		array_push($newSortedArray, $row);
	}
	$jsonResult = json_encode($newSortedArray);
	echo $jsonResult;

    // Close connection
    mysqli_close($link);
?>