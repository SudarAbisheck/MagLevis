<?php

$database_name = "rail_ticket_reserve";
$host = "localhost";
$username = "root";
$password = "";

$conn_error = "<h1>Fatal Error :(</h1>";

if(!@mysql_connect($host, $username, $password) || !@mysql_select_db($database_name)){
	die($conn_error);
}

?>