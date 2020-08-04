<?php

if (isset($_POST['registerSubmitBtn']))
{
	require 'databaseConnect.php';

	$userName = $_POST['userName'];
	$userEmail = $_POST['userEmail'];
	$userPwd = $_POST['userPwd'];
	$userPwdRepeat = $_POST['userPwdRepeat'];
	$userType = $_POST['userType'];

	if (empty($userName) || empty($userEmail) || empty($userPwd) || empty($userPwdRepeat)) //Check if fields are filled
	{
		header("Location: ../registerMember.html?error=emptyfields&userName=".$userName."&userEmail=".$userEmail);
		exit();
	}

	elseif (!filter_var($userEmail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $userName))
	{
		header("Location: ../registerMember.html?error=invaliduserEmail&userName=");
		exit();
	}

	elseif (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) //Check if email is valid
	{
		header("Location: ../registerMember.html?error=invaliduserEmail&userName=".$userName);
		exit();
	}

	elseif (!preg_match("/^[a-zA-Z0-9]*$/", $userName)) //Check if username is valid
	{
		header("Location: ../registerMember.html?error=invaliduserID&userEmail=".$userEmail);
		exit();
	}

	elseif ($userPwd !== $userPwdRepeat) //Check if password is the same
	{
		header("Location: ../registerMember.html?error=passwordCheck&userName=".$userName."userEmail".$userEmail);
		exit();
	}

	else
	{
		$sql = "SELECT userID FROM users WHERE userID = ?";
		$stmt = mysqli_stmt_init($con);

		if (!mysqli_stmt_prepare($stmt, $sql))
		{
			header("Location: ../registerMember.html?error=SQLError");
			exit();
		}

		else
		{
			mysqli_stmt_bind_param($stmt, "s", $userName);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);

			if ($resultCheck > 0)
			{
				header("Location: ../registerMember.html?error=userNameTaken&userEmail=".$userEmail);
				exit();
			}

			else
			{
				$sql = "INSERT INTO users (userName, userEmail, userPwd, userType) VALUES (?, ?, ?, ?)";
				$stmt = mysqli_stmt_init($con);

				if (!mysqli_stmt_prepare($stmt, $sql))
				{
					header("Location: ../registerMember.html?error=SQLError");
					exit();
				}

				else
				{
					$hashedPwd = password_hash($userPwd, PASSWORD_DEFAULT);

					mysqli_stmt_bind_param($stmt, "ssss", $userName,$userEmail, $hashedPwd, $userType);
					mysqli_stmt_execute($stmt);

					header("Location: ../registerMember.html?register=success");
					exit();
				}

			}

		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($con);
}

else
{
	header("Location: ../registerMember.html");
	exit();
}