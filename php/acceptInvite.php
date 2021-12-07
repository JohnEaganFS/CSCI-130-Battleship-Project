<?php
	//Include config
	require_once "mysqlconfig.php";
	
	$player2 = "";
	session_start();
	if (isset($_SESSION["username"])) {
		$player2 = $_SESSION["username"];
	}
	if (isset($_POST["player1"])) {
		$player1 = $_POST["player1"];
	}

	$sql = "INSERT INTO Games (`player1`, `player2`, `ready1`, `ready2`, `active`, `player1super`, `player2super`, turn)
	        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			
	if($stmt = mysqli_prepare($link, $sql)){
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "ssssssss", $param_player1, $param_player2, $param_ready1, $param_ready2, $param_active, $param_player1super, $param_player2super, $param_turn);
		
		// Set parameters
		$param_player1 = $player1;
		$param_player2 = $player2;
		$param_ready1 = false;
		$param_ready2 = false;
		$param_active = true;
		$param_player1super = false;
		$param_player2super = false;
		$param_turn = false;
		
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

    // Close connection
    mysqli_close($link);
?>