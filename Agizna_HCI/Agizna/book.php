<?php
    session_start();
    
    // check if logged in 
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php"); // if false back to login page
        exit;
    }
    
    // Retrieve username from login
    $username = $_SESSION["username"];
    include("nav.php");

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
            <form action="#" method="post" class="d-flex flex-wrap flex-column">
                <div>
                    <div class="input-group">
                        <input type="text" class="w_100" required>
                        <label for="">Location</label>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="input-group mb-3 w-50">
                            <input type="date" class="w_100" required>
                            <label for="" id="date">Check in</label>
                        </div>
                        <div class="input-group mb-3 w-50">
                            <input type="date" class="w_100" required>
                            <label for="" id="date">Check Out</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="input-group mb-3 w-50">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                <option selected value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                            </select>
                            <label for="" >Adults</label>
                        </div>
                        <div class="input-group mb-3 w-50">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                <option selected value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                            </select>
                            <label for="floatingInput">Children</label>
                        </div>
                    </div>
                    <div class="input-group mb-3 w-50 mx-auto">
                        <input type="number" class="w_100 .transparent mx-auto" id="floatingInput" min="1" max="100">
                        <label for="floatingInput">Rooms</label>
                    </div>
                </div>

                <div class="align-items-center mx-auto">
                    <p class="align">Add Payment Method</p>
                </div>
                <div>
                    <div class="input-group mb-3 w_100">
                        <input type="text" class="w_100">
                        <label for="" id="label">Full name</label>
                    </div>
                    <div class="input-group mb-3 w_100">
                        <input type="text" class="w_100" id="">
                        <label for="" id="label">Card Number</label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="input-group mb-3 w-50">
                            <input type="text" class="w_100" id="floatingInput">
                            <label for="floatingInput">Country</label>
                        </div>
                        <div class="input-group mb-3 w-50">
                            <input type="text" class="w_100" id="floatingInput">
                            <label for="floatingInput">Region</label>
                        </div>
                    </div>
                    <div class="">
                        <button class="agizna-btn fs-3">Book Now</button>
                    </div>
                </div>
            </form>
            
        </div>
        <div class="">
               

        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="js/homejs.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>