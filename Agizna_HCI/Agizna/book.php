<?php
    include("dbconnection.php");
    session_start();
    
    // check if logged in 
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
    {
        header("location: login.php"); // if false back to login page
        exit;
    }
    
    // Retrieve username from login
    $username = $_SESSION["username"];
    include("nav.php");

    $query = "SELECT * FROM hotels";
    $query_image = "SELECT * FROM hotel_images";
    $result = mysqli_query($conn, $query);
    $result_img = mysqli_query($conn, $query_image);

    $row = mysqli_fetch_assoc($result);
    $hotelName = $row['hotel_name'];
    $location = $row['location'];
    $description = $row['description'];
    $price_per_night = $row['price_per_night'];
    $currency = $row['currency'];
    $rooms = $row['rooms'];
    $tax = $row['taxes']; // 10% tax
    $discount = $row['discount']; // 5% discount


    include("process_booking.php");
// <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agizna Hotel Booking App</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/homestyle.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/homepage.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/book.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="position-relative">
        <div class="form-container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="d-flex flex-wrap flex-column">
                <div>
                    <div class="input-group">
                        <input type="text" class="w_100" required value="<?php echo $location; ?>" name="location" readonly>
                        <label for="">Location</label>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="input-group mb-3 w_50">
                            <input type="date" class="w_100" required name="checkin" id="checkin">
                            <label for="checkin" id="date">Check in</label>
                        </div>
                        <div class="input-group mb-3 w_50">
                            <input type="date" class="w_100" required name="checkout" id="checkout">
                            <label for="checkout" id="date">Check Out</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="input-group mb-3 w_50">
                            <select class="form-select" id="floatingSelectAdults" aria-label="Floating label select example" name="adults">
                                <option selected value="1">1</option>
                                <!-- Additional options for adults -->
                                <?php for ($i = 2; $i <= 20; $i++) echo "<option value=\"$i\">$i</option>"; ?>
                            </select>
                            <label for="floatingSelectAdults">Adults</label>
                        </div>
                        <div class="input-group mb-3 w_50">
                            <select class="form-select" id="floatingSelectChildren" aria-label="Floating label select example" name="children">
                                <option selected value="0">0</option>
                                <!-- Additional options for children -->
                                <?php for ($i = 1; $i <= 20; $i++) echo "<option value=\"$i\">$i</option>"; ?>
                            </select>
                            <label for="floatingSelectChildren">Children</label>
                        </div>
                    </div>
                    <div class="input-group mb-3 w-50 mx-auto">
                        <input type="number" class="w_100 transparent mx-auto" id="rooms" min="1" max="<?php echo $rooms;?>" name="rooms" value="1">
                        <label for="rooms">Rooms</label>
                    </div>
                </div>
                <div class="align-items-center mx-auto">
                    <p class="align">Add Payment Method</p>
                </div>
                <div>
                    <div class="input-group mb-3 w_100">
                        <input type="text" class="w_100" name="fullname"required>
                        <label for="" id="label">Full name</label>
                    </div>
                    <div class="input-group mb-3 w_100">
                        <input type="text" class="w_100" id="cardNumber" name="cardNumber" required>
                        <label for="" id="label">Card Number</label>
                        <span><?php echo 'hello';?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="input-group mb-3 w_50">
                            <input type="text" class="w_100" id="floatingInputCountry" name="country" required>
                            <label for="floatingInputCountry">Country</label>
                        </div>
                        <div class="input-group mb-3 w_50">
                            <input type="text" class="w_100" id="floatingInputRegion" name="region" required>
                            <label for="floatingInputRegion">Region</label>
                        </div>
                    </div>
                    <div class="">
                        <button class="agizna-btn fs-3" type="submit" <?php if(isset($_SESSION["role"]) && $_SESSION["role"] === "staff"){ echo "disabled style='background-color: #000!important';";}?>><?php if(isset($_SESSION['role']) && $_SESSION['role'] === "staff"){ echo "staff not allowed";} else {echo "Book Now";} ?></button>
                    </div>
                </div>
                <div class="" style="position: relative;">
                    <p style="font-size: 20px;"><?php echo $currency . " " . $price_per_night; ?></p>
                    <p><?php echo $user ?></p>
                    <p><?php echo $user_id ?></p>
                    <p id="price_to_pay"></p>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pricePerNight = <?php echo $price_per_night; ?>;
            const currency = '<?php echo $currency; ?>';
            const taxes = <?php echo $tax; ?>;
            const discount = <?php echo $discount; ?>;
            const roomInput = document.getElementById('rooms');
            const checkinInput = document.getElementById('checkin');
            const checkoutInput = document.getElementById('checkout');
            const priceToPayElement = document.getElementById('price_to_pay');

            const today = new Date().toISOString().split('T')[0];
            checkinInput.setAttribute('min', today);

            function calculateTotalPrice() {
                const rooms = parseInt(roomInput.value);
                const checkinDate = new Date(checkinInput.value);
                const checkoutDate = new Date(checkoutInput.value);
                const totalNights = (checkoutDate - checkinDate) / (1000 * 60 * 60 * 24);

                if (!isNaN(totalNights) && totalNights > 0) {
                    let totalPrice = rooms * totalNights * pricePerNight;
                    totalPrice += totalPrice * taxes / 100;
                    totalPrice -= totalPrice * discount / 100;
                    priceToPayElement.textContent = `${currency} ${totalPrice.toFixed(2)}`;
                } else {
                    priceToPayElement.textContent = '';
                }
            }

            roomInput.addEventListener('input', calculateTotalPrice);
            checkinInput.addEventListener('change', function () {
                const checkinDate = new Date(checkinInput.value);
                checkinDate.setDate(checkinDate.getDate() + 20);
                const maxCheckoutDate = checkinDate.toISOString().split('T')[0];
                checkoutInput.setAttribute('max', maxCheckoutDate);
                checkoutInput.setAttribute('min', checkinInput.value);
                calculateTotalPrice();
            });

            checkoutInput.addEventListener('change', function () {
                const checkinDate = new Date(checkinInput.value);
                const checkoutDate = new Date(checkoutInput.value);

                if (checkoutDate < checkinDate) {
                    alert("Check-out date cannot be before check-in date.");
                    checkoutInput.value = checkinInput.value;
                }

                const maxCheckoutDate = new Date(checkinDate);
                maxCheckoutDate.setDate(maxCheckoutDate.getDate() + 20);
                if (checkoutDate > maxCheckoutDate) {
                    alert("Check-out date cannot be more than 20 days after check-in date.");
                    checkoutInput.value = maxCheckoutDate.toISOString().split('T')[0];
                }
                calculateTotalPrice();
            });
        });
    </script>

</body>
</html>