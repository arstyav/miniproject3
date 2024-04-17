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
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = mysqli_real_escape_string($con, $password);
    $password = MD5($password);
    $contact = $_POST['contact'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $is_admin = $_POST['is_admin'];

    // Query SQL untuk menambahkan akun pengguna ke dalam tabel users
    $query = "INSERT INTO users (name, email, password, contact, city, address, is_admin) VALUES ('$nama', '$email','$password', '$contact', '$city', '$address', '$is_admin')";

    // Jalankan query ke database
    if (mysqli_query($con, $query)) {
        echo "Akun pengguna berhasil ditambahkan";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
    header('Location: ../dashboardSuper.php');

    // Tutup koneksi ke database
    mysqli_close($con);
}
