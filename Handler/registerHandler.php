<?php

if (isset($_POST['registerSubmitBtn']))
{
	require 'databaseConnect.php';
	require 'emailHandler.php';
	print_r($_POST);
	$userName = $_POST['userName'];
	$userEmail = $_POST['userEmail'];
	$userPwd = $_POST['userPwd'];
	$userPwdRepeat = $_POST['userPwdRepeat'];
	$userType = $_POST['userType'];
	$fName = $_POST['fName'];
	$lName = $_POST['lName'];
	$phoneNumber = $_POST['phoneNumber'];
	$userGender = $_POST['userGender'];

	if (empty($userName) || empty($userEmail) || empty($userPwd) || empty($userPwdRepeat)) //Check if fields are filled
	{
		header("Location: ../registerMember.html?msg=emptyfields");
		exit();
	}

	elseif (!filter_var($userEmail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $userName))
	{
		header("Location: ../registerMember.html?msg=invalidemail");
		exit();
	}

	elseif (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) //Check if email is valid
	{
		header("Location: ../registerMember.html?msg=invalidemail");
		exit();
	}

	elseif (!preg_match("/^[a-zA-Z0-9]*$/", $userName)) //Check if username is valid
	{
		header("Location: ../registerMember.php?msg=invalidusername");
		exit();
	}

	elseif ($userPwd !== $userPwdRepeat) //Check if password is the same
	{
		header("Location: ../registerMember.php?msg=pwdnotsame");
		exit();
	}

	else
	{
		$sql = "SELECT userID FROM users WHERE userID = ?";
		$stmt = mysqli_stmt_init($con);

		if (!mysqli_stmt_prepare($stmt, $sql))
		{
			header("Location: ../registerMember.html?msg=sql");
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
				header("Location: ../registerMember.html?msg=usernametaken");
				exit();
			}

			else
			{
				$sql = "INSERT INTO users (userName, userEmail, userPwd, userType, fName, lName, phoneNumber, userGender) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
				$stmt = mysqli_stmt_init($con);

				if (!mysqli_stmt_prepare($stmt, $sql))
				{
					header("Location: ../registerMember.html?msg=sql");
					exit();
				}

				else
				{
					$hashedPwd = password_hash($userPwd, PASSWORD_DEFAULT);

					mysqli_stmt_bind_param($stmt, "ssssssss", $userName,$userEmail, $hashedPwd, $userType, $fName, $lName, $phoneNumber, $userGender);
					mysqli_stmt_execute($stmt);

					switch ($userType)
					{
						case 1:
						case 2:
							header("Location: ../registerStaff.php?msg=regstaffsucc");
							exit();

						case 3:
							sendVerify();
							exit();
					}

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