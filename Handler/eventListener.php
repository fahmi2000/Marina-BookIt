<?php
require 'staffHandler.php';
require 'facilityHandler.php';

if (isset($_POST['ADMINprofileUpdateBtn']))
{
	updateStaff();
	header("refresh: 0; url=../listOfStaff.php?msg=updated");
}

if (isset($_POST['ADMINprofileDeleteBtn']))
{
	deleteStaff();
	header("refresh: 0; url=../listOfStaff.php?msg=deleted");
}

if (isset($_POST['ADMINpwdUpdateBtn']))
{
	changePwdStaff();
}

if (isset($_POST['facilityUpdateBtn']))
{
	updateFacility();
}

if (isset($_POST['facilityDeleteBtn']))
{
	deleteFacility();
}