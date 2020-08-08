<?php

require 'databaseConnect.php';

function listStaff()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$sqlStr = "SELECT * FROM users WHERE userType = 1 OR userType = 2";
	$qry = mysqli_query($con, $sqlStr);
	mysqli_close($con);
	return $qry;
}
