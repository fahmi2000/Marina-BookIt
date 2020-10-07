<?php
session_start();
if (!(isset($_SESSION['userName']) && $_SESSION['userName'] != ''))
{
	header ("loginPage.html");
}
require 'databaseConnect.php';

function getDateCount($startDate, $endDate)
{
	$listDateArr = array();
	$dayPassed = ($endDate - $startDate);
	$dayPassed = ($dayPassed/86400);

	$loop = 1;
	$displayDate = $startDate;

	while($loop < $dayPassed)
	{
		$displayDate += 86400;
		$listDateArr[] = date('o-m-d', $displayDate);
		$loop++;
	}
	array_unshift($listDateArr, $_POST['startDate']);
	array_push($listDateArr, $_POST['endDate']);
	return $listDateArr;
}

function listBooking()
{
	require 'databaseConnect.php';
	$con = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$sqlStr = "SELECT * FROM booking WHERE b_userName = '".$_SESSION['userName']."'";
	$qry = mysqli_query($con, $sqlStr);
	mysqli_close($con);
	return $qry;
}

function viewBooking()
{
	require 'databaseConnect.php';
	$con = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$bookingID = $_POST['viewBooking'];
	$sql = "SELECT * FROM booking WHERE bookingID = '".$bookingID ."'";
	$qry = mysqli_query($con, $sql);
	mysqli_close($con);
	return $qry;
}

function listAllBooking()
{
	require 'databaseConnect.php';
	$con = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM booking";
	$qry = mysqli_query($con, $sql);
	mysqli_close($con);
	return $qry;
}

function listPending()
{
	require 'databaseConnect.php';
	$con = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM booking WHERE bookingStatus = '0'";
	$qry = mysqli_query($con, $sql);
	mysqli_close($con);
	return $qry;
}

function listApproved()
{
	require 'databaseConnect.php';
	$con = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM booking WHERE bookingStatus = '1'";
	$qry = mysqli_query($con, $sql);
	mysqli_close($con);
	return $qry;
}

function listDenied()
{
	require 'databaseConnect.php';
	$con = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM booking WHERE bookingStatus = '2'";
	$qry = mysqli_query($con, $sql);
	mysqli_close($con);
	return $qry;
}

function listCancelled()
{
	require 'databaseConnect.php';
	$con = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM booking WHERE bookingStatus = '3'";
	$qry = mysqli_query($con, $sql);
	mysqli_close($con);
	return $qry;
}

function listRequested()
{
	require 'databaseConnect.php';
	$con = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM booking WHERE bookingStatus = '4'";
	$qry = mysqli_query($con, $sql);
	mysqli_close($con);
	return $qry;
}

function paymentMethod()
{
	require 'databaseConnect.php';
	$con = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}

	$sqlStr = "SELECT * FROM booking WHERE b_userName = '".$_SESSION['userName']."'";
	$qry = mysqli_query($con, $sqlStr);
	mysqli_close($con);
	return $qry;
}

function getFacilityName($ID)
{
	require 'databaseConnect.php';
	$con = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
	}
	$facilityID = $ID;
	$sql = "SELECT facilityName FROM facility WHERE facilityID = '".$facilityID."' ";
	$qry = mysqli_query($con, $sql);
	return $qry;
}


if (isset($_POST['checkAvailableFacilityBtn']))
{
	$facilityName = strtolower($_POST['facilityName']);
	$facilityID = $_POST['facilityID'];
	$startDate = strtotime($_POST['startDate']);
	$endDate = strtotime($_POST['endDate']);

	$listDateArr = (getDateCount($startDate, $endDate));
	$actualEndDate = end($listDateArr);

	$sql = "SELECT * FROM `b_".$facilityName."` WHERE date BETWEEN '".$listDateArr[0]."' AND '".$actualEndDate."' AND b_userName IS NULL";

	$result = mysqli_query($con, $sql);
	$row = mysqli_num_rows($result);

	if (!empty($startDate) && !empty($endDate))
	{
		if ($row == count($listDateArr) || $listDateArr[0] == $listDateArr[1])
		{
			header("Location: ../ProfileFacility.php?viewFacility=".$facilityID."&viewFacilityBtn=View&date=Available&startDate=".$listDateArr[0]."&endDate=".$actualEndDate."&numDays=".$row."");
		}

		elseif ($row !== count($listDateArr) || $listDateArr[0] !== $listDateArr[1])
		{
			header("Location: ../ProfileFacility.php?viewFacility=".$facilityID."&viewFacilityBtn=View&date=NAvailable&startDate=".$listDateArr[0]."&endDate=".$actualEndDate."");
		}
	}

	else
	{
		header("Location: ../ProfileFacility.php?viewFacility=".$facilityID."&viewFacilityBtn=View&date=empty");
	}


	echo "num of row:".$row;
	echo "<br>";
	echo $sql;
	echo "<br>";
	echo "NAME:".$facilityName;
	echo "<br>";
	echo "ID:".$facilityID;
	echo "<br>";
	$string = "Location: ../ProfileFacility.php?viewFacility=".$facilityID."&viewFacilityBtn=View";
	echo "<br>";
	echo $string;
	print_r($listDateArr);
}

