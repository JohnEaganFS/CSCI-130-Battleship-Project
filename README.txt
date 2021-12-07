Author: John Eagan
CSCI 130 - Battleship Project

Description: This folder contains the html, css, javascript, and php code/files for my battleship project.
The css and php have been placed into sub-folders as to keep each type of file separate from eachother.

Database Information:
Server: 127.0.0.1 via TCP/IP
Server type: MariaDB
Server connection: SSL is not being used Documentation
Server version: 10.4.14-MariaDB - mariadb.org binary distribution
Protocol version: 10
User: root@localhost
Server charset: UTF-8 Unicode (utf8mb4)

Web Server Information:
Apache/2.4.46 (Win64) OpenSSL/1.1.1g PHP/7.4.10
Database client version: libmysql - mysqlnd 7.4.10
PHP extension: mysqli Documentation curl Documentation mbstring Documentation
PHP version: 7.4.10

Installation: To install these web pages, you will need to update the "mysqlconfig.php" file, 
              setup the MySQL database via "createDBandTables.php",
              and finally host the web pages via XAMPP/APACHE.

1. Updating "mysqlconfig.php"
   Within the php folder is a file named "mysqlconfig.php".
   To update the access requirements to the database, you will need to update this information
   with your own database name, username, server, and password.
   Simply replace the appropriate variables with your own PHPmyAdmin information.

2. Setting up the database
   Within the php folder is a file named "createDBandTables.php".
   You will need to run this php file to create the database and its tables.
   If for whatever reason the database seems to be broken or isn't working properly,
   you can run this file again to delete and recreate the database from scratch.

3. Hosting the web pages
   Place this folder along with the html, css, and php files into your htdocs folder within xampp.
   Use XAMPP to host the web pages and the database through APACHE and mySQL.
  
After these three steps, you should be able to access these web pages via localhost.
The main page is named "index.html".

The process of playing battleship is further described in "help.html" once you have the server running, but I will go
through the basic process here.

1. Sign up an account. "signup.html" (Note that two accounts will be needed to play a game against yourself)
2. Login to account. "login.html" (Note that login information is stored via PHP sessions so you will need to relogin if you close the window).
3. Go to Play. "game.html"
4. Invite another user by their username.
5. Accept invite or wait for other player to accept invite.
6. Join the newly created active game.
7. Place your ships according to the alert popups.
8. Hit Ready once all ships have been placed and wait for the other player to ready up.
9. Once both players are ready, join the active game again and begin playing.
10. From here, it is basically battleship where the differently colored cells represent the boards.
11. Once one players has 0 ships remaining, the game will end and your stats will be updated and displayed in "leaderboard.html".