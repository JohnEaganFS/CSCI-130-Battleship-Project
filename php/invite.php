<?php
	//Include config
	require_once "mysqlconfig.php";
	
	if (isset($_POST['invitee'])) {
		$invitee = trim($_POST['invitee'], '"');
	}
	
	$username = "";
	session_start();
	if (isset($_SESSION["username"])) {
		$username = $_SESSION["username"];
	}

	//Validate Username
	// Prepare a select statement
    $sql = "SELECT id FROM Users WHERE username = ?";
	
	if($stmt = mysqli_prepare($link, $sql)){
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "s", $param_username);       
		// Set parameters
		$param_username = trim($invitee);          
		// Attempt to execute the prepared statement
		if($rslt = mysqli_stmt_execute($stmt)){
			/* store result */
			mysqli_stmt_store_result($stmt);
			$stmt2 = "SELECT id FROM Invites WHERE player2 = '" . $invitee . "' AND player1 = '" . $username . "'";
			$result = $link->query($stmt2);
			if(mysqli_stmt_num_rows($stmt) < 1){
				exit("That user does not exist.");
			}
			else if($result->num_rows > 0) {
				exit("You have already invited that user.");
			}
			else if($invitee == $username) {
				exit("You can't invite yourself.");
			}
			
		} else{
			echo "Oops! Something went wrong. Please try again later.";
		}
	}
	// Close statement
	mysqli_stmt_close($stmt);
	
	$sql = "SELECT id FROM Games WHERE player2 = '" . $invitee . "' AND player1 = '" . $username . "' AND active = 1";
	$result = $link->query($sql);
	if ($result->num_rows > 0) {
		exit("You are already in an active game with that user.");
	}
	
	// Prepare an insert statement
	$sql = "INSERT INTO Invites (player1, player2) VALUES (?, ?)";
	 
	if($stmt = mysqli_prepare($link, $sql)){
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "ss", $player1, $player2);
		
		// Set parameters
		$player1 = $username;
		$player2 = $invitee;
		
		// Attempt to execute the prepared statement
		if(mysqli_stmt_execute($stmt)){
			echo "That user has been invited to a game!";
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