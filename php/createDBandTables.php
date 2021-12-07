<?php
	$servername = "localhost"; // default server name
	$username = "johneagan"; // user name that you created
	$password = "4VPnroTOC6wOU3mn"; // password that you created
	$dbname = "BattleshipProject";

	// Create a database
	function CreateDB($name) {
		global $servername, $username, $password;
		// Create connection
		$conn = new mysqli($servername, $username, $password);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error ."<br>");
		} 
		echo "Connected successfully <br>";
		// Creation of the database
		$sql = "CREATE DATABASE ". $name;
		if ($conn->query($sql)) {
			echo "Database ". $name ." created successfully<br>";
		} else {
			echo "Error creating database ". $name ." : " . $conn->error ."<br>";
		}
		// close the connection
		$conn->close();
	}
	
	// Delete a database
	function DeleteDB($name) {
		global $servername, $username, $password;
		// Create connection
		$conn = new mysqli($servername, $username, $password);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error ."<br>");
		} 
		echo "Connected successfully <br>";
		// Creation of the database
		$sql = "DROP DATABASE ". $name;
		if ($conn->query($sql)) {
			echo "Database ". $name ." deleted successfully<br>";
		} else {
			echo "Error creating database: ". $name ." : " . $conn->error ."<br>";
		}
		// close the connection
		$conn->close();
	}
	
	// Create Table Users
	function createUsersTable($dbname) {
		global $servername, $username, $password;
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		// Creation of a table
		// id = a unique identifier that is created automatically 
		// varchar(n) = string of n characters max 
		$sql = "CREATE TABLE Users (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		username VARCHAR(30), 
		password VARCHAR(150),
		wins VARCHAR(10),
		time VARCHAR(10),
		played VARCHAR(10)
		)";


		if ($conn->query($sql) === TRUE) {
			echo "Table Users created successfully<br>";
		} else {
			echo "Error creating table: " . $conn->error ."<br>";
		}
		// close the connection
		$conn->close();
	}
	
	function createInvitesTable($dbname) {
		global $servername, $username, $password;
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		// Creation of a table
		// id = a unique identifier that is created automatically 
		// varchar(n) = string of n characters max 
		$sql = "CREATE TABLE Invites (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		player1 VARCHAR (30),
		player2 VARCHAR (30)
		)";


		if ($conn->query($sql) === TRUE) {
			echo "Table Invites created successfully<br>";
		} else {
			echo "Error creating table: " . $conn->error ."<br>";
		}
		// close the connection
		$conn->close();
	}
	
	function createGamesTable($dbname) {
		global $servername, $username, $password;
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		// Creation of a table
		// id = a unique identifier that is created automatically 
		// varchar(n) = string of n characters max 
		$sql = "CREATE TABLE Games (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		player1 VARCHAR (30),
		player2 VARCHAR (30),
		ready1 BOOL,
		ready2 BOOL,
		active BOOL,
		starttime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		endtime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		player1super BOOL,
		player2super BOOL,
		player1board VARCHAR (700),
		player2board VARCHAR (700),
		turn BOOL,
		)";


		if ($conn->query($sql) === TRUE) {
			echo "Table Games created successfully<br>";
		} else {
			echo "Error creating table: " . $conn->error ."<br>";
		}
		// close the connection
		$conn->close();
	}
	
	DeleteDB($dbname);
	CreateDB($dbname);
	createUsersTable($dbname);
	createInvitesTable($dbname);
	createGamesTable($dbname);

?>