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
							header("Location: ../MemberDashboard.php?login=success");
							exit();
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

else
{
	header("Location: ../index.html");
	exit();
}