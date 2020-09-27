<?php
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

if (isset($_POST['checkAvailableFacilityBtn']))
{
	$facilityName = strtolower($_POST['facilityName']);
	$facilityID = $_POST['facilityID'];
	$startDate = strtotime($_POST['startDate']);
	$endDate = strtotime($_POST['endDate']);

	$listDateArr = (getDateCount($startDate, $endDate));
	$actualEndDate = end($listDateArr);

	$sql = "SELECT * FROM `b_".$facilityName."` WHERE date BETWEEN '".$listDateArr[0]."' AND '".$actualEndDate."' AND b_userID IS NULL";

	$result = mysqli_query($con, $sql);
	$row = mysqli_num_rows($result);

	if ($row == count($listDateArr) || $listDateArr[0] == $listDateArr[1])
		header("Location: ../ProfileFacility.php?viewFacility=".$facilityID."&viewFacilityBtn=View&date=Available&startDate=".$listDateArr[0]."&endDate=".$actualEndDate."&numDays=".$row."");

	else
		header("Location: ../ProfileFacility.php?viewFacility=".$facilityID."&viewFacilityBtn=View&date=NAvailable");

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
	
}