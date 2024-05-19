<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agizna Hotel Booking App</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
        
    <?php 
        $current_page = basename($_SERVER['PHP_SELF']);
        if($current_page == "reservation_summary.php")
        {
        ?>
        <link rel="stylesheet" href="css/summary.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="css/homestyle.css?v=<?php echo time(); ?>">
    <?php 
        }else
        {
        ?>
        <link rel="stylesheet" href="css/homestyle.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="css/homepage.css?v=<?php echo time(); ?>">
    <?php 
        }
        ?>

</head>