<?php
    $selector  = $_GET["selector"];
    $validator = $_GET["validator"];

if (empty($selector) || empty($validator)) {
	echo "No validation";

} else {
	if (ctype_xdigit($selector) == false && ctype_xdigit($validator) == false) {
		header("Location: index.php?error=wrongtokenauth");
	}
}

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
    <!-- Icon CDN -->
    <script src="https://kit.fontawesome.com/fea17f5e62.js" crossorigin="anonymous"></script>

    <title>Marina BookIt - Reset Password</title>
</head>
<body>
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="card">
            <div class="card-body" style="width: 25rem">
                <div class="text-center">
                    <img src="../img/logo.png" style="padding: 20px">
                    <h4 class="card-title" style="padding-top: 20px; padding-bottom: 20px">Reset Your Password</h4>
                    <form action="../Handler/resetHandler.php" method="post" class="form-group">
                        <div class="form-group">
                            <input type="text" name="selector" value="<?php echo $selector ?>" hidden>
                        </div>
                        <div class="form-group">
                            <input type="text" name="validator" value="<?php echo $validator ?>" hidden>
                        </div>

                        <!-- nnt tambah view password kat sini -->
                        <div class="form-group">
                            <input type="password" class="form-class form-control" name="userPwd" placeholder="Password">
                        </div>

                        <!-- nnt tambah view password kat sini -->
                        <div class="form-group">
                            <input type="password" class="form-class form-control" name="userPwdRepeat" placeholder="Repeat Password">
                        </div>

                        <div class="form-group" style="padding-top: 20px">
                            <button type="submit" class="btn btn-primary" name="resetPwdSubmitBtn">Reset Password</button>
                        </div>
                    </form>
                </div>

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