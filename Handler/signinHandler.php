<?php
if (isset($_POST['loginSubmitBtn']))
{
	require 'databaseConnect.php';

	$userName = $_POST['userName'];
	$userPwd = $_POST['userPwd'];

	if (empty($userName) || empty($userPwd))
	{
		header("Location: ../loginPage.php?error=emptyfields");
		exit();
	}

	else
	{
		$sql = "SELECT * FROM users WHERE userName = ? OR userEmail = ?;";
		$stmt = mysqli_stmt_init($con);

		if (!mysqli_stmt_prepare($stmt, $sql))
		{
			header("Location: ../loginPage.php?error=sqlerror");
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
					header("Location: ../loginPage.php?error=wrongpassword");
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
							header("Location: ../DashboardAdmin.php?login=success");
							exit();

						case 2:
							header("Location: ../DashboardStaff.php?login=success");
							exit();

						case 3:
							if($row['emailVerify'] == 0)
							{
								header("Location: ../loginOTP.php?errorusernotverified");
								exit();
							}
							else
							{
								header("Location: ../DashboardMember.php?login=success");
								exit();
							}

					}

				}

				else
				{
					header("Location: ../loginPage.php?error=wrongpassword");
					exit();
				}
			}

			else
			{
				header("Location: ../loginPage.php?error=usernotfound");
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
		header("Location: ../loginOTP.php?error=sqlerror");
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
				header("Location: ../loginOTP.php?error=wrongOTP");
				exit();
			}

			elseif ($pwdVerify == true)
			{
				$emailVerify = 1;
				$sql1 = "UPDATE users SET emailVerify = ? WHERE userName = '".$userName."' ";
				$stmt1 = mysqli_stmt_init($con);

				if (!mysqli_stmt_prepare($stmt1, $sql1))
				{
					header("Location: ../loginOTP.php?error=sql");
					exit();
				}

				else
				{
					mysqli_stmt_bind_param($stmt1, "s", $emailVerify);
					mysqli_stmt_execute($stmt1);



					header("Location: ../DashboardMember.php?OTPsuccess");
				}
			}

			else
			{
				header("Location: ../loginOTP.php?error=wrongOTP");
				exit();
			}

		}
	}
}