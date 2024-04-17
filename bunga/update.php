<?php
require("../includes/common.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $gambar_lama = $_POST['gambar_lama'];

    // Memeriksa apakah gambar baru diunggah
    if ($_FILES['gambar_baru']['name']) {
        // Menyiapkan path untuk menyimpan gambar baru
        $target_dir = "img/uploads/";
        $target_file = $target_dir . basename($_FILES["gambar_baru"]["name"]);
        $gambar_baru = $target_file;

        // Memindahkan gambar baru ke direktori uploads
        move_uploaded_file($_FILES["gambar_baru"]["tmp_name"], $target_file);

        // Menghapus gambar lama jika berhasil diunggah gambar baru
        if ($gambar_lama && file_exists($gambar_lama)) {
            unlink($gambar_lama);
        }
    } else {
        // Jika tidak ada gambar baru diunggah, menggunakan gambar lama
        $gambar_baru = $gambar_lama;
    }

    // Menyiapkan dan mengeksekusi query update
    $sql = "UPDATE items SET name='$nama', price='$harga', image='$gambar_baru' WHERE id='$id'";

    if ($con->query($sql) === TRUE) {
        echo "Data berhasil diperbarui";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header('Location: ../dashboard.php');
}
