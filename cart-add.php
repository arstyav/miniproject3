<?php
require("includes/common.php");

// Pastikan request yang diterima adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan data yang diterima adalah numerik
    if (isset($_POST['productId']) && is_numeric($_POST['productId']) && isset($_POST['quantity']) && is_numeric($_POST['quantity'])) {
        $item_id = $_POST['productId'];
        $quantity = $_POST['quantity'];
        $user_id = $_SESSION['user_id'];

        // Masukkan data ke dalam database
        $query = "INSERT INTO user_item (user_id, item_id, quantity, status, date_time) VALUES ($user_id, $item_id, $quantity, 'Added to cart', current_timestamp())";
        $result = mysqli_query($con, $query);

        // Redirect kembali ke halaman produk
        if ($result) {
            header("Location: products.php");
            exit(); // Berhenti setelah redirect
        } else {
            echo "Failed to add item to cart.";
        }
    } else {
        echo "Invalid data received.";
    }
} else {
    echo "Invalid request method.";
}
