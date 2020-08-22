<?php
Function addNewFacility()
{	
	$con = mysqli_connect('localhost','web39','web39','mbisdb');
	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: ".mysqli_connect_error());
	}
	else
	{
		
		$RoomId = $_POST['RoomId'];
		$RoomName = $_POST['RoomName'];
		$RoomStatus = $_POST['RoomStatus'];
		$RatePerHour = $_POST['RatePerHour'];
		
		$sqlStr = "INSERT INTO facility (RoomId,RoomName,RoomStatus,RatePerHour) 
		VALUE ('$RoomId','$RoomName','$RoomStatus','$RatePerHour')";
		
		$qry = mysqli_query($con,$sqlStr);
		mysqli_close($con);
	}
	
}
function viewFacility()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: ".mysqli_connect_error());
	}
	else
	{	
	$RoomId = $_POST['RoomId'];
	$sqlStr = "SELECT * FROM facility WHERE RoomId = '".$RoomId."' ";
	$qry = mysqli_query($con, $sqlStr);
	mysqli_close($con);
	return $qry;
	}
}
function editFacility()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');
	
	if(mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: ".mysqli_connect_error());
	}
	else
	{
		$RoomName = $_POST['RoomName'];
		$RoomStatus = $_POST['RoomStatus'];
		$RatePerHour = $_POST['RatePerHour'];
		
		$sqlStr = "UPDATE facility SET RoomName='".$RoomName."', RoomStatus='".$RoomStatus."',RatePerHour='".$RatePerHour."'";
		$qry = mysqli_query($con, $sqlStr);
		mysqli_close($con);
		
		header('Location:..update=success');
	}
}
function removeFacility()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');
	
	if(mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: ".mysqli_connect_error());
	}
	else
	{
		$RoomId = $_POST['RoomId'];
		
		$sqlStr = "DELETE FROM facility WHERE RoomId = '".$RoomId."'";
		$qry = mysqli_query($con, $sqlStr);
		mysqli_close($con)
		
		header('Location:..delete=success');
	}
}

?>