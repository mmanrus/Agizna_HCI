<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agizna Admin Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container-x">
        <div class="navigation-xx">
            <ul class="mx-0">
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="logo-Agizna">Agizna</ion-icon>
                        </span>
                        <span class="title">Agizna</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Add Staff</span>
                    </a>
                </li>
                <!--
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Messages</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Help</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Password</span>
                    </a>
                </li>
                -->
                <li>
                    <a href="../../landing.html">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>    
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
                    <form action="#" class="needs-validation my-4" novalidate>
                        <div class="my-4">
                            <input type="text" class="border form-controls p-3" id="register-username" placeholder="Enter Staff's Username" required>
                           
                        </div>
                        <div class="my-4">
                            <input type="email" class="form-controls p-3" id="register-email" placeholder="Enter Staff's  Email" required>
                        </div>
                        <div class="my-4">
                            <input type="password" class="form-controls p-3" id="register-password" placeholder="Password" required>
                        </div>
                        <div class="my-4">
                            <input type="password" class="border form-controls p-3" id="confirm-password" placeholder="Confirm Password" required>
                        </div>
                        <div class="">
                            <button class="bt bt-d fw-semibold bt-st" type="submit" id="register">Add Staff</button>
                        </div>
                        
                    </form>
                </div>
            </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>