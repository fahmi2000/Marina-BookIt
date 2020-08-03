<?php
session_start();
include "../Function/loginFunction.php";

$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];

$_SESSION['curTime'] = time('G:i:sa');


$username = $_POST['username'];
$password = $_POST['password'];



$isValidUser = validatePassword($username,$password);

if (isset($_POST['loginButton']))
{
	if ($isValidUser)
	{
		$userType = getUserType($username);
		$_SESSION['userType'] = $userType;

		switch ($userType)
		{
			case 1://Redirect to admin

				header("refresh: 0; url=../adminDashboard.php");
				break;

			case 2://Redirect to staff
				header("refresh: 0; url=../staffDashboard.php");
				break;

			case 3://Redirect to member
				header("refresh: 0; url=../memberDashboard.php");
				break;
		}
	}

	else
	{
		echo "<script> alert('Incorrect credentials!'); </script>";
		//plan nak letak SweetAlert nnt
		header ("refresh: 0; url=LogInPage.html");
	}
}

if (isset($_POST['forgotPwd']))
{
	forgotPwd();
	//Ni bagi aku fikir dulu
}

if (isset($_POST['createButton']))
{
	header ("refresh: 0; url=../registerMember.html");
	//Redirect to register page
}

if (isset($_POST['registerButton']))
{
	registerUser();
}

?>