<?php
session_start();
if (!(isset($_SESSION['username']) && $_SESSION['username'] != ''))
{
	header ("loginPage.php");
}
$userID = $_SESSION['userID'];
require 'databaseConnect.php';

if (isset($_POST['userPicBtn']))
{
	$file = $_FILES['file'];

	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg', 'jpeg', 'png');

	if (in_array($fileActualExt, $allowed))
	{
		if($fileError === 0)
		{
			if ($fileSize < 99999999)
			{
				$fileNameNew = $userID.".".$fileActualExt;

				$fileNameNew = $_SESSION['userID'].".".$fileActualExt;
				$fileDestination = '../img/profilepic/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);

				$sql = "UPDATE users SET userPic = '".$fileNameNew."' WHERE userID = '".$_SESSION['userID']."' ";
				$qry = mysqli_query($con, $sql);

				header("Location:../ProfileUser.php?uploadsuccess");
			}
		}
		else
		{
			echo "Error file";
			print_r($_FILES);
		}
	}
	else
	{
		echo "Error type";
		print_r($_FILES);
	}

}

if (isset($_POST['profileUpdateBtn']))
{
	$fName = $_POST['fName'];
	$lName = $_POST['lName'];
	$userEmail = $_POST['userEmail'];
	$phoneNumber = $_POST['phoneNumber'];
	$userGender = $_POST['userGender'];

	$sql = "UPDATE users SET fName = ?, lName = ?, userEmail = ?, phoneNumber = ?, userGender = ? WHERE userID = '".$_SESSION['userID']."' ";
	$stmt = mysqli_stmt_init($con);

	if (!mysqli_stmt_prepare($stmt, $sql))
	{
		header("Location: ../ProfileUser.php?error=SQLError");
		exit();
	}

	else
	{
		mysqli_stmt_bind_param($stmt, "sssss", $fName,$lName, $userEmail, $phoneNumber, $userGender);
		mysqli_stmt_execute($stmt);

		header("Location: ../ProfileUser.php?update=success");
		exit();
	}
	mysqli_stmt_close($stmt);
	mysqli_close($con);
}

if (isset($_POST['pwdUpdateBtn']))
{
	$userPwd = $_POST['userPwd'];
	$userPwdNew = $_POST['userPwdNew'];
	$userPwdNewRepeat = $_POST['userPwdNewRepeat'];

	$sql1 = "SELECT * FROM users WHERE userID = ?";
	$stmt1 = mysqli_stmt_init($con);

	if (!mysqli_stmt_prepare($stmt1, $sql1))
	{
		header("Location: ../ProfilePage.php?error=sqlerror");
		exit();
	}

	else
	{
		mysqli_stmt_bind_param($stmt1, "s" , $userID);
		mysqli_stmt_execute($stmt1);

		$result = mysqli_stmt_get_result($stmt1);

		if ($row = mysqli_fetch_assoc($result))
		{
			$pwdVerify = password_verify($userPwd, $row['userPwd']);

			if ($pwdVerify == false)
			{
				header("Location: ../ProfilePage.php?error=wrongpassword");
				exit();
			}

			elseif ($pwdVerify == true)
			{
				$sql2 = "UPDATE users SET userPwd = ? WHERE userID = '".$userID."'";
				$stmt2 = mysqli_stmt_init($con);

				if (!mysqli_stmt_prepare($stmt2, $sql2))
				{
					header("Location: ../ProfileUser.php?error=SQLError");
					exit();
				}

				else
				{
					$hashedPwd = password_hash($userPwdNew, PASSWORD_DEFAULT);
					
					mysqli_stmt_bind_param($stmt2, "s", $hashedPwd);
					mysqli_stmt_execute($stmt2);

					header("Location: ../ProfileUser.php?update=success");
					exit();
				}
			}

			else
			{
				header("Location: ../ProfileUser.php?error=wrongpassword");
				exit();
			}
		}

		else
		{
			header("Location: ../ProfileUser.php?error=usernotfound");
			exit();
		}

	}
}



