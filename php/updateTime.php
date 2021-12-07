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
	echo json_encode($tot);
	

    // Close connection
    mysqli_close($link);
?>