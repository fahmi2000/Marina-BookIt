<?php

$serverName = 'localhost';
$dbUsername = 'web39';
$dbPassword = 'web39';
$dbName = 'mbisdb';

$con = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$con)
{
	die("Connection failed: ".mysqli_connect_error());
}