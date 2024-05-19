<header class="header">

    <a href="#" class="logo"><i class="fas fa-Agizna">Agizna</i></a>

    <nav class="navbar">
        <a href="home.php">Home</a>
        <a href="#about">About</a>
        <a href="#room">Room</a>
        <a href="#galllery">Gallery</a>
        <a href="#review">Review</a>
        <a href="#faq">Faq</a>
    <?php

        if(isset($_SESSION["id"]))
        {
            $user_id = $_SESSION["id"];
            
            $reservation_query = "SELECT * FROM reservation_summary WHERE user_id = $user_id";
            $reservation_result = mysqli_query($conn, $reservation_query);
            if(mysqli_num_rows($reservation_result) > 0) 
            {
                echo "<a href='reservation_summary.php'>Reservation</a>";
            }
        }
        ?>
        <?php
            $current_page = basename($_SERVER['PHP_SELF']);
            if (isset($_SESSION["role"]) && $_SESSION["role"] === "staff") 
            {
                if ($_SESSION["role"] === "staff") {
                    if ($current_page === 'add-hotel.php') {
                        echo "<a href='home.php'>Back</a>";
                    } else {
                        echo "<a href='add-hotel.php'>Add hotels</a>";
                    }
                }
            }
        ?>

        <a href="#"><?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : "Guest"; ?></a>
        <a href="logout.php"  class="btn">Logout</a>
    </nav>

    <div class="menu-btn" class="fas fa-bars"></div>

</header>