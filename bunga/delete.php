<?php
require("../includes/common.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Membuat query DELETE
    $sql = "DELETE FROM items WHERE id = $id";

    if ($con->query($sql) === TRUE) {
        echo '<script>alert("Berhasil menghapus.");</script>';
    } else {
        echo '<script>alert("Gagal menghapus.");</script>';
    }
    header('Location: ../dashboard.php');
} else {
    echo "ID tidak valid";
}
