<?php

function getStaffList()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM users WHERE userType = 2";
	$qry = mysqli_query($con, $sql);

	mysqli_close($con);

	return $qry;
}

function viewStaffInfo()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$username = $_POST['staffEdit'];
	$sqlStr = "SELECT * FROM users WHERE username = '".$username."' ";
	$qry = mysqli_query($con, $sqlStr);
	mysqli_close($con);
	return $qry;
}

function updateStaffInfo()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$username = $_POST['username'];
	$password = $_POST['password'];
	$userType = $_POST['userType'];


	$sqlStr = "UPDATE users SET password = '".$password."', userType = '".$userType."' WHERE username = '".$username."' ";

	mysqli_query($con, $sqlStr);
	mysqli_close($con);
}

function deleteStaffInfo()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$staffToDelete = $_POST['staffDelete'];

	$sqlStr = "DELETE FROM users WHERE username = '".$staffToDelete."' ";

	mysqli_query($con, $sqlStr);
	mysqli_close($con);
}