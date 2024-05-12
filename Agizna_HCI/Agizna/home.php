<?php
include('dbconnection.php');

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$username = $_SESSION["username"];

include("header.php");

$query = "SELECT * FROM hotels";
$query_image = "SELECT * FROM hotel_images";
$result = mysqli_query($conn, $query);
$result_image = mysqli_query($conn, $query_image);
?>

<body>
    <!-- Your HTML content here -->

    <?php 
    // Display "Add hotels" link only for staff members
    include("nav.php");
    if ($_SESSION["role"] === "staff") {
        echo "<a href='add-hotel.php'>Add hotels</a>";
    }
    ?>

    <div class="menu-btn" class="fas fa-bars"></div>

    <div class="menu-btn" class="fas fa-bars"></div>
<!--availability-->
    <section class="availability" style="margin-top: 5%">

        <form action="">

            <div class="box">
                <p>check in<span>*</span></p>
                <input type="date" class="input" placeholder="Add date">
            </div>

            <div class="box">
                <p>check out<span>*</span></p>
                <input type="date" class="input" placeholder="Add date">
            </div>

            <div class="box">
                <p>Add Guest<span>*</span></p>
                <select name="adults" id="" class="input">
                    <option value="1">1 adults</option>
                    <option value="2">2 adults</option>
                    <option value="3">3 adults</option>
                    <option value="4">4 adults</option>
                    <option value="5">5 adults</option>
                    <option value="6">6 adults</option>
                </select>
            </div>

            <div class="box">
                <p>children<span>*</span></p>
                <select name="adults" id="" class="input">
                    <option value="1">1 child</option>
                    <option value="2">2 child</option>
                    <option value="3">3 child</option>
                    <option value="4">4 child</option>
                    <option value="5">5 child</option>
                    <option value="6">6 child</option>
                </select>
            </div>

            <div class="box">
                <p>rooms<span>*</span></p>
                <select name="rooms" id="" class="input">
                    <option value="1">1 rooms</option>
                    <option value="2">2 rooms</option>
                    <option value="3">3 rooms</option>
                    <option value="4">4 rooms</option>
                    <option value="5">5 rooms</option>
                    <option value="6">6 rooms</option>
                </select>
            </div>


            <input type="submit" value="check availability" class="btn">

        </form>
    </section>

    <!-- Stickers -->
    <div class="custom-container top-50">
        <div class="custom-row">
            <?php
            if (mysqli_num_rows($result) > 0 && mysqli_num_rows($result_image) > 0) {
                while (($row = mysqli_fetch_assoc($result)) && ($row_image = mysqli_fetch_assoc($result_image))) {
                    $hotelName = $row['hotel_name'];
                    $location = $row['location'];
                    $description = $row['description'];
                    $price_per_night = $row['price_per_night'];
                    $currency = $row['currency'];
                    $image_path = $row_image['image_path'];
            ?>
                    <div class="custom-col">
                        <a href="book.php">
                            <img src="<?php echo $image_path; ?>" alt="<?php echo $location; ?>">
                            <span class="spandex">Guest Favorite</span>
                            <div class="custom-txt">
                                <p><?php echo $location; ?></p>
                                <p><?php echo $description; ?></p>
                                <p><?php echo $currency . " " . number_format($price_per_night, 2); ?><span> night</span></p>
                            </div>
                        </a>
                    </div>
            <?php
                }
            } else {
                echo "No hotels found.";
            }
            mysqli_close($conn);
            ?>
            <!-- Remaining HTML content -->
        </div>
    </div>

    <!-- Your JavaScript imports and scripts here -->
</body>
</html>
