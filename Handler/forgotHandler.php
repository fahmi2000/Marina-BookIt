<?php

if (isset($_POST['resetPwdBtn']))
{
	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);

	$url = "localhost/MBIS/loginReset.php/?selector=".$selector."&validator=".bin2hex($token);

	$expires = date("U") + 1800;

	require 'databaseConnect.php';

	$userEmail = $_POST['userEmail'];

	$sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?";
	$stmt = mysqli_stmt_init($con);

	if (!mysqli_stmt_prepare($stmt, $sql))
	{
		header("Location: ../signinForgot.html?error=sql");
		exit();
	}

	else
	{
		mysqli_stmt_bind_param($stmt, "s", $userEmail);
		mysqli_stmt_execute($stmt);
	}

	$sql = "INSERT INTO pwdreset(pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?)";
	$stmt = mysqli_stmt_init($con);

	if (!mysqli_stmt_prepare($stmt, $sql))
	{
		header("Location: ../signinForgot.html?error=sql");
		exit();
	}

	else
	{
		$hashedToken = password_hash($token, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
		mysqli_stmt_execute($stmt);
	}
}

else
{
	header("Location: ../index.php?error=access");
}

$to = $userEmail;
$subject = "Reset your password for Marina BookIt";
$message = '<p>Password reset link: <a href="'.$url.'"> '.$url.' </a></p> ';

$headers = "From: Marina BookIt <adelaidemeyrin12343@gmail.com>\r\n";
$headers .= "Content-type: text/html\r\n";

mail($to, $subject, $message, $headers);
header("Location: ../signinPage.html?success=reset");

