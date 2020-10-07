<?php
$selector  = $_GET["selector"];
$validator = $_GET["validator"];

if (empty($selector) || empty($validator))
{
	echo "No validation";
}

else
{
	if (ctype_xdigit($selector) == false && ctype_xdigit($validator) == false)
	{
		header("Location: index.html?msg=wrongtokenauth");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
	<link rel="stylesheet" href="CSS/bootstrap.css">    <!-- All pages -->
	<link rel="stylesheet" href="CSS/master.css">   <!-- All pages  -->

	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="JavaScript/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
	<script src="JavaScript/popper.min.js" crossorigin="anonymous"></script>
	<script src="JavaScript/bootstrap.bundle.js" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/fea17f5e62.js" crossorigin="anonymous"></script>

	<title>Hello, world!</title>
</head>
<body>
<h1>Hello, world!</h1>

<!-- Local JavaScript -->

<!-- Optional CDN -->

</body>
</html>

