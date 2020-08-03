<?php
function validatePassword($username, $password)
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM users WHERE username = '".$username."' and password = '".$password."' ";
	$result = mysqli_query($con, $sql);
	$count = mysqli_num_rows($result);

	if ($count == 1)
	{
		return true;
	}

	else
	{
		return false;
	}
}

function registerUser()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$username = $_POST['username'];
	$password = $_POST['password'];
	$userType = $_POST['userType'];
	echo $username;
	$sql = "INSERT INTO users (username, password, userType) VALUES ('$username', '$password', '$userType')";

	mysqli_query($con, $sql);
	mysqli_close($con);
}


function forgotPwd()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	//X tau lagi nak letak apa kat sini
}

function getUserType($username)
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}
	$sql = "SELECT * FROM users WHERE username = '".$username."' ";
	$result = mysqli_query($con, $sql);
	$count = mysqli_num_rows($result);

	if ($count == 1)
	{
		$row = mysqli_fetch_assoc($result);
		$userType = $row['userType'];
		return $userType;
	}
}


