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

function viewStaff()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

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
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

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

	header('Location:../listOfStaff.php?update=success');
}

function deleteStaff()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$userID = $_POST['userID'];

	$sql = "DELETE FROM users WHERE userID = '".$userID."'";
	mysqli_query($con, $sql);
	mysqli_close($con);

	header('Location:../listOfStaff.php?delete=success');
}

function changePwdStaff()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

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
		header("Location: ../listOfStaff.php?error=passwordnotmatch");
		exit();
	}

	else
	{
		if (!mysqli_stmt_prepare($stmt1, $sql1))
		{
			header("Location: ../listOfStaff.php?error=sqlerror");
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
					header("Location: ../listOfStaff.php?error=SQLError");
					exit();
				}

				else
				{
					$hashedPwd = password_hash($userPwdNew, PASSWORD_DEFAULT);

					mysqli_stmt_bind_param($stmt2, "s", $hashedPwd);
					mysqli_stmt_execute($stmt2);

					header('Location:../listOfStaff.php?password=success');
					exit();
				}
			}

			else
			{
				header("Location: ../listOfStaff.php?error=usernotfound");
				exit();
			}
		}
	}
}