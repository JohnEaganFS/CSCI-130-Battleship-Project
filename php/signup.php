<?php
	//Include config
	require_once "mysqlconfig.php";
	
	if (isset($_POST['username']) && isset($_POST['pwd'])) {
		$username = trim($_POST['username']);
		$pwd = trim($_POST['pwd']);
	}
	
	//Validate Username
	// Prepare a select statement
    $sql = "SELECT id FROM Users WHERE username = ?";
	
	if($stmt = mysqli_prepare($link, $sql)){
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "s", $param_username);       
		// Set parameters
		$param_username = trim($username);          
		// Attempt to execute the prepared statement
		if(mysqli_stmt_execute($stmt)){
			/* store result */
			mysqli_stmt_store_result($stmt);   
			if(mysqli_stmt_num_rows($stmt) >= 1){
				exit("This username is already taken.");
			}
		} else{
			echo "Oops! Something went wrong. Please try again later.";
		}
	}
	// Close statement
	mysqli_stmt_close($stmt);
	
	// Prepare an insert statement
	$sql = "INSERT INTO Users (username, password, wins, time, played) VALUES (?, ?, ?, ?, ?)";
	 
	if($stmt = mysqli_prepare($link, $sql)){
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $wins, $time, $played);
		
		// Set parameters
		$param_username = $username;
		$param_password = password_hash($pwd, PASSWORD_DEFAULT); // Creates a password hash
		$wins = "0";
		$time = "0";
		$played = "0";
		
		// Attempt to execute the prepared statement
		if(mysqli_stmt_execute($stmt)){
			// Redirect to login page
			echo "Your account has been created!";
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