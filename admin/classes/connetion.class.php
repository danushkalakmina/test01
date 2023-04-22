<?php

define("MYSQL_SERVER", "wastyrds.czuhu8pacwix.us-east-1.rds.amazonaws.com:3306");
define("MYSQL_USER", "admin");
define("MYSQL_PASSWORD", "6yvkJ?OiGWrB{8eF");
define("MYSQL_DATABASE", "wastey");

($GLOBALS["__mysqli_connect"] = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD)) or die ('I cannot connect to the database because 1: ' . mysqli_error($GLOBALS["__mysqli_connect"]));
mysqli_select_db($GLOBALS["__mysqli_connect"], constant('MYSQL_DATABASE')) or die ('I cannot connect to the database because 2: ' . mysqli_error($GLOBALS["__mysqli_connect"]));
?>