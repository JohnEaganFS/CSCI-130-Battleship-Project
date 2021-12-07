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
	
	$sql = "SELECT ready1, ready2 FROM Games WHERE player1 = '" . $player1 . "' AND player2 = '" . $player2 . "' AND active = 1";
	$result = $link->query($sql);
	
	$newSortedArray = Array();
	while ($row = $result->fetch_assoc()) {
		array_push($newSortedArray, $row);
	}
	$jsonResult = json_encode($newSortedArray);
	echo $jsonResult;

/*
	$sql = "INSERT INTO Games (`player1`, `player2`, `ready`, `active`, `player1super`, `player2super`)
	        VALUES (?, ?, ?, ?, ?, ?)";
			
	if($stmt = mysqli_prepare($link, $sql)){
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "ssssss", $param_player1, $param_player2, $param_ready, $param_active, $param_player1super, $param_player2super);
		
		// Set parameters
		$param_player1 = $player1;
		$param_player2 = $player2;
		$param_ready = false;
		$param_active = true;
		$param_player1super = false;
		$param_player2super = false;
		
		// Attempt to execute the prepared statement
		if(mysqli_stmt_execute($stmt)){
			echo "Your game has been created!";
			$sql = "DELETE FROM Invites WHERE player1 = '" . $player1 . "' AND player2 = '" . $player2 . "'";
			$link->query($sql);
		} 
		else{
			echo "Something went wrong. Please try again later.";
		}
	}
	// Close statement
	mysqli_stmt_close($stmt);
	*/

    // Close connection
    mysqli_close($link);
?>