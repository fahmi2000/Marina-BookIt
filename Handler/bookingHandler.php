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
	require "databaseConnect.php";
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
			header("Location: ../ProfileFacility.php?viewFacility=".$facilityID."&viewFacilityBtn=View&date=NAvailable");
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

	header("Location: ../ProfileFacility.php?viewFacility=".$facilityID."&viewFacilityBtn=View&booking=success");

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