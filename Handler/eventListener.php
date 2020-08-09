<?php
require 'staffHandler.php';

if (isset($_POST['ADMINprofileUpdateBtn']))
{
	updateStaff();
	header("refresh: 0; url=../listOfStaff.php?update=success");
}

if (isset($_POST['ADMINprofileDeleteBtn']))
{
	deleteStaff();
	header("refresh: 0; url=../listOfStaff.php?delete=success");
}

if (isset($_POST['ADMINpwdUpdateBtn']))
{
	changePwdStaff();
}