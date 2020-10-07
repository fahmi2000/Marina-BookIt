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
		header("Location: ../index.html?msg=emptypassword");
		exit();
	}

	elseif ($userPwd != $userPwdRepeat)
	{
		header("Location: ../index.html?msg=passwordnotsame");
		exit();
	}

	$currentDate = date("U");



	$sql = "SELECT * FROM pwdreset WHERE pwdResetSelector = ? AND pwdResetExpires >= '".$currentDate."'";
	$stmt = mysqli_stmt_init($con);

	if (!mysqli_stmt_prepare($stmt, $sql))
	{
		header("Location: ../index.html?msg=sql");
		exit();
	}

	else
	{
		mysqli_stmt_bind_param($stmt, "s", $selector);
		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);

		if (!$row = mysqli_fetch_assoc($result))
		{
			header("Location: ../signinPage.html?msg=credentials");
			exit();
		}

		else
		{
			$tokenBin = hex2bin($validator);
			$tokenCheck = password_verify($tokenBin, $row['pwdResetToken']);

			if($tokenCheck === false)
			{
				header("Location: ../signinPage.html?msg=credentials");
				exit();
			}

			elseif($tokenCheck === true)
			{
				$tokenEmail = $row['pwdResetEmail'];

				$sql = "SELECT * FROM users WHERE userEmail = ?";
				$stmt = mysqli_stmt_init($con);

				if(!mysqli_stmt_prepare($stmt, $sql))
				{
					header("Location: ../signinPage.html?msg=sql");
					exit();
				}

				else
				{
					mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
					mysqli_stmt_execute($stmt);

					$result = mysqli_stmt_get_result($stmt);

					if(!$row = mysqli_fetch_assoc($result))
					{
						header("Location: ../signinPage.html?msg=credentials");
						exit();
					}

					else
					{
						$sql = "UPDATE users SET userPwd = ? WHERE userEmail = ?";
						$stmt = mysqli_stmt_init($con);

						if(!mysqli_stmt_prepare($stmt, $sql))
						{
							header("Location: ../signinPage.html?msg=credentials");
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
								header("Location: ../signinPage.html?msg=credentials");
								exit();
							}

							else
							{
								mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
								mysqli_stmt_execute($stmt);
								header("Location: ../signinPage.html?msg=resetpwd");
								exit();
							}
						}
					}
				}
			}
		}
	}
}
