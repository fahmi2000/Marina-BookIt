<?php
echo "test";
if (isset($_POST['resetPwdSubmitBtn']))
{
	require 'databaseConnect.php';
	print_r($_POST);
	echo "test";
	$selector = $_POST['selector'];
	$validator = $_POST['validator'];
	$userPwd = $_POST['userPwd'];
	$userPwdRepeat = $_POST['userPwd'];

	if (empty($userPwd) || empty($userPwdRepeat))
	{
		header("Location: ../index.php?error=emptypasword");
		exit();
	}

	elseif ($userPwd != $userPwdRepeat)
	{
		header("Location: ../index.php?error=passwordnotsame");
		exit();
	}

	$currentDate = date("U");



	$sql = "SELECT * FROM pwdreset WHERE pwdResetSelector = ? AND pwdResetExpires >= '".$currentDate."'";
	$stmt = mysqli_stmt_init($con);

	if (!mysqli_stmt_prepare($stmt, $sql))
	{
		header("Location: ../index.php?error=sql");
		exit();
	}

	else
	{
		mysqli_stmt_bind_param($stmt, "s", $selector);
		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);

		if (!$row = mysqli_fetch_assoc($result))
		{
			header("Location: ../loginPage.php?error=wrongselector");
			exit();
		}

		else
		{
			$tokenBin = hex2bin($validator);
			$tokenCheck = password_verify($tokenBin, $row['pwdResetToken']);

			if($tokenCheck === false)
			{
				header("Location: ../loginPage.php?error=falsetoken");
				exit();
			}

			elseif($tokenCheck === true)
			{
				$tokenEmail = $row['pwdResetEmail'];

				$sql = "SELECT * FROM users WHERE userEmail = ?";
				$stmt = mysqli_stmt_init($con);

				if(!mysqli_stmt_prepare($stmt, $sql))
				{
					header("Location: ../loginPage.php?error=sql");
					exit();
				}

				else
				{
					mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
					mysqli_stmt_execute($stmt);

					$result = mysqli_stmt_get_result($stmt);

					if(!$row = mysqli_fetch_assoc($result))
					{
						header("Location: ../loginPage.php?error=usernotfound");
						exit();
					}

					else
					{
						$sql = "UPDATE users SET userPwd = ? WHERE userEmail = ?";
						$stmt = mysqli_stmt_init($con);

						if(!mysqli_stmt_prepare($stmt, $sql))
						{
							header("Location: ../loginPage.php?error=usernotfound2");
							exit();
						}

						else
						{
							$hashedUserPwd = password_hash($userPwd, PASSWORD_DEFAULT);
							mysqli_stmt_bind_param($stmt, "ss", $hashedUserPwd, $tokenEmail);
							mysqli_stmt_execute($stmt);

							$sql = "DELETE FROM pwdreset WHERE pwdResetEmail = ?";
							$stmt = mysqli_stmt_init($con);

							if(!mysqli_stmt_prepare($stmt, $sql))
							{
								header("Location: ../loginPage.php?error=usernotfound3");
								exit();
							}

							else
							{
								mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
								mysqli_stmt_execute($stmt);
								header("Location: ../loginPage.php?success=resetsuccesful");
								exit();
							}
						}
					}
				}
			}
		}
	}
}
