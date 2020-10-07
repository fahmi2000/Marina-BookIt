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

function listFormalFacility()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$sqlStr = "SELECT * FROM facility WHERE facilityType = 'Formal'";
	$qry = mysqli_query($con, $sqlStr);
	mysqli_close($con);
	return $qry;
}

function listSportsFacility()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$sqlStr = "SELECT * FROM facility WHERE facilityType = 'Sports'";
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

	$facilityID = $_GET['viewFacility'];
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

	$facilityAmenitiesSQL = implode(" · ", $facilityAmenities);

	$sql = "UPDATE facility SET facilityName = ?, facilityCapacity = ?, facilityRate = ?, facilityAmenities = ?, facilityStatus = ? WHERE facilityID = '".$facilityID."'";
	$stmt = mysqli_stmt_init($con);

	if (!mysqli_stmt_prepare($stmt, $sql))
	{
		header("Location : ../listOfFacility.php?msg=sql");
		exit();
	}

	else
	{
		mysqli_stmt_bind_param($stmt, "sssss", $facilityName, $facilityCapacity, $facilityRate, $facilityAmenitiesSQL, $facilityStatus);
		mysqli_stmt_execute($stmt);

//		print_r($facilityAmenities);
//		echo '<br>';
//		print_r($_POST);
//		echo '<br>';
//		echo $facilityAmenitiesSQL;
		header("Location: ../listOfFacility.php?msg=updated");
		exit();
	}
}

function deleteFacility()
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

	header('Location:../listOfFacility.php?msg=deleted');

}

//add new facility
if (isset($_POST['facilitySubmitBtn']))
{
	require 'databaseConnect.php';

	$facilityName = $_POST['facilityName'];
	$facilityCapacity = $_POST['facilityCapacity'];
	$facilityRate = $_POST['facilityRate'];
	$facilityAmenities = $_POST['facilityAmenities'];
	$facilityDescription = $_POST['facilityDescription'];
	$facilityType = $_POST['facilityType'];

	$facilityAmenitiesSQL = implode(" · ", $facilityAmenities);

	if (empty($facilityName) || empty($facilityCapacity) || empty($facilityRate) || empty($facilityAmenities))
	{
		header("Location: ../registerFacility.php?msg=empty");
		exit();
	}

	else
	{
		$sql = "SELECT facilityID FROM facility WHERE facilityID = ?";
		$stmt = mysqli_stmt_init($con);

		if (!mysqli_stmt_prepare($stmt, $sql))
		{
			header("Location: ../registerFacility.php?msg=sql");
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
				header("Location: ../registerFacility.php?msg=taken");
				exit();
			}

			else
			{
				$sql = "INSERT INTO facility (facilityName, facilityCapacity, facilityRate, facilityAmenities, facilityDescription, facilityType) VALUES (?, ?, ?, ?, ?, ?)";
				$stmt = mysqli_stmt_init($con);

				if (!mysqli_stmt_prepare($stmt, $sql))
				{
					header("Location: ../registerFacility.php?msg=sql");
					exit();
				}

				else
				{
					mysqli_stmt_bind_param($stmt, "ssssss", $facilityName, $facilityCapacity, $facilityRate, $facilityAmenitiesSQL, $facilityDescription, $facilityType);
					mysqli_stmt_execute($stmt);

					$path = "../img/facility/".$facilityName."";
					if (!file_exists($path))
					{
						mkdir($path, 0777, true);
					}

					$sql = "CREATE TABLE `mbisdb`.`b_".$facilityName."` (ID INT, date DATE, b_userName VARCHAR(20)) ENGINE = InnoDB;";
					mysqli_query($con, $sql);

					$sql2 = "INSERT INTO `b_".$facilityName."` (ID, date, b_userName) SELECT t.n, DATE_ADD('2020-01-01', INTERVAL t.n DAY), NULL
								FROM (SELECT a.N + b.N * 10 + c.N * 100 AS n FROM
						        (SELECT 0 AS N UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) a
						       ,(SELECT 0 AS N UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) b
						       ,(SELECT 0 AS N UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4) c ORDER BY n) t   
								WHERE t.n <= TIMESTAMPDIFF(DAY, '2020-01-01', '2021-12-31');";
					mysqli_query($con, $sql2);

					header("Location: ../registerFacility.php?msg=insert");
					exit();
				}
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($con);
}

if (isset($_POST['facilityPicBtn1']))
{
	$facilityName = $_POST['facilityName'];
	$facilityID = $_POST['facilityID'];
	$fileDestination = '../img/facility/'.$facilityName.'/';


	for ($loop = 0; $loop < ($_FILES['facilityImg']['name']); $loop++)
	{
		$name = $_FILES['facilityImg']['name'][$loop];
		$size = $_FILES['facilityImg']['size'][$loop];
		$type = $_FILES['facilityImg']['type'][$loop];
		$tmp_name = $_FILES['facilityImg']['tmp_name'][$loop];

		$accepted = array('jpg');

		if ($size < 99999999)
		{
			if (in_array(pathinfo($name, PATHINFO_EXTENSION), $accepted))
			{
				$fileNameNew = $loop.".jpg";
				move_uploaded_file($tmp_name, $fileDestination.$fileNameNew);
				header("Location: ../ProfileFacility.php?viewFacility=".$facilityID."&viewFacilityBtn=View&msg=success");
			}
		}

	}
}
