<?php
require("../includes/common.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    // Lokasi penyimpanan file gambar
    $target_dir = "C:/xampp/htdocs/minpro3tyty/img/uploads/";
    // Nama file gambar yang diunggah
    $gambar = basename($_FILES["gambar"]["name"]);
    // Path lengkap file gambar
    $target_file = $target_dir . $gambar;
    // Mendapatkan ekstensi file gambar
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file gambar sudah ada
    if (file_exists($target_file)) {
        echo '<script>alert("Maaf, file gambar sudah ada.");</script>';
    }
    // Cek ukuran file gambar (misalnya maksimal 5 MB)
    else if ($_FILES["gambar"]["size"] > 5000000) {
        echo '<script>alert("Maaf, ukuran file gambar terlalu besar.");</script>';
    }
    // Hanya memperbolehkan beberapa format gambar tertentu (contoh: jpg, jpeg, png)
    else if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
        echo '<script>alert("Maaf, hanya file gambar JPG, JPEG, dan PNG yang diperbolehkan.");</script>';
    } else {
        // Memindahkan file gambar ke lokasi yang ditentukan
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            // SQL untuk memasukkan data ke dalam database
            $sql = "INSERT INTO items VALUES ('',?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sss", $nama, $harga, $gambar);
            if ($stmt->execute()) {
                echo '<script>alert("Berhasil menambahkan.");</script>';
            } else {
                echo '<script>alert("Gagal menambahkan.");</script>';
            }
        } else {
            echo '<script>alert("Maaf, terjadi kesalahan saat mengunggah file gambar.");</script>';
        }
    }
}
header('Location: ../dashboard.php');
