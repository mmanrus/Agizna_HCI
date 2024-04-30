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

</head>
<body>


<!--Header-->

<header class="header">

    <a href="#" class="logo"><i class="fas fa-Agizna">Agizna</i></a>

    <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="#room">Room</a>
        <a href="#galllery">Gallery</a>
        <a href="#review">Review</a>
        <a href="#faq">Faq</a>
        <a href="login.php" class="btn">Username</a>
    </nav>

    <div class="menu-btn" class="fas fa-bars"></div>

</header>

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
<div class="custom-container">
    <div class="custom-row">

        <div class="custom-col">
            <a>
                <img src="images/stickers/Coron.jpg" alt="Coron, Palawan, Philippines">
                <span  class="spandex">Guest Favorite</span>
                <div class="custom-txt">
                    <p>Coron, Palawan, Philippines</p>
                    <p>Some Text</p>
                    <p>₱ 2,009<span> night</span></p>
                </div>
            </a>
        </div>
     
        <div class="custom-col">
            <a href="#">
                <img src="images/stickers/El-Nido_-Philippines.jpg" alt="El Nido, Philippines">
                <span class="spandex">Guest Favorite</span>
                <div class="custom-txt">
                    <p>El Nido, Philippines</p>
                    <p>Some Text</p>
                    <p>₱ 3,903<span> night</span></p>
                </div>
            </a>
        </div>

        <div class="custom-col">
            <a href="#">
                <img src="images/stickers/Rizal.jpg" alt="Rizal, Philippines">
                <span class="spandex">Guest Favorite</span>
                <div class="custom-txt">
                    <p>Rizal, Philippines</p>
                    <p>Some Text</p>
                    <p>₱ 8,349<span> night</span></p>
                </div>
            </a>
        </div>


        <div class="custom-col">
            <a href="#">
                <img src="images/stickers/Samboan.jpg" alt="Samboan, Philippines">
                <span  class="spandex">Guest Favorite</span>
                <div class="custom-txt">
                    <p>Samboan, Philippines</p>
                    <p>Some Text</p>
                    <p>₱ 3,559<span> night</span></p>
                </div>
            </a>
        </div>

        <div class="custom-col">
            <a href="#">
            <img src="images/stickers/General.jpg" alt="General Luna, Philippines">
            <span class="spandex">Guest Favorite</span>
            <div class="custom-txt">
                <p>General Luna, Philippines</p>
                <p>Some Text</p>
                <p>₱ 2,559<span> night</span></p>
            </div>
            </a>
        </div>
        
        <div class="custom-col">
            <a href="#">
            <img src="images/stickers/San-isidro.jpg" alt="San Isidro, Philippines">
            
            <span class="spandex">Guest Favorite</span>
            <div class="custom-txt">
                <p>San Isidro, Philippines</p>
                <p>Some Text</p>
                <p>₱ 7,509<span> night</span></p>
            </div>
            </a>
        </div>
        
    </div>
</div>
<!--- FOOTER  Needed-->

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="js/homejs.js"></script>

</body>
</html>