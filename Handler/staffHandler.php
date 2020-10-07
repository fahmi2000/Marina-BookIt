<?php

function listStaff()
{
	require "databaseConnect.php";
	$con = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$sqlStr = "SELECT * FROM users WHERE userType = 1 OR userType = 2";
	$qry = mysqli_query($con, $sqlStr);
	mysqli_close($con);
	return $qry;
}

function viewStaff()
{
	require "databaseConnect.php";
	$con = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$userName = $_POST['viewStaff'];
	$sql = "SELECT * FROM users WHERE userName = '".$userName."' ";
	$qry = mysqli_query($con, $sql);
	mysqli_close($con);
	return $qry;
}

function updateStaff()
{
	require "databaseConnect.php";
	$con = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$userID = $_POST['userID'];
	$fName = $_POST['fName'];
	$lName = $_POST['lName'];
	$userEmail = $_POST['userEmail'];
	$phoneNumber = $_POST['phoneNumber'];
	$userGender = $_POST['userGender'];

	$sql = "UPDATE users SET fName = '".$fName."', lName = '".$lName."', userEmail = '".$userEmail."', phoneNumber = '".$phoneNumber."', userGender = '".$userGender."' WHERE userID = '".$userID."' ";

	mysqli_query($con, $sql);
	mysqli_close($con);

	header('Location:../listOfStaff.php?msg=updated');
}

function deleteStaff()
{
	require "databaseConnect.php";
	$con = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$userID = $_POST['userID'];

	$sql = "DELETE FROM users WHERE userID = '".$userID."'";
	mysqli_query($con, $sql);
	mysqli_close($con);

	header('Location:../listOfStaff.php?msg=deleted');
}

function changePwdStaff()
{
	require "databaseConnect.php";
	$con = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$userID = $_POST['userID'];
	$userPwdNew = $_POST['userPwdNew'];
	$userPwdNewRepeat = $_POST['userPwdNewRepeat'];

	$sql1 = "SELECT * FROM users WHERE userID = ?";
	$stmt1 = mysqli_stmt_init($con);

	if ($userPwdNew !== $userPwdNewRepeat)
	{
		header("Location: ../listOfStaff.php?msg=passwordnotmatch");
		exit();
	}

	else
	{
		if (!mysqli_stmt_prepare($stmt1, $sql1))
		{
			header("Location: ../listOfStaff.php?msg=sql");
			exit();
		}

		else
		{
			mysqli_stmt_bind_param($stmt1, "s" , $userID);
			mysqli_stmt_execute($stmt1);

			$result = mysqli_stmt_get_result($stmt1);

			if ($row = mysqli_fetch_assoc($result))
			{
				$sql2 = "UPDATE users SET userPwd = ? WHERE userID = '".$userID."'";
				$stmt2 = mysqli_stmt_init($con);

				if (!mysqli_stmt_prepare($stmt2, $sql2))
				{
					header("Location: ../listOfStaff.php?msg=sql");
					exit();
				}

				else
				{
					$hashedPwd = password_hash($userPwdNew, PASSWORD_DEFAULT);

					mysqli_stmt_bind_param($stmt2, "s", $hashedPwd);
					mysqli_stmt_execute($stmt2);

					header('Location:../listOfStaff.php?msg=pwd');
					exit();
				}
			}

			else
			{
				header("Location: ../listOfStaff.php?msg=usernotfound");
				exit();
			}
		}
	}
}
