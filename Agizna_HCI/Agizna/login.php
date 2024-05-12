<?php
// Start session
session_start();

// Check if user is already logged in, redirect to dashboard if true
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}

// Include db connection
include("dbconnection.php");

//~initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err))
    {
        // Prepare a select statement for regular users
        $sql = "SELECT id, user, email, password FROM users WHERE user = ? OR email = ?";
        
        if($stmt = mysqli_prepare($conn, $sql))
        {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
            {
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username/email exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1)
                {                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if (password_verify($password, $hashed_password) && $username == "admin")
                        {
                            // Password is correct, start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username; // Set the 'user' column value to the session variable
                            $_SESSION["email"] = $email;  
                            $_SESSION["role"] = "admin";                         
                            
                            // Redirect user to dashboard page
                            header("location: admin/pages/admin.php");
                        }
                        elseif(password_verify($password, $hashed_password))
                        {
                            // Password is correct, start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username; // Set the 'user' column value to the session variable
                            $_SESSION["email"] = $email;
                            $_SESSION["role"] = "user";                                   
                           
                            //Redirect user
                            header("location: home.php");
                        }
                        else 
                    {
                        // If Username/email doesn't exist in users table, check staff table
                        $sql_staff = "SELECT id, staff, email, password FROM staffs WHERE staff = ? OR email = ?";
                        if($stmt_staff = mysqli_prepare($conn, $sql_staff))
                        {
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt_staff, "ss", $param_username_staff, $param_username_staff);
                            
                            // Set parameters
                            $param_username_staff = $username;
                            
                            // Attempt to execute the prepared statement
                            if(mysqli_stmt_execute($stmt_staff))
                            {
                                // Store result
                                mysqli_stmt_store_result($stmt_staff);
                                
                                // Check if username/email exists in staff table, if yes then verify password
                                if(mysqli_stmt_num_rows($stmt_staff) == 1)
                                {                    
                                    // Bind result variables
                                    mysqli_stmt_bind_result($stmt_staff, $id_staff, $username_staff, $email_staff, $hashed_password_staff);
                                    if(mysqli_stmt_fetch($stmt_staff)){
                                        
                                        if (password_verify($password, $hashed_password_staff)) 
                                        {
                                            echo "Staff authenticated successfully.";
                                            // Password is correct, start a new session
                                            session_start();
                                            
                                            // Store data in session variables
                                            $_SESSION["loggedin"] = true;
                                            $_SESSION["id"] = $id_staff;
                                            $_SESSION["username"] = $username_staff;
                                            $_SESSION["email"] = $email_staff;
                                            $_SESSION["role"] = "staff";     
                                            echo "Redirecting staff to home.php";   
                                            // Redirect staff to admin panel
                                            header("location: home.php");
                                        } 
                                        else 
                                        {
                                            // If Password not valid, display an error message
                                            $password_err = "Invalid username/email or password.";
                                        }
                                    }
                                } 
                                else 
                                {
                                    // If Username/email doesn't exist in staff table, display an error message
                                    $username_err = "Invalid username/email or password.";
                                }
                            } 
                            else 
                            {
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                        }
                        mysqli_stmt_close($stmt_staff);
                    }
                    }
                } 
            } 
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
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
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="my-4">
                        <input type="text" class="form-controls p-3 fs-5" id="login-user" placeholder="Username or Email" name="username">
                        <span><?php echo $username_err; ?></span>
                    </div>
                    <div class="my-4">
                        <input type="password" class="form-controls p-3 fs-5" id="login-password" placeholder="Password" name="password">
                        <span><?php echo $password_err; ?></span>
                    </div>
                    <div class="my-4">
                        <button type="submit" class="bt bt-d b" id="login-btn">LOG IN</button>
                        <?php if(isset($_SESSION["username"])) {echo $_SESSION["username"]; } $username_staff?>
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
