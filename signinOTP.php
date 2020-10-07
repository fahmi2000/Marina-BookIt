<?php
session_start();
if (!(isset($_SESSION['username']) && $_SESSION['username'] != ''))
{
	header ("loginPage.php?error=credentials");
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
    <style>
        .container-signin
        {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #signinBox1
        {
            height: 60vh;
            width: 40vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #signinBox2
        {
            padding: 20px;
            height: 60vh;
            width: 40vh;
            display: flex;
            justify-content: center;
            align-items: center;
            border-left: solid dimgrey;
        }
    </style>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="JavaScript/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="JavaScript/popper.min.js" crossorigin="anonymous"></script>
    <script src="JavaScript/bootstrap.bundle.js" crossorigin="anonymous"></script>
    <script src="JavaScript/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/fea17f5e62.js" crossorigin="anonymous"></script>

    <title>Email Verification - Marina BookIt</title>
</head>
<body>
<div class="container-signin">

    <div class="box" id="signinBox1">
        <a href="index.html"><img src="img/logo.png" alt=""></a>
    </div>

    <div class="box" id="signinBox2">
        <div class="text-center">
            <h3>Email Verification</h3>
            <p>A 10-digit OTP was sent to your e-mail</p>
            <form class="form-group" action="Handler/signinHandler.php" method="post">
                <div class="form-group">
                    <input class="form-class form-control text-center" type="password" name="oneTimePwd" placeholder="One Time Password">
                </div>
                <div class="form-group">
                    <button class="btn btn-dark btn-block" type="submit" name="OTPSubmitBtn">Next</button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Local JavaScript -->
<script>
    let url = new URL(window.location.href);
    let searchParams = new URLSearchParams(url.search);
    var info = searchParams.get('info');
    var error = searchParams.get('error');

    if(info === 'notverified')
    {
        Swal.fire
        (
            'Info',
            'Your account is not verified!',
            'info'
        )
    }
    else if(error === 'sql')
    {
        Swal.fire
        (
            'Error',
            'Database connection could not be established.',
            'error'
        )
    }

    else if(error === 'wrongOTP')
    {
        Swal.fire
        (
            'Error',
            'Your OTP was invalid!',
            'error'
        )
    }

</script>

<!-- Optional CDN -->

</body>
</html>