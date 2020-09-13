<?php

function listFacility()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$sqlStr = "SELECT * FROM facility";
	$qry = mysqli_query($con, $sqlStr);
	mysqli_close($con);
	return $qry;
}

function viewFacility()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$facilityID = $_POST['viewFacility'];
	$sql = "SELECT * FROM facility WHERE facilityID = '".$facilityID."' ";
	$qry = mysqli_query($con, $sql);
	mysqli_close($con);
	return $qry;
}

function updateFacility()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$facilityID = $_POST['facilityID'];
	$facilityName = $_POST['facilityName'];
	$facilityCapacity = $_POST['facilityCapacity'];
	$facilityRate = $_POST['facilityRate'];
	$facilityAmenities = $_POST['facilityAmenities'];
	$facilityStatus = $_POST['facilityStatus'];

	$sql = "UPDATE facility SET facilityName = ?, facilityCapacity = ?, facilityRate = ?, facilityAmenities = ?, facilityStatus = ? WHERE facilityID = '".$facilityID."' ";
	$stmt = mysqli_stmt_init($con);

	if (!mysqli_stmt_prepare($stmt, $sql))
	{
		header("Location : ../listOfFacility.php?error=SQL");
		exit();
	}

	else
	{
		mysqli_stmt_bind_param($stmt, "sssss", $facilityName, $facilityCapacity, $facilityRate, $facilityAmenities, $facilityStatus);
		mysqli_stmt_execute($stmt);
		header("Location: ../listOfFacility.php?success=updated");
		exit();
	}
}

function deleteFacility()
{
	{
		$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

		if (mysqli_connect_errno())
		{
			die("FAIL TO CONNECT: " . mysqli_connect_error());
		}

		$facilityID = $_POST['facilityID'];

		$sql = "DELETE FROM facility WHERE facilityID = '".$facilityID."'";
		mysqli_query($con, $sql);
		mysqli_close($con);

		header('Location:../listOfFacility.php?delete=success');
	}
}

//add new facility
if (isset($_POST['facilitySubmitBtn']))
{
	require 'databaseConnect.php';

	$facilityName = $_POST['facilityName'];
	$facilityCapacity = $_POST['facilityCapacity'];
	$facilityRate = $_POST['facilityRate'];
	$facilityAmenities = $_POST['facilityAmenities'];

	if (empty($facilityName) || empty($facilityCapacity) || empty($facilityRate) || empty($facilityAmenities))
	{
		header("Location: ../registerFacility.php?error=empty");
		exit();
	}

	else
	{
		$sql = "SELECT facilityID FROM facility WHERE facilityID = ?";
		$stmt = mysqli_stmt_init($con);

		if (!mysqli_stmt_prepare($stmt, $sql))
		{
			header("Location: ../registerFacility.php?error=SQL");
			exit();
		}

		else
		{
			mysqli_stmt_bind_param($stmt, "s", $facilityName);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);

			if ($resultCheck > 0)
			{
				header("Location: ../registerFacility.php?error=taken");
				exit();
			}

			else
			{
				$sql = "INSERT INTO facility (facilityName, facilityCapacity, facilityRate, facilityAmenities) VALUES (?, ?, ?, ?)";
				$stmt = mysqli_stmt_init($con);

				if (!mysqli_stmt_prepare($stmt, $sql))
				{
					header("Location: ../registerFacility.php?error=SQL");
					exit();
				}

				else
				{
					mysqli_stmt_bind_param($stmt, "ssss", $facilityName, $facilityCapacity, $facilityRate, $facilityAmenities);
					mysqli_stmt_execute($stmt);

					$path = "../img/facility/".$facilityName."";
					if (!file_exists($path))
					{
						mkdir($path, 0777, true);
					}

					header("Location: ../registerFacility.php?success=insert");
					exit();
				}
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($con);
}

//if (isset($_POST['facilityPicBtn']))
//{
//	$file = $_FILES['facilityImg'];
//
//	$fileName = $_FILES['facilityImg']['imgName'];
//	$fileTmpName = $_FILES['facilityImg']['tmp_imgName'];
//	$fileSize = $_FILES['facilityImg']['imgSize'];
//	$fileError = $_FILES['facilityImg']['imgError'];
//	$fileType = $_FILES['facilityImg']['imgtype'];
//
//	$fileExt = explode('.', $fileName);
//	$fileActualExt = strtolower(end($fileExt));
//
//	$allowed = array('jpg', 'jpeg', 'png');
//
//	if (in_array($fileActualExt, $allowed))
//	{
//		if ($fileError === 0)
//		{
//			if ($fileSize < 99999999)
//			{
//				$fileNameNew = $loop
//			}
//		}
//	}
//}