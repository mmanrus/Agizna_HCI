<?php
include("dbconnection.php");
$username_err = '';
$email_err = '';
$password_err = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $con_password = $_POST["con_password"]; 

    // Validate username
    if (empty($username)) 
    {
        $username_err = "Username is empty please enter field";
    } 
    elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) 
    {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    }

    // Validate email
    if (empty($email)) 
    {
        $email_err = "Please enter an email address";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        $email_err = "Invalid email format";
    }

    // Validate password
    if (empty($password)) 
    {
        $password_err = "Please enter a password";
    } 
    elseif ($password !== $con_password) 
    {
        $password_err = "Passwords do not match";
    }

    if (empty($username_err) && empty($email_err) && empty($password_err)) 
    {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check connection
        if (!$conn) 
        {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare SQL statement
        $sql = "INSERT INTO users (user, email, password) VALUES (?, ?, ?)";

        // Prepare statement
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) 
        {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);

            // Execute statement
            mysqli_stmt_execute($stmt);

            // Close statement
            mysqli_stmt_close($stmt);

            echo "<script>alert('{$username} registered successfully.');</script>";
            header("Location: login.php");
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <title>Sign Up</title>
    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
            <div class="sign-containers">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate method="POST">
                    <div class="my-4">
                        <input type="text" class="form-controls" id="register-username" name="username" placeholder="Enter Username" required>
                        <span><?php echo isset($username_err) ? $username_err : ''; ?></span> <!-- Echo error message if exists -->
                    </div>
                    <div class="my-4">
                        <input type="email" class="form-controls" id="register-email" name="email" placeholder="Enter Email" required>
                        <span><?php echo isset($email_err) ? $email_err : ''; ?></span><!-- Echo error message if exists -->
                    </div>
                    <div class="my-4">
                        <input type="password" class="form-controls" id="register-password" name="password"  placeholder="Password" required>
                        <span><?php echo isset($password_err) ? $password_err : ''; ?></span>
                    </div>
                    <div class="my-4">
                        <input type="password" class="form-controls" id="confirm-password" name="con_password"  placeholder="Confirm Password" required>
                        <span><?php echo isset($password_err) ? $password_err : ''; ?></span>
                    </div>
                    <div class="my-4">
                        <button class="bt bt-d b" type="submit" id="register" name="submit">SIGN UP</button>
                    </div>
                    <div class="mt-2">
                        <p id="h-rule"><span>ALREADY HAVE AN ACCOUNT?</span></p>
                    </div>
                    <div class="my-4">
                        <a href="login.php" class="bt bt-l a">LOG IN</a>
                    </div>
                    <div class="my-4 txt">
                        <p class="fs-6">I agree to the <a href="#"><b>Terms and Condition</b></a> and <a href="#"><b>Policies of Borcel & Privacy Policy</b></a></p>
                    </div>
                    <div class="my-4 txt">
                        <a href="#">Forgot Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>



