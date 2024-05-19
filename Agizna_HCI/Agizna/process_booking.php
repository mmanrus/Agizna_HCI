<?php

include("dbconnection.php");


function checkSum($cardNum)
{
    $result = 0;
    $i = 0;

    while ($cardNum != 0) {
        $digit = $cardNum % 10;
        if ($i % 2 != 0) {
            $calc_res = $digit * 2;
            if ($calc_res > 9) {
                $y = $calc_res % 10;
                $calc_res = intval($calc_res / 10) + $y;
            }
        } else {
            $calc_res = $digit;
        }
        $result += $calc_res;
        $cardNum = intval($cardNum / 10);
        $i++;
    }
    return $result;
}

function checkCardNum($total, $cardNum)
{
    $result = "INVALID";
    $length = strlen(strval($cardNum));

    if ($total % 10 != 0) 
    {
        return $result;
    }

    if (($length == 13 || $length == 15 || $length == 16) &&
        (($length == 13 || $length == 16) && (intval($cardNum / pow(10, $length - 1)) == 4))) 
    {
        $result = "VISA";
    } 
    elseif ($length == 15 && (intval($cardNum / pow(10, $length - 2)) == 34 ||
            intval($cardNum / pow(10, $length - 2)) == 37)) 
    {
        $result = "AMEX";
    } 
    elseif ($length == 16 && intval($cardNum / pow(10, $length - 2)) >= 51 &&
        intval($cardNum / pow(10, $length - 2)) <= 55) 
    {
        $result = "MASTERCARD";
    }

    return $result;
}

$location_err = '';
$fullname_err = '';
$cardnumber_error = '';
$process_result = '';
$country_err = '';
$user = isset($_SESSION['username']);
$user_id = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

    // Sanitize and retrieve POST data

    $loc = isset($_POST['location']) ? htmlspecialchars($_POST['location']) : '';
    $checkin = htmlspecialchars($_POST['checkin']);
    $checkout = htmlspecialchars($_POST['checkout']);
    $adults = htmlspecialchars($_POST['adults']);
    $children = htmlspecialchars($_POST['children']);
    $rooms = htmlspecialchars($_POST['rooms']);
    $fullname = htmlspecialchars($_POST['fullname']);
    $cardNumber = htmlspecialchars($_POST['cardNumber']);
    $country = htmlspecialchars($_POST['country']);
    $region = htmlspecialchars($_POST['region']);

    echo "<script>alert(" . json_encode($loc) . ");</script>";

    // Validate inputs
    if (empty($loc)) 
    {
        $location_err = 'Location is required.';
    }
    if (empty($fullname)) 
    {
        $fullname_err = 'Full name is required.';
    }
    if (empty($cardNumber)) 
    {
        $cardnumber_error = 'Card number is required.';
    }
    if (empty($country)) 
    {
        $country_err = 'Country is required.';
    }
    if (empty($region)) 
    {
        $region_err = 'Region is required.';
    }

    // Proceed if no errors
    if (empty($location_err) && empty($fullname_err) && empty($cardnumber_error) && empty($country_err) && empty($region_err)) 
    {
        echo "<script>alert('If successful!');</script>";

        if (!$conn) 
        {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Query the database (example query, adjust as needed;
        $query = "SELECT * FROM hotels"; // Assuming a hotel table with a location column
        // 
        $result = mysqli_query($conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) 
        {
            $row = mysqli_fetch_assoc($result);

            $price_per_night = $row['price_per_night'];
            $currency = $row['currency'];
            $tax = $row['taxes'];
            $discount = $row['discount'];

            $total = checkSum($cardNumber);
            $cardtype = checkCardNum($total, $cardNumber);

            if ($cardtype != "INVALID") 
            {
                echo "<script>alert('Reservation successful!');</script>";
                echo "Card Type: $cardtype<br>";

                $total_nights = (strtotime($checkout) - strtotime($checkin)) / (60 * 60 * 24);
                $total_amount = $price_per_night * $total_nights * $rooms;
                $total_amount += $total_amount * $tax / 100;
                $total_amount -= $total_amount * $discount / 100;
                $status = "committed";

                $process_result = "Total Amount: $currency $total_amount<br>";
                echo $process_result;

                $sql = "INSERT INTO reservation_summary (cardtype, user_id, location, price_paid, status, total_nights, currency, rooms) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                if($stmt)
                {
                    mysqli_stmt_bind_param($stmt, "sisdsisi", $cardtype, $user_id, $location, $total_amount, $status, $total_nights, $currency, $rooms);

                    // Execute the statement
                    if (mysqli_stmt_execute($stmt)) {
                        echo "<script>alert('Reservation successful!');</script>";
                    } else {
                        echo "<script>alert('Reservation failed: " . mysqli_stmt_error($stmt) . "');</script>";
                    }

                    mysqli_stmt_close($stmt);
                }
                else 
                {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                mysqli_close($conn);
                header("location: reservation_summary.php");

            } else {
                echo "<script>alert('Reservation failed: Invalid card number.');</script>";
                exit;
            }
        } 
        else 
        {
            echo "<script>alert('No hotel found for the specified location.');</script>";
        }

        // Close the database connection
    }
}
?>