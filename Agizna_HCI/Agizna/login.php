<?php
    include("dbconnection.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head lang="en">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
        <script defer src="js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="containers">
            <div>
                <div class="logo-container" id="logo-display">
                    <img class="logo-img" src="images/output-onlinepngtools.png" alt="big brand logo">
                </div>
            </div>
            <div class="login-containers">
                <form>
                    <div class="my-4">
                        <input type="text" class="form-controls p-3 fs-5" id="login-user" placeholder="Username or Email">
                    </div>
                    <div class="my-4">
                        <input type="password" class="form-controls p-3 fs-5" id="login-password" placeholder="Password">
                    </div>
                    <div class="my-4">
                        <button type="submit" class="bt bt-d b" id="login-btn">LOG IN</button>
                    </div>
                    <div class="mt-2">
                        <p id="h-rule"><span>NEW TO AGIZNA?</span></p>
                    </div>
                    <div class="my-4">
                        <a href="sign-up.php" class="bt bt-l a">SIGN UP</a>
                    </div>
                    <div class="my-4 txt">
                        <p class="fs-6">By registering. You agree to the <a href="#"><b>Terms and Condition</b></a> and <a href="#"><b>Policies of Borcel & Privacy Policy</b></a></p>
                    </div>
                    <div class="my-4 txt">
                        <a href="#">Forgot Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>