<?php
include 'header.php';
include '../koneksi.php';

// Ambil parameter pencarian dari URL
$cari = (isset($_GET['cari'])) ? $_GET['cari'] : '';

// Query untuk mengambil data pelanggan dengan filter pencarian
$query = "SELECT * FROM pelanggan WHERE pelanggan_nama LIKE '%$cari%' ";

// Batasi jumlah data yang ditampilkan jika ada parameter halaman
if (isset($_GET['halaman'])) {
    $awal = ($_GET['halaman'] - 1) * 4;
    $query .= " LIMIT $awal, 4";
}

// Jalankan query untuk mengambil data
$data = mysqli_query($koneksi, $query);

// Ambil jumlah total data untuk pagination
$jumlah_data = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE pelanggan_nama LIKE '%$cari%'"));

// Hitung jumlah halaman
$jumlah_halaman = ceil($jumlah_data / 4);

?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Data Pelanggan</h4>
        </div>
        <div class="panel-body">

            <a href="pelanggan_tambah.php" class="btn btn-sm btn-info pull-right">Tambah</a>
            <br />

            <form action="" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="cari" placeholder="Cari nama pelanggan" value="<?php echo $cari; ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
            <br>

            <?php if ($jumlah_data > 0) : ?>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th width="1%">No</th>
                        <th>Nama</th>
                        <th>HP</th>
                        <th>Alamat</th>
                        <th width="15%">OPSI</th>
                    </tr>
                    <?php
                    $no = 1;
                    while ($d = mysqli_fetch_array($data)) : ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['pelanggan_nama']; ?></td>
                            <td><?php echo $d['pelanggan_hp']; ?></td>
                            <td><?php echo $d['pelanggan_alamat']; ?></td>
                            <td>
                                <a href="pelanggan_edit.php?id=<?php echo $d['pelanggan_id']; ?>" class="btn btn-sm btn-info">Edit</a>
                                <a href="pelanggan_hapus.php?id=<?php echo $d['pelanggan_id']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>

                <?php if ($jumlah_halaman > 1) : ?>
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="?halaman=1">First</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?php echo $halaman - 1; ?>">Previous</a>
                            </li>
                            <?php for ($i = 1; $i <= $jumlah_halaman; $i++) : ?>
                                <li class="page-item <?php if ($halaman == $i) {
                                                            echo 'active';
                                                        } ?>">
                                    <a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?php echo $halaman + 1; ?>">Next</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?php echo $jumlah_halaman; ?>">Last</a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>

            <?php else : ?>
                <p>Data pelanggan tidak ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>