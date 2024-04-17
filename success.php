<?php
require("includes/common.php");
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

$user_id = $_SESSION['user_id'];
$item_ids_string = $_GET['itemsid'];
$quantity_string = $_GET['quantity'];

// Mendekode string JSON menjadi array asosiatif
$item_quantities = json_decode($quantity_string, true);

// Memperbarui kuantitas untuk setiap item
foreach ($item_quantities as $item_id => $new_quantity) {
    // Perbarui kuantitas di database
    $query_update_quantity = "UPDATE user_item SET quantity = $new_quantity WHERE user_id = $user_id AND item_id = $item_id AND status = 1";
    mysqli_query($con, $query_update_quantity) or die(mysqli_error($con));
}

// Mengambil data item yang dibeli beserta harganya
$query_select_items = "SELECT items.name AS Name, items.price AS Price, user_item.quantity AS Quantity FROM user_item JOIN items ON user_item.item_id = items.id WHERE user_item.user_id = $user_id AND user_item.status = 1";
$result_items = mysqli_query($con, $query_select_items) or die(mysqli_error($con));

// Menghitung ulang subtotal dan total harga
$sum = 0;
while ($row = mysqli_fetch_assoc($result_items)) {
    $sum += $row['Price'] * $row['Quantity']; // Menghitung subtotal untuk setiap item dan menjumlahkannya
}
$query_select_items = "SELECT items.name AS Name, items.price AS Price, user_item.quantity AS Quantity FROM user_item JOIN items ON user_item.item_id = items.id WHERE user_item.user_id = $user_id AND user_item.status = 1";
$result_items = mysqli_query($con, $query_select_items) or die(mysqli_error($con));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice | Life Style Store</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="container-fluid" id="content">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h2 class="display-4">Invoice</h2>
                    <hr class="my-4">
                    <h4>Order Details:</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Price per Item</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result_items)) {
                                echo "<tr>";
                                echo "<td>{$row['Name']}</td>";
                                echo "<td>{$row['Quantity']}</td>";
                                echo "<td>Rp {$row['Price']}</td>";
                                $subtotal = $row['Price'] * $row['Quantity'];
                                echo "<td>Rp $subtotal</td>";
                                echo "</tr>";
                            }
                            ?>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                <td><strong>Rp <?php echo $sum; ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <hr class="my-4">
                    <p style="font-size: small;">Name : <?= $_SESSION['name']; ?></p>
                    <p style="font-size: small;">Email : <?= $_SESSION['email']; ?></p>
                    <p style="font-size: small;">Contact : <?= $_SESSION['contact']; ?></p>
                    <p style="font-size: small;">City : <?= $_SESSION['city']; ?></p>
                    <p style="font-size: small;">Address : <?= $_SESSION['address']; ?></p>
                    <p class="lead">Thank you for shopping with us.</p>
                    <p>Click <a href="products.php">here</a> to purchase any other item.</p>
                </div>
            </div>
        </div>
    </div>
    <?php
    // Memperbarui status item yang dibeli oleh pengguna menjadi 'Confirmed' (status = 2)
    $query_update_status = "UPDATE user_item SET status = 2 WHERE user_id = $user_id AND item_id IN ($item_ids_string) AND status = 1";
    mysqli_query($con, $query_update_status) or die(mysqli_error($con));
    ?>
    <?php include("includes/footer.php"); ?>
</body>

</html>