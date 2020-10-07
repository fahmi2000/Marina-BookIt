<?php
if (isset($_POST['loginSubmitBtn']))
{
	require 'databaseConnect.php';

	$userName = $_POST['userName'];
	$userPwd = $_POST['userPwd'];

	if (empty($userName) || empty($userPwd))
	{
		header("Location: ../signinPage.html?msg=emptyfields");
		exit();
	}

	else
	{
		$sql = "SELECT * FROM users WHERE userName = ? OR userEmail = ?;";
		$stmt = mysqli_stmt_init($con);

		if (!mysqli_stmt_prepare($stmt, $sql))
		{
			header("Location: ../signinPage.html?msg=sql");
			exit();
		}

		else
		{
			mysqli_stmt_bind_param($stmt, "ss" , $userName, $userName);
			mysqli_stmt_execute($stmt);

			$result = mysqli_stmt_get_result($stmt);

			if ($row = mysqli_fetch_assoc($result))
			{
				$pwdVerify = password_verify($userPwd, $row['userPwd']);

				if ($pwdVerify == false)
				{
					header("Location: ../signinPage.html?msg=credentials");
					exit();
				}

				elseif ($pwdVerify == true)
				{
					session_start();
					$_SESSION['userID'] = $row['userID'];
					$_SESSION['userName'] = $row['userName'];
					$_SESSION['userEmail'] = $row['userEmail'];
					$_SESSION['userType'] = $row['userType'];

					switch ($_SESSION['userType'])
					{
						case 1:
							header("Location: ../Dashboard.php?msg=login");
							exit();

						case 2:
							header("Location: ../Dashboard.php?msg=login");
							exit();

						case 3:
							if($row['emailVerify'] == 0)
							{
								header("Location: ../signinOTP.php?info=notverified");
								exit();
							}
							else
							{
								header("Location: ../Dashboard.php?msg=login");
								exit();
							}

					}

				}

				else
				{
					header("Location: ../signinPage.html?msg=credentials");
					exit();
				}
			}

			else
			{
				header("Location: ../signinPage.html?msg=credentials");
				exit();
			}
		}
	}
}

if (isset($_POST['OTPSubmitBtn']))
{
	session_start();

	require 'databaseConnect.php';

	$userName = $_SESSION['userName'];
	$oneTimePwd = $_POST['oneTimePwd'];

	$sql = "SELECT * FROM users WHERE userName = ?";
	$stmt = mysqli_stmt_init($con);

	if (!mysqli_stmt_prepare($stmt, $sql))
	{
		header("Location: ../signinOTP.php?error=sql");
		exit();
	}

	else
	{
		mysqli_stmt_bind_param($stmt, "s", $userName);
		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);

		if ($row = mysqli_fetch_assoc($result))
		{
			$pwdVerify = password_verify($oneTimePwd, $row['oneTimePwd']);

			if ($pwdVerify == false)
			{
				header("Location: ../signinOTP.php?error=wrongOTP");
				exit();
			}

			elseif ($pwdVerify == true)
			{
				$emailVerify = 1;
				$sql1 = "UPDATE users SET emailVerify = ? WHERE userName = '".$userName."' ";
				$stmt1 = mysqli_stmt_init($con);

				if (!mysqli_stmt_prepare($stmt1, $sql1))
				{
					header("Location: ../signinOTP.php?error=sql");
					exit();
				}

				else
				{
					mysqli_stmt_bind_param($stmt1, "s", $emailVerify);
					mysqli_stmt_execute($stmt1);

					$oneTimePwd = 0;
					$sql = "UPDATE users SET oneTimePwd = '".$oneTimePwd."' WHERE userName = '".$userName."'";
					$stmt = mysqli_stmt_init($con);

					if (!mysqli_stmt_prepare($stmt, $sql))
					{
						header("Location: ../signinOTP.php?error=sql");
						exit();
					}

					else
					{
						mysqli_stmt_execute($stmt);
					}

					header("Location: ../Dashboard.php?msg=OTP");
				}
			}

			else
			{
				header("Location: ../signinOTP.php?error=wrongOTP");
				exit();
			}

		}
	}
}