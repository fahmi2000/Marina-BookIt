<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="CSS/master.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <!-- Local CSS -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
        body
        {
            height: 100vh;
        }

        .forgotLink
        {
            padding-top: 10px;
            padding-bottom: 20px;
            font-size: 14px;
        }

        .container
        {
            -webkit-animation: slide 0.5s forwards;
            -webkit-animation-delay: 2s;
            animation: slide 0.5s forwards;
            animation-delay: 2s;
        }

        #bank {display:none;}
    </style>
    <title>Sign in - Marina BookIt</title>
</head>

<body>
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
                                <a href="#">Create account</a>
                                <a class="btn btn-primary float-right" id="nextButton" href="#">Next</a>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Password Card -->
                <div id="swapper-other" style="display:none;">
                    <div class="card" style="width: 25rem;">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="img/logo.png" style="padding: 20px">
                                <h4 class="card-title" style="padding-top: 20px">Sign in</h4>
                                <p style="padding-bottom: 30px">Use your existing account</p>
                            </div>


                                <div class="form-group">
                                    <div class="text-center">
                                        <input type="password" class="form-class form-control w-100 border border-primary" name="userPwd" placeholder="Password">
                                    </div>
                                    <div class="forgotLink"><a href="#">Forgot password?</a></div>
                                    <br><br>
                                    <button type="submit" class="btn btn-primary float-right" name="loginSubmitBtn">Next</button>
                                </div>

                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>


<!-- Optional Script -->
<script>
    //Swap div function
    $('#nextButton').click(function(e){
        $('#swapper-first').fadeOut('slow', function(){
            $('#swapper-other').fadeIn('slow');
        });
    });
</script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>