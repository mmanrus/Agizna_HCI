<header class="header">

    <a href="#" class="logo"><i class="fas fa-Agizna">Agizna</i></a>

    <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="#room">Room</a>
        <a href="#galllery">Gallery</a>
        <a href="#review">Review</a>
        <a href="#faq">Faq</a>
        <a href="#"><?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : "Guest"; ?></a>
        <a href="logout.php"  class="btn">Logout</a>
    </nav>

    <div class="menu-btn" class="fas fa-bars"></div>

</header>