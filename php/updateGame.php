<?php
	//Include config
	require_once "mysqlconfig.php";
	
	$username = "";
	session_start();
	if (isset($_SESSION["username"])) {
		$username = $_SESSION["username"];
	}
	if (isset($_POST["eb"])) {
		$eb = $_POST["eb"];
	}
	if (isset($_POST["p1"])) {
		$p1 = $_POST["p1"];
	}
	if (isset($_POST["p2"])) {
		$p2 = $_POST["p2"];
	}
	if (isset($_POST["active"])) {
		$active = $_POST["active"];
	}
	if (isset($_POST["turn"])) {
		$turn = $_POST["turn"];
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
		$sql = "UPDATE `games` SET active = '" . $active . "', player2board = '" . $eb . "', turn = '" . $turn . "' WHERE player1 = '" . $p1 . "' AND player2 = '" . $p2 . "'";
	}
	else {
		$sql = "UPDATE `games` SET active = '" . $active . "', player1board = '" . $eb . "', turn = '" . $turn . "' WHERE player1 = '" . $p1 . "' AND player2 = '" . $p2 . "'";
	}
	
	$link->query($sql);
	
	$sql = "SELECT active FROM Games WHERE player1 = '" . $p1 . "' AND player2 = '" . $p2 . "'";
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