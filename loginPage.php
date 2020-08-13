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
        .forgotLink
        {
            padding-top: 10px;
            padding-bottom: 20px;
            font-size: 14px;
        }

        /*.container*/
        /*{*/
        /*    -webkit-animation: slide 0.5s forwards;*/
        /*    -webkit-animation-delay: 2s;*/
        /*    animation: slide 0.5s forwards;*/
        /*    animation-delay: 2s;*/
        /*}*/
    </style>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="JavaScript/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="JavaScript/popper.min.js" crossorigin="anonymous"></script>
    <script src="JavaScript/bootstrap.bundle.js" crossorigin="anonymous"></script>
    <script src="JavaScript/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/fea17f5e62.js" crossorigin="anonymous"></script>


    <title>Sign in - Marina BookIt</title>
</head>

<body>
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <form method="post" action="Handler/signinHandler.php">
                <div class="card" style="width: 25rem;">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="img/logo.png" style="padding: 20px">
                            <h4 class="card-title" style="padding-top: 20px">Sign in</h4>
                            <p style="padding-bottom: 30px">Use your existing account</p>
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <input type="text" class="form-class form-control w-100 border border-primary" name="userName" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <input type="password" class="form-class form-control w-100 border border-primary" name="userPwd" placeholder="Password">
                            </div>
                            <div class="forgotLink"><a href="loginForgot.php">Forgot password?</a></div>
                            <br><br>
                            <a href="registerMember.php">Create account</a>
                            <button type="submit" class="btn btn-primary float-right" name="loginSubmitBtn">Next</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>


<!-- Local JavaScript -->
<?php
    if(isset($_GET['error']))
    {
        if ($_GET['error'] == "emptyfields")
        {
	        echo
	        "<script>
            Swal.fire
            (
              'Error!',
              'All fields must not be empty.',
              'error'
            )        
            </script>";
        }

        elseif ($_GET['error'] == "sqlerror")
        {
	        echo
	        "<script>
            Swal.fire
            (
              'Error!',
              'Connection to the database cannot be established.',
              'error'
            )        
            </script>";
        }

        elseif ($_GET['error'] == "wrongpassword")
        {
	        echo
	        "<script>
            Swal.fire
            (
              'Error!',
              'Incorrect username or password.',
              'error'
            )        
            </script>";
        }
    }

?>

</body>
</html>