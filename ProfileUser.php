<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

    <!-- Local CSS -->
    <link rel="stylesheet" href="CSS/master.css">
    <style>
        body
        {
            height: 100vh;
        }
    </style>
    <!-- Icon CDN -->
    <script src="https://kit.fontawesome.com/fea17f5e62.js" crossorigin="anonymous"></script>

    <title>#PLACEHOLDER_USERNAME#'s Profile - Marina BookIt</title>
</head>
<body>
<!-- Profile Card -->
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <form method="post" action="Handler/signinHandler.php">

            <!-- Username Card -->
            <div id="swapper-first">
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
                            <div class="forgotLink"><a href="#">Forgot username?</a></div>
                            <br><br>
                            <a href="registerMember.php">Create account</a>
                            <a class="btn btn-primary float-right" id="nextButton" href="#">Next</a>

                        </div>
                    </div>
                </div>
            </div>
        </form>
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