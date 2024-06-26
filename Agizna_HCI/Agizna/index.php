<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agizna Hotel Booking App</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <link rel="stylesheet" href="css/homestyle.css?v=<?php echo time(); ?>">
</head>
<body>


    <!--Header-->

    <header class="header">

        <a href="#" class="logo"><i class="fas fa-Agizna">Agizna</i></a>

        <nav class="navbar">
            <a href="#home">Stays</a>
            <a href="#about">Experience</a>
            <a href="login.php" class="btn">Book now</a>
        </nav>

        <div class="menu-btn" class="fas fa-bars"></div>

    </header>

<!--end-->

<!--home-->

<section class="home" id="home">

    <div class="swiper home-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide" style="background: url(images/slide1.jpg) no-repeat;">
                <div class="content">
                    <h3>Hospitality is when someone feels at home</h3>
                    <a href="login.php" class="btn">Visit our offer</a>
                </div>
            </div>

            <div class="swiper-slide slide" style="background: url(images/slide2.jpg) no-repeat;">
                <div class="content">
                    <h3>Hospitality is when someone feels at home</h3>
                    <a href="login.php" class="btn">Visit our offer</a>
                </div>
            </div>

            <div class="swiper-slide slide" style="background: url(images/slide3.jpg) no-repeat;">
                <div class="content">
                    <h3>Hospitality is when someone feels at home</h3>
                    <a href="login.php" class="btn">Visit our offer</a>
                </div>
            </div>

            <div class="swiper-slide slide" style="background: url(images/slide6.jpg) no-repeat;">
                <div class="content">
                    <h3>Hospitality is when someone feels at home</h3>
                    <a href="login.php" class="btn">Visit our offer</a>
                </div>
            </div>

        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        
    </div>
</section>

<!--availability-->
<section class="availability">

    <form action="">

        <div class="box">
            <p>check in<span>*</span></p>
            <input type="date" class="input">
        </div>

        <div class="box">
            <p>check out<span>*</span></p>
            <input type="date" class="input">
        </div>

        <div class="box">
            <p>adults<span>*</span></p>
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

<!--</section>-->



<section class="about" id="about">

    <div class="row">

    <div class="image">
        <img src="images/about.jpg" alt="">
        </div>

        <div class="content">
            <h3>about us</h3>
            <p>"Welcome to Agizna Hotel Booking app, where luxury meets comfort and every stay is a memorable experience. Our App offers unparalleled hospitality and impeccable service to discerning travelers from around the globe.''</p>
            <p>We believe in creating unforgettable moments. Whether it's a romantic getaway, a family vacation, or a corporate retreat, let us be your home away from home. Experience the essence of hospitality at its finest with us."</p>
        </div>
    </div>

</section>

<!--Room-->

<section class="room" id="room">

    <h1 class="heading">our room</h1>

    <div class="swiper room-slider">
        
        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <div class="image">
                    <span class="price">P1,099/night</span>
                    <img src="images/room6.jpg" alt="">
                    <a href="#" class="fas fa-shopping-cart"></a>
                </div>
                <div class="content">
                    <h3>exclusive room</h3>
                    <p>"Welcome to this Exclusive Room! This space is reserved for our esteemed guests"</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <a href="#" class="btn">book now</a>
                </div>
            </div>
             
            <div class="swiper-slide slide">
                <div class="image">
                    <span class="price">P3,500/night</span>
                    <img src="images/luxury.jpg" alt="">
                    <a href="#" class="fas fa-shopping-cart"></a>
                </div>
                    <div class="content">
                        <h3>vip room</h3>
                        <p>"Welcome to this Exclusive Room! This space is reserved for our esteemed guests"</p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <a href="#" class="btn">book now</a>
                    </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <span class="price">P3,289/night</span>
                    <img src="images/room1.jpg" alt="">
                    <a href="#" class="fas fa-shopping-cart"></a>
                </div>
                <div class="content">
                    <h3>exclusive room</h3>
                    <p>"Welcome to this Exclusive Room! This Room is reserved for our Adventurers"</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <a href="#" class="btn">book now</a>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <span class="price">P1,500/night</span>
                    <img src="images/room3.jpg" alt="">
                    <a href="#" class="fas fa-shopping-cart"></a>
                </div>
                <div class="content">
                    <h3>exclusive room</h3>
                    <p>"Welcome to this Exclusive Place! This space is reserved for our esteemed guests"</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <a href="#" class="btn">book now</a>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <span class="price">P5,000/week</span>
                    <img src="images/room7.jpg" alt="">
                    <a href="#" class="fas fa-shopping-cart"></a>
                </div>
                <div class="content">
                    <h3>exclusive room</h3>
                    <p>"Welcome to this Exclusive Room! This space is reserved for our esteemed guests"</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <a href="#" class="btn">book now</a>
                </div>
            </div>

    </div>
        <div class="swiper-pagination"></div>
    </div>









    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="js/homejs.js"></script>

</body>
</html>





