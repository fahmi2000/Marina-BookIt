<?php
session_start();
if (!(isset($_SESSION['username']) && $_SESSION['username'] != ''))
{
	header ("loginPage.php");
}

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
				$fileNameNew = $_SESSION['userID'].".".$fileActualExt;
				$fileDestination = '../img/profilepic/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);

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