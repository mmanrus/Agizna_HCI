<?php
include('../../dbconnection.php');

$username_err = '';
$email_err = '';
$password_err ='';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $con_password = $_POST['con_password'];

    if (empty($username)) {
        $username_err = "Username is empty please enter field";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    }

    if (empty($email)) {
        $email_err = "Please enter an email address";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please enter a valid email address";
    }

    if (empty($password) || empty($con_password)) {
        $password_err = "Please enter both password fields";
    } elseif ($password !== $con_password) {
        $password_err = "Passwords do not match";
    }

    if (empty($username_err) && empty($password_err) && empty($email_err)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare SQL statement with placeholders
        $sql = "INSERT INTO staffs (staff, email, password) VALUES (?, ?, ?)";

        // Prepare statement
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);

            // Execute statement
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('{$username} registered successfully.');
                      window.location.href = 'add_staff.php';
                      </script>";
                exit; // Exit after redirection
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close statement
        mysqli_stmt_close($stmt);
        // Close connection
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agizna Admin Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/style.css?v=<?php echo time(); ?>">
</head>

<body>
<?php
    include('nav.php');
?>
    <!-- =============== Navigation ================ -->    
        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline" class="my-2"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.png" alt="">
                </div>
            </div>

            <!-- ======================= Add Staff ================== -->
            <div class="containersReg">
                <div class="reg-containers">
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

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>