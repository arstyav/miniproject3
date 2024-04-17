<?php
require("includes/common.php");
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart | Life Style Store</title>
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
                    <?php
                    $sum = 0;
                    $id = '';
                    $user_id = $_SESSION['user_id'];
                    $itemIds = array(); // Array untuk menyimpan ID setiap item
                    $query = "SELECT items.price AS Price, items.id AS id, items.name AS Name, user_item.quantity AS Quantity FROM user_item JOIN items ON user_item.item_id = items.id WHERE user_item.user_id = $user_id AND user_item.status = 1";
                    $result = mysqli_query($con, $query) or die($mysqli_error($con));
                    if (mysqli_num_rows($result) >= 1) {
                    ?>
                        <thead>
                            <tr>
                                <th>Item Number</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                $itemIds[] = $row["id"];
                                $sum += $row["Price"] * $row["Quantity"];
                                $id .= $row["id"] . ", ";
                                echo "<tr>";
                                echo "<td>#{$row["id"]}</td>";
                                echo "<td>{$row["Name"]}</td>";
                                echo "<td><input type='number' name='quantity{$row["id"]}' value='{$row["Quantity"]}' min='1'></td>";
                                echo "<td data-item-id='{$row["id"]}'>Rp {$row["Price"]}</td>"; // Tambahkan ini di sini
                                echo "<td data-subtotal-id='{$row["id"]}'>Rp {$sum}</td>"; // Dan ini juga
                                echo "<td><a href='cart-remove.php?id={$row["id"]}' class='btn btn-danger'>Remove</a></td>";
                                echo "</tr>";
                            }
                            ?>
                            <tr>
                                <td></td>
                                <td>Total</td>
                                <td></td>
                                <td id="total-price">Rp <?php echo $sum; ?></td>
                                <td><a href='success.php?itemsid=<?php echo rtrim($id, ", "); ?>' id="confirm-order-link" class='btn btn-primary'>Confirm Order</a></td>
                            </tr>
                        </tbody>
                    <?php
                    } else {
                        echo "<tr><td colspan='5'>Heyy!! Your Cart is Empty. Please add items to the cart first!</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?php include("includes/footer.php"); ?>
</body>
<script>
    // Function to update subtotal and total price
    function updatePrice(itemId) {
        var quantityInput = document.querySelector('input[name="quantity' + itemId + '"]');
        var quantity = parseInt(quantityInput.value);
        var price = parseFloat(document.querySelector('td[data-item-id="' + itemId + '"]').innerText.slice(3)); // Get the item price from the table
        var subtotal = quantity * price;
        document.querySelector('td[data-subtotal-id="' + itemId + '"]').innerText = 'Rp ' + subtotal.toFixed(2); // Update subtotal in the table

        // Recalculate total price
        var total = 0;
        var subtotals = document.querySelectorAll('td[data-subtotal-id]');
        subtotals.forEach(function(subtotalElement) {
            total += parseFloat(subtotalElement.innerText.slice(3));
        });
        document.querySelector('#total-price').innerText = 'Rp ' + total.toFixed(2); // Update total price
    }

    // Add event listener to quantity inputs
    var quantityInputs = document.querySelectorAll('input[name^="quantity"]');
    quantityInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            var itemId = this.name.replace('quantity', ''); // Get the item ID from input name
            updatePrice(itemId);
        });
    });

    // Initial update of prices
    var itemIds = <?php echo json_encode($itemIds); ?>; // Mendapatkan ID setiap item dari PHP
    itemIds.forEach(function(itemId) {
        updatePrice(itemId);
    });
</script>
<script>
    document.getElementById('confirm-order-link').addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah link melakukan redirect secara langsung

        // Mendapatkan nilai kuantitas yang baru untuk setiap item
        var quantities = {};
        <?php foreach ($itemIds as $itemId) : ?>
            var quantity = document.querySelector('input[name="quantity<?php echo $itemId; ?>"]').value;
            quantities[<?php echo $itemId; ?>] = quantity;
        <?php endforeach; ?>

        // Menggabungkan nilai kuantitas yang baru dengan itemsid dalam href
        var itemsid = '<?php echo rtrim($id, ", "); ?>';
        var newHref = 'success.php?itemsid=' + itemsid + '&quantity=' + (JSON.stringify(quantities));

        // Memperbarui href link "Confirm Order"
        this.href = newHref;

        // Melakukan redirect manual setelah href diperbarui
        window.location.href = newHref;
    });
</script>

</html>