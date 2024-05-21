<?php
include("dbconnection.php");

session_start();

if(!isset($_SESSION["role"]) && $_SESSION["role"] !== "staff"){
    echo "<script>alert('You are not allowed here')</script>";
    header("location: home.php");
    exit;
}

$username = $_SESSION["username"];

include("header.php");

$hotelName_err = '';
$location_err = '';
$description_err = '';
$price_per_night_err = '';
$rooms_err = '';
$taxes_err = '';
$discount_err = '';
$image_err = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    $hotelName = trim($_POST['hotel_name']);
    $location = trim($_POST['location']);
    $description = trim($_POST['description']);
    $rooms = intval($_POST['rooms']);
    $price_per_night = floatval($_POST['price_per_night']);
    $currency = $_POST['currency'];
    $taxes = floatval($_POST['taxes']);
    $discount = floatval($_POST['discount']);

    if (empty($hotelName)) {
        $hotelName_err = "Hotel name is required.";
    }
    if(empty($location))
    {
        $location_err = "Location is required.";
    }
    if(empty($description))
    {
        $description_err = "Description is required.";
    }
    if (!is_numeric($price_per_night) || $price_per_night < 0 || empty($price_per_night)) 
    {
        $price_per_night_err = "Price per night must be greater than zero.";
    }
    if (!is_numeric($taxes) || $taxes < 0 || empty($taxes)) 
    {
        $taxes_err = "Taxes must be a non-negative number.";
    }
    if (!is_numeric($discount) || $discount < 0 || empty($discount)) 
    {
        $discount_err = "Discount must be a non-negative number.";
    }
    if (!is_numeric($rooms) || $rooms < 0  || empty($rooms)) 
    {
        $rooms_err = "Number of rooms must be greater than zero.";
    }


    if(empty($hotelName_err) && empty($location_err) && empty($description_err) && empty($price_per_night_err) && empty($taxes_err) && empty($discount_err) && empty($rooms_err))    {
        if(!$conn) 
        {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "INSERT INTO hotels (hotel_name, location, description, rooms, price_per_night, currency, taxes, discount) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssidsdd", $hotelName, $location, $description, $rooms, $price_per_night, $currency, $taxes, $discount);

        if (mysqli_stmt_execute($stmt))
        {
            $hotelID = mysqli_insert_id($conn);

            // Handle uploaded images
            $targetdir = "uploads/";
            $allowedTypes = array("png", "jpeg", "jpg", "gif"); // allowed file types

            foreach ($_FILES['images']['name'] as $key => $image)
            {
                $targetFile = $targetdir . basename($_FILES['images']['name'][$key]);
                $filetype = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                if (in_array($filetype, $allowedTypes)) {
                    if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetFile)) {
                        // Insert image details into database
                        $imageQuery = "INSERT INTO hotel_images (hotel_id, image_path) VALUES (?, ?)";
                        $imageStmt = mysqli_prepare($conn, $imageQuery);
                        mysqli_stmt_bind_param($imageStmt, "is", $hotelID, $targetFile);
                        mysqli_stmt_execute($imageStmt);
                    } else {
                        $image_err = "Error uploading file.";
                    }
                } else {
                    $image_err = "Invalid file type.";
                }
                
            }
            echo "<script>alert('Hotel added successfully.');</script>";
            header("location: home.php");
        }
        else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
        // Close prepared statement
        mysqli_stmt_close($stmt);
    }
}

    // Display Consider how the price per night and other pricing details will be displayed on your website.
    // You may need to format currency symbols and decimal places, calculate totals, or display prices in different contexts.
    // For example, you can use PHP's number_format() function to format currency values:
    
    // $formatted_price = number_format($price_per_night, 2); // Format to two decimal places
    // echo "$formatted_price USD"; // Display with currency symbol
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add hotel</title>
    <link rel="stylesheet" href="css/add-hotel.css?v=<?php echo time(); ?>">
</head>
<body style="background-color: #000;">
<?php 
    include("nav.php");
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"  enctype="multipart/form-data">
    <div class="flex">
        <div class="input-group w_50">
            <input type="text" class="w_100" name="hotel_name">
            <label for="">Hotel Name</label>
            <p><?php echo isset($hotelName_err) ? $hotelName_err : ''; ?></p>
        </div>
        <div class="input-group w_50">
            <input type="text" class="w_100" name="location">
            <label for="">Location</label>
            <p><?php echo isset($location_err) ? $location_err : ''; ?></p>
        </div>
    </div>
    <div class="flex">
        <div class="input-group w_50">
            <input type="number" class="w_100" name="rooms"  min="1" max="200">
            <label for="">Rooms</label>
            <p><?php echo isset($rooms_err) ? $rooms_err : ''; ?></p>
        </div>
        <div class="input-group w_50">
            <input type="number" class="w_100" name="price_per_night"  min="0">
            <label for="">Price per Night</label>
            <p><?php echo isset($price_per_night_err) ? $price_per_night_err : ''; ?></p>
        </div>
    </div>
    <select name="currency" class="select">
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
                <option value="PHP">PHP</option>
                <!-- Add more currency options as needed -->
    </select>
    <div class="flex ">
        <div class="input-group w_50">
            <input type="number" class="w_100" name="taxes" min="0">
            <label for="">Taxes</label>
            <p><?php echo isset($taxes_err) ? $taxes_err : ''; ?></p>
        </div>
        <div class="input-group w_50">
            <input type="number" class="w_100" name="discount" min="0">
            <label for="">Discount</label>
            <p><?php echo isset($discount_err) ? $discount_err : ''; ?></p>
        </div>
    </div>
    <div class="input-group">
        <input type="file" class="w_50" name="images[]" multiple>
        <label for="">Images</label>
        <p><?php echo isset($image_err) ? $image_err : ''; ?></p>
    </div>
    <div class="input-group">
        <textarea name="description" class="w_100"></textarea><br><br>
        <label for="" class="label">Description</label>
        <p><?php echo isset($description_err) ? $description_err : ''; ?></p>
    </div>
    <button type="submit" class="mx-auto">Add Hotel</button>
</form>

</body>
</html>