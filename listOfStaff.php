<?php
session_start();
if (!(isset($_SESSION['username']) && $_SESSION['username'] != ''))
{
	header ("loginPage.html");
}
require 'Handler/staffHandler.php';

$listStaff = listStaff();
$loop = 1;

while ($row = mysqli_fetch_assoc($listStaff))
{
	echo '<table>';
	echo '<tr>';
	echo '<th scope="row">' .$loop. '</th>';
	echo '<td>' .$row['userID']. '</td>';
	echo '<td>' .$row['userName']. '</td>';
	echo '<td>' .$row['userType']. '</td>';
	echo '</tr>';
	echo '</table>';
	$loop++;
}

