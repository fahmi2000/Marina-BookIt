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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
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

        #txtBox
        {
            padding-top: 2rem;
        }
    </style>
    <title>Staff Register - Marina BookIt</title>
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
                            <h4 class="card-title" style="padding-top: 20px">Staff Register</h4>
                            <p style="padding-bottom: 10px">Add new staff account</p>
                        </div>
                        <div class="form-group">
                            <div class="text-center" id="txtBox">
                                <input type="text" class="form-class form-control w-100 border border-primary" name="userName" placeholder="Username" required>
                            </div>

                            <div class="text-center" id="txtBox">
                                <input type="email" class="form-class form-control w-100 border border-primary" name="userEmail" placeholder="Email Address" required>
                            </div>

                            <div class="input-group" id="txtBox">
                                <input type="password" class="form-class form-control border border-primary" name="userPwd" placeholder="Password" id="pwdBox" required>
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button" onclick="showPwd()"><i class="fas fa-eye-slash"></i></button>
                                </div>
                            </div>

                            <div class="text-center" id="txtBox">
                                <input type="password" class="form-class form-control w-100 border border-primary" name="userPwdRepeat" placeholder="Repeat Password" required>
                            </div>

                            <div class="text-center" id="txtBox">
                                <select class="form-control w-100 border border-primary" name="userType" required>
                                    <option value="2">Staff</option>
                                    <option value="1">Admin</option>
                                </select>
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


<!-- Optional Script -->
<script>
    function showPwd() {
        var x = document.getElementById("pwdBox");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>