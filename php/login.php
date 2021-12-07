<?php
	//Include config
	require_once "mysqlconfig.php";
	
	if (isset($_POST['username']) && isset($_POST['pwd'])) {
		$username = trim($_POST['username']);
		$pwd = trim($_POST['pwd']);
	}
	
	//Validate Username
	// Prepare a select statement
    $sql = "SELECT username, password FROM Users WHERE username = ?";
	
	if($stmt = mysqli_prepare($link, $sql)){
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "s", $param_username);       
		// Set parameters
		$param_username = trim($username);          
		// Attempt to execute the prepared statement
		if(mysqli_stmt_execute($stmt)){
			/* store result */
			mysqli_stmt_store_result($stmt);   
			if(mysqli_stmt_num_rows($stmt) == 1){
				mysqli_stmt_bind_result($stmt, $username, $hashed_password);
				if(mysqli_stmt_fetch($stmt)){
					//exit($pwd);
					//exit($hashed_password);
					if(password_verify($pwd, $hashed_password)){
						/* Password is correct, so start a new session and
						save the username to the session */
						session_start();
						$_SESSION['username'] = $username;      
						echo("You have successfully logged in. Welcome " . trim($username, '"') . "!");
						exit();
						//header("location: /index.html");
					} 
					else{
						// Display an error message if password is not valid
						exit('The password you entered was not valid.');
					}
				}
			} 
			else{
				// Display an error message if username doesn't exist
				exit('No account found with that username.');
			}
		} 
		else{
			exit("Oops! Something went wrong. Please try again later.");
		}
	}
	// Close statement
	mysqli_stmt_close($stmt);
	
    // Close connection
    mysqli_close($link);
?>