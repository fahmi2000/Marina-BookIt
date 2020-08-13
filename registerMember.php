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

        #txtBox
        {
            padding-top: 2rem;
        }
    </style>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="JavaScript/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="JavaScript/popper.min.js" crossorigin="anonymous"></script>
    <script src="JavaScript/bootstrap.bundle.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/fea17f5e62.js" crossorigin="anonymous"></script>

    <title>Register - Marina BookIt</title>
</head>

<body>
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <form method="post" action="Handler/registerHandler.php">

            <!-- Register Card -->
            <div id="swapper-first">
                <div class="card" style="width: 25rem;">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="img/logo.png" style="padding: 20px">
                            <h4 class="card-title" style="padding-top: 20px">Register</h4>
                            <p style="padding-bottom: 10px">Create a new account</p>
                        </div>
                        <div class="form-group">
                            <div class="text-center" id="txtBox">
                                <input type="text" class="form-class form-control w-100" name="userName" placeholder="Username" required>
                            </div>

                            <div class="text-center" id="txtBox">
                                <input type="email" class="form-class form-control w-100" name="userEmail" placeholder="Email Address" required>
                            </div>

                            <div class="input-group" id="txtBox">
                                <input type="password" class="form-class form-control" name="userPwd" placeholder="Password" id="pwdBox" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="showPwd()"><i class="fas fa-eye-slash"></i></button>
                                </div>
                            </div>

                            <div class="input-group" id="txtBox">
                                <input type="password" class="form-class form-control" name="userPwdRepeat" placeholder="Repeat Password" id="pwdBox2" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="showPwd2()"><i class="fas fa-eye-slash"></i></button>
                                </div>
                            </div>

                            <div class="text-center" id="txtBox">
                                <input type="text" class="form-class form-control w-100" name="userType" value="3" readonly hidden>
                            </div>

                            <div style="padding-top: 5rem">
                                <button type="submit" class="btn btn-primary float-right" name="registerSubmitBtn" >Next</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Additional Script -->
<script>
    function showPwd() {
        var x = document.getElementById("pwdBox");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function showPwd2() {
        var x = document.getElementById("pwdBox2");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

</body>
</html>