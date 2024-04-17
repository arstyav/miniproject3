<?php
session_start();

// Periksa apakah pengguna telah login sebagai admin
if (!isset($_SESSION['is_admin'])) {
    header('Location: login.php');
    exit;
}

// Sertakan file koneksi ke database dan file common yang berisi konfigurasi umum
require("../includes/common.php");

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $is_admin = $_POST['is_admin'];

    // Query SQL untuk memperbarui informasi akun pengguna
    $query = "UPDATE users SET name='$nama', email='$email', contact='$contact', city='$city', address='$address', is_admin='$is_admin' WHERE id='$id'";

    // Jalankan query ke database
    if (mysqli_query($con, $query)) {
        echo "Informasi akun pengguna berhasil diperbarui";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
    header('Location: ../dashboardSuper.php');
}
?>