if (isset($_POST['bookFacilityBtn']))
{
	$startDate = strtotime($_POST['startDate']);
	$endDate = strtotime($_POST['endDate']);
	$listDateArr = getDateCount($startDate, $endDate);
	$actualStartDate = $listDateArr[0];
	$actualEndDate = end($listDateArr);
	$numDays = $_POST['numDays'];

	$cleanFee = $_POST['cleanFee'];
	$serveFee = $_POST['serveFee'];
	$totalRate = $_POST['totalRate'];

	$facilityID = $_POST['facilityID'];
	$facilityName = strtolower($_POST['facilityName']);
	$userName = $_SESSION['userName'];

	$sql = "INSERT INTO booking (b_userName, b_facilityID, startDate, endDate, b_durationDay, b_totalRate) VALUES ('".$userName."', '".$facilityID."', '".$actualStartDate."', '".$actualEndDate."', '".$numDays."', '".$totalRate."')";
	mysqli_query($con, $sql);

	for ($loop = 0; $loop < count($listDateArr); $loop++)
	{
		$sql = "UPDATE `b_".$facilityName."` SET b_userName = '".$userName."' WHERE date='".$listDateArr[$loop]."' ";
		mysqli_query($con,$sql);
	}

	header("Location: ../listOfFacility.php?msg=booksuccess");

//	echo $startDate;
//	echo '<br>';
//	echo $endDate;
//	echo '<br>';
//	print_r($listDateArr);
//	echo '<br>';
//	echo $actualEndDate;
//	echo '<br>';
//	echo $numDays;
//	echo '<br>';
//	echo $cleanFee;
//	echo '<br>';
//	echo $serveFee;
//	echo '<br>';
//	echo $totalRate;
//	echo '<br>';
//	echo $facilityID;
}

if (isset($_POST['bookingApproveBtn']))
{
	$bookingID = $_POST['bookingID'];
	$facilityName = $_POST['facilityName'];
	$facilityID = $_POST['facilityID'];

	$sql = "UPDATE booking SET bookingStatus = '1' WHERE bookingID = '".$bookingID."'";
	$stmt = mysqli_stmt_init($con);

	if (!mysqli_stmt_prepare($stmt, $sql))
	{
		header("Location : ../listOfBooking.php?msg=sql");
		exit();
	}

	else
	{
		mysqli_stmt_execute($stmt);
		header("Location: ../listOfBooking.php?msg=approved");
		exit();
	}
}

if (isset($_POST['bookingDenyBtn']))
{
	$bookingID = $_POST['bookingID'];
	$facilityName = $_POST['facilityName'];
	$facilityID = $_POST['facilityID'];

	$sql = "UPDATE booking SET bookingStatus = '2' WHERE bookingID = '".$bookingID."'";
	$stmt = mysqli_stmt_init($con);

	if (!mysqli_stmt_prepare($stmt, $sql))
	{
		header("Location : ../listOfBooking.php?msg=sql");
		exit();
	}

	else
	{
		mysqli_stmt_execute($stmt);
		header("Location: ../listOfBooking.php?msg=denied");
		exit();
	}
}

if (isset($_POST['bookingCancelBtn']))
{
	$bookingID = $_POST['bookingID'];
	$facilityName = $_POST['facilityName'];
	$facilityID = $_POST['facilityID'];

	$sql = "UPDATE booking SET bookingStatus = '3' WHERE bookingID = '".$bookingID."'";
	$stmt = mysqli_stmt_init($con);

	if (!mysqli_stmt_prepare($stmt, $sql))
	{
		header("Location : ../listOfBooking.php?msg=sql");
		exit();
	}

	else
	{
		mysqli_stmt_execute($stmt);
		header("Location: ../listOfBooking.php?msg=cancelled");
		exit();
	}
}

if (isset($_POST['bookingCancelRequestBtn']))
{
	$bookingID = $_POST['bookingID'];
	$facilityName = $_POST['facilityName'];
	$facilityID = $_POST['facilityID'];

	$sql = "UPDATE booking SET bookingStatus = '4' WHERE bookingID = '".$bookingID."'";
	$stmt = mysqli_stmt_init($con);

	if (!mysqli_stmt_prepare($stmt, $sql))
	{
		header("Location : ../listOfBooking.php?msg=sql");
		exit();
	}

	else
	{
		mysqli_stmt_execute($stmt);
		header("Location: ../ProfileUser.php?msg=requestcancel");
		exit();
	}
}
