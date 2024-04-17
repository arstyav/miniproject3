<?php
require("includes/common.php");
if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order History | Life Style Store</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-fluid" id="content">
        <?php include 'includes/header.php'; ?>
        <div class="col-lg-4 col-md-6 "></div>
        <div class="row decor_bg">
            <div class="col-md-6">
                <table class="table table-striped">
                    <!--show table only if there are items added in the cart-->
                    <?php
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT items.price AS Price, items.id AS id, items.name AS Name, user_item.quantity AS Quantity, user_item.date_time AS Timedate 
                            FROM user_item 
                            JOIN items ON user_item.item_id = items.id 
                            WHERE user_item.user_id = '$user_id' AND user_item.status = 2";
                    $result = mysqli_query($con, $query) or die(mysqli_error($con));
                    if (mysqli_num_rows($result) >= 1) {
                    ?>
                        <h1 style="margin-bottom: 20px; font-weight: 20;">
                            <center>Order History</center>
                        </h1>
                        <thead>
                            <tr>
                                <th>Item name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Order & time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalPrice = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                $subtotal = $row["Price"] * $row["Quantity"]; // Hitung subtotal
                                $totalPrice += $subtotal; // Tambahkan subtotal ke total harga
                                echo "<tr>";
                                echo "<td>" . $row["Name"] . "</td>";
                                echo "<td>" . $row["Quantity"] . "</td>";
                                echo "<td>Rp. " . $row["Price"] . "</td>";
                                echo "<td>Rp. " . $subtotal . "</td>";
                                echo "<td>" . $row["Timedate"] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                            <tr>
                                <td colspan="3"></td>
                                <td>Total</td>
                                <td>Rs. <?php echo $totalPrice; ?></td>
                            </tr>
                        </tbody>
                    <?php
                    } else {
                        echo "<tr><td colspan='5'>Sorry! No orders placed yet</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?php include("includes/footer.php"); ?>
</body>

</html>