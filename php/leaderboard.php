<?php
	//Include config
	require_once "mysqlconfig.php";
	
	$type = 0;
	if (isset($_POST['type'])) {
		$type = $_POST['type'];
	}
	
	$sql = "";
	switch($type) {
		case "0":
			$sql = "SELECT username, wins, `time`, played FROM `users` ORDER BY username ASC";
			break;
		
		case "1":
			$sql = "SELECT username, wins, `time`, played FROM `users` ORDER BY wins DESC";
			break;
		
		case "2":
			$sql = "SELECT username, wins, `time`, played FROM `users` ORDER BY `time` DESC";
			break;
		
		case "3":
			$sql = "SELECT username, wins, `time`, played FROM `users` ORDER BY played DESC";
			break;
	}
	
	if ($result = $link->query($sql)) {
		$newArray = Array();
		while ($row = $result->fetch_assoc()) {
			array_push($newArray, $row);
		}
		$jsonResult = json_encode($newArray);
		echo $jsonResult;
	}
	else {
		echo "Oops! Something went wrong. Please try again later.";
	}
	
    // Close connection
    mysqli_close($link);
?>