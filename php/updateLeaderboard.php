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
	if (isset($_POST["win"])) {
		$win = $_POST["win"];
	}
	if (isset($_POST["gamesplayed"])) {
		$gamesplayed = $_POST["gamesplayed"];
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

	$sql = "UPDATE `games` SET endtime = CURRENT_TIMESTAMP WHERE player1 = '" . $player1 . "' AND player2 = '" . $player2 . "'";

	$link->query($sql);
	
	$sql = "SELECT starttime, endtime FROM Games WHERE player1 = '" . $player1 . "' AND player2 = '" . $player2 . "'";
	$result = $link->query($sql);
	
	$newSortedArray = Array();
	while ($row = $result->fetch_assoc()) {
		array_push($newSortedArray, $row);
	}
	$ts1 = strtotime($newSortedArray[0]["starttime"]);
	$ts2 = strtotime($newSortedArray[0]["endtime"]);
	$tot = $ts2 - $ts1;

	$sql = "UPDATE Users SET wins = wins + " . $win . ", time = time + " . $tot . ", played = played + 1 WHERE username = '" . $username . "'";
	$link->query($sql);
	
	$sql = "UPDATE Users SET time = time + " . $tot . ", played = played + 1 WHERE username = '" . $player2 . "'";
	$link->query($sql);
	
    // Close connection
    mysqli_close($link);
?>