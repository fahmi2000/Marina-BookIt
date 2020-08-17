<?php
session_start();
if (!(isset($_SESSION['username']) && $_SESSION['username'] != ''))
{
	header ("loginPage.php");
}

function generateOTP($length = 10) {
	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$oneTimePwd = '';

	for ($i = 0; $i < $length; $i++)
	{
		$oneTimePwd .= $characters[rand(0, $charactersLength - 1)];
	}

	return $oneTimePwd;
}

function sendVerify()
{
	$con = mysqli_connect('localhost', 'web39', 'web39', 'mbisdb');

	if (mysqli_connect_errno())
	{
		die("FAIL TO CONNECT: " . mysqli_connect_error());
		header("Location: ../signinPage.html?error=sql");
	}

	$userEmail = $_POST['userEmail'];
	$oneTimePwd = generateOTP();

	$name = "Marina BookIt";
	$subject = "Registration Verification";
	$mailFrom = "adelaidemeyrin12343@gmail.com";
	$message = "Your OTP is: ".$oneTimePwd;

	$mailTo = $_POST['userEmail'];
	$headers = "From: ".$mailFrom;
	$txt = "Your registration for ".$name." was successful.\n\n".$message;


	$sql = "UPDATE users SET oneTimePwd = ? WHERE userEmail = ?";
	$stmt = mysqli_stmt_init($con);

	if (!mysqli_stmt_prepare($stmt, $sql))
	{
		header("Location: ../signinPage.html?error=sql");
		exit();
	}

	else
	{
		$hashedOTP = password_hash($oneTimePwd, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "ss",$hashedOTP, $userEmail);
		mysqli_stmt_execute($stmt);
		mail($mailTo, $subject, $txt, $headers);
		header("Location: ../index.php?register=success");
	}

}
