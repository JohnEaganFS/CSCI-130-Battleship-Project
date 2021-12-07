<?php
	//Include config
	require_once "mysqlconfig.php";
	
	$username = "";
	session_start();
	if (isset($_SESSION["username"])) {
		$username = $_SESSION["username"];
	}

	//Validate Username
	// Prepare a select statement
    $sql = "SELECT player1, player2 FROM Games WHERE (player1 = '" . $username . "' OR player2 = '" . $username . "') AND active = 1";
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