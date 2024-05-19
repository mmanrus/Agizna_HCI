<?php
    include('dbconnection.php');
    include('header.php');
    include('nav.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reservation_id'])) {
        $reservation_id = intval($_POST['reservation_id']);
        $update_sql = "UPDATE reservation_summary SET status = 'canceled' WHERE id = $reservation_id";
        mysqli_query($conn, $update_sql);
    }

    $sql = "SELECT rs.id, rs.location, rs.price_paid, rs.status, rs.currency, rs.total_nights, rs.rooms, u.user 
            FROM reservation_summary rs
            INNER JOIN users u ON rs.user_id = u.id";
    $result = mysqli_query($conn, $sql);
?>
<body>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Location</th>
                    <th>User</th>
                    <th>Price Paid</th>
                    <th>Currency</th>
                    <th>Status</th>
                    <th>Total Nights</th>
                    <th>Rooms</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $location = $row['location'];
                        $price = $row['price_paid'];
                        $status = $row['status'];
                        $currency = $row['currency'];
                        $total_nights = $row['total_nights'];
                        $rooms = $row['rooms'];
                        $user = $row['user'];
                        $reservation_id = $row['id'];
                ?>
                        <tr>
                            <td><?php echo htmlspecialchars($location); ?></td>
                            <td><?php echo htmlspecialchars($user); ?></td>
                            <td><?php echo htmlspecialchars($price); ?></td>
                            <td><?php echo htmlspecialchars($currency); ?></td>
                            <td <?php echo $status == "canceled" ? "style='background-color: #ff0000; color: #ffffff;'" : "style='background-color: #00ff00;'"; ?>><?php echo htmlspecialchars($status); ?></td>
                            <td><?php echo htmlspecialchars($total_nights); ?></td>
                            <td><?php echo htmlspecialchars($rooms); ?></td>
                        </tr>
                <?php
                    }
                }
                else
                {
                    echo "<tr><td colspan='7'>No results found</td></tr>";
                    echo "</tbody>";
                }
                ?>
                </tbody>
        </table>
        <?php 
        if($status == "committed") 
        { 
        ?>
            <form method="post" action="">
                <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">
                <button type="submit" class="btn">Cancel</button>
            </form>
        <?php 
        } 
        ?>
    </div>
</body>