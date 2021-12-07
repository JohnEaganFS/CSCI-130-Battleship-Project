<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'johneagan');
define('DB_PASSWORD', '4VPnroTOC6wOU3mn');
define('DB_NAME', 'BattleshipProject'); 
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>