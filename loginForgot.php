<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="CSS/bootstrap.css">    <!-- All pages -->
    <link rel="stylesheet" href="CSS/master.css">   <!-- All pages  -->
    <style>
        .container
        {
            -webkit-animation: slide 0.5s forwards;
            -webkit-animation-delay: 2s;
            animation: slide 0.5s forwards;
            animation-delay: 2s;
        }
    </style>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="JavaScript/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="JavaScript/popper.min.js" crossorigin="anonymous"></script>
    <script src="JavaScript/bootstrap.bundle.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/fea17f5e62.js" crossorigin="anonymous"></script>

	<title>Marina BookIt - Forgot Password</title>
</head>
<body>
<div class="container h-100">
	<div class="row h-100 justify-content-center align-items-center">
		<div class="card" style="width: 25rem;">
			<div class="card-body">
				<div class="text-center">
					<img src="img/logo.png" style="padding: 20px">
					<h4 class="card-title" style="padding-top: 20px">Forgot Password</h4>
				</div>
				<br>
				<div class="text-center">
					<p class="card-text">Send a reset password link to your email address.</p>
				</div>
				<br>
				<form action="Handler/forgotHandler.php" method="post">
					<input type="email" class="form-class form-control w-100 border border-primary" name="userEmail" id="userEmail" placeholder="Email">
					<br>
					<button type="submit" class="btn btn-primary float-right" name="resetPwdBtn">Next</button>
				</form>
				<button type="" class="btn btn-outline-primary float-left" name="">Resend Link</button>
			</div>
		</div>
	</div>
</div>
<!-- Local JavaScript -->
</body>
</html>