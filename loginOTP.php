<?php
session_start();
if (!(isset($_SESSION['username']) && $_SESSION['username'] != ''))
{
	header ("loginPage.php");
}
print_r($_POST);
print_r($_SESSION);
?>

<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

	<!-- Local CSS -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
        body
        {
            height: 100vh;
        }

        .container
        {
            -webkit-animation: slide 0.5s forwards;
            -webkit-animation-delay: 2s;
            animation: slide 0.5s forwards;
            animation-delay: 2s;
        }

    </style>
	<!-- Icon CDN -->
	<script src="https://kit.fontawesome.com/fea17f5e62.js" crossorigin="anonymous"></script>

	<title>Account Verification</title>
</head>
<body>
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="card" style="width: 25rem;">
            <div class="card-body">
                <div class="text-center">
                    <img src="img/logo.png" style="padding: 20px">
                    <h4 class="card-title" style="padding-top: 20px">Account Verification</h4>
                </div>
                <br>
                <div class="text-justify">
                    <p class="card-text">A 10-digit code was sent to your email address during registration.</p>
                    <p class="card-text">Please check your spam and trash folder as well.</p>
                </div>
                <br>
                <form action="Handler/signinHandler.php" method="post">
                    <input type="password" class="form-class form-control w-100 border border-primary" name="oneTimePwd" placeholder="One Time Password">
                    <br>
                    <button type="submit" class="btn btn-primary float-right" name="OTPSubmitBtn">Next</button>
                </form>
                <button type="" class="btn btn-outline-primary float-left" name="">¯\_(ツ)_/¯</button>
            </div>
        </div>
    </div>
</div>


<!-- Local JavaScript -->
<!-- Optional CDN -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
</body>
</html>