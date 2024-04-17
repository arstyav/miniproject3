<?php
session_start();
if (!isset($_SESSION['is_admin'])) {
    header('Location: login.php');
}
require("includes/common.php");
include "includes/admin/header.php";
include "includes/admin/sidebar.php";

$sql = "SELECT * FROM items";
$result = mysqli_query($con, $sql);
?>



<div class="d-flex flex-column w-100 mx-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Bunga</h1>
    </div>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahBarang">Tambah Bunga</button>


    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <?php $i = 1 ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tbody>
                <tr>
                    <th><?= $i ?></th>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['price']; ?></td>
                    <td><img style="width:100px" src="img/uploads/<?= $row['image']; ?>" alt="not found"></td>
                    <td class="text-center">
                        <button data-bs-toggle="modal" data-bs-target="#ubahBunga<?= $row['id']; ?>" class="badge bg-warning border-0"><i class="bi bi-pencil-square"></i></button>
                        <a href="bunga/delete.php?id=<?= $row['id']; ?>" class="badge bg-danger border-0 tombol-hapus" data-pesan="Hapus Barang"><i class="bi bi-x-circle"></i></a>
                    </td>
                </tr>
            </tbody>
        <?php $i++;
        endwhile; ?>
    </table>
</div>


<div class="modal fade" id="tambahBarang" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="judulModal">Tambah Bunga</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="bunga/create.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Bunga</label>
                        <input type="text" class="form-control " id="nama" name="nama" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga Bunga</label>
                        <input type="number" class="form-control " id="harga" name="harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input class="form-control" name="gambar" type="file" id="gambar" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_assoc($result)) :
?>
    <div class="modal fade" id="ubahBunga<?= $row['id']; ?>" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="judulModal">Ubah Bunga</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="bunga/update.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Bunga</label>
                            <input type="text" class="form-control " id="nama" name="nama" required value="<?= $row['name']; ?>" autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Bunga</label>
                            <input type="number" class="form-control " id="harga" name="harga" required value="<?= $row['price']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="gambar_lama" class="form-label">Gambar Lama</label>
                            <img src="img/uploads/<?= $row['image']; ?>" class="img-thumbnail" width="100" height="100">
                            <input type="hidden" name="gambar_lama" value="<?= $row['image']; ?>"> <!-- Menyimpan path gambar lama -->
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Baru</label>
                            <input class="form-control" name="gambar_baru" type="file" id="gambar_baru">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>


<?php include "includes/admin/footer.php" ?>