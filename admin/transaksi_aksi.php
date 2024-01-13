<?php
include '../koneksi.php';
$pelanggan = $_POST['pelanggan'];
$berat = $_POST['berat'];
$tgl_selesai = $_POST['tgl_selesai'];
$tgl_hari_ini = date('Y-m-d');
$status = 0;
$h = mysqli_query($koneksi, "select harga_per_kilo from harga");
$harga_per_kilo = mysqli_fetch_assoc($h);
$harga = $berat * $harga_per_kilo['harga_per_kilo'];
mysqli_query($koneksi, "insert into transaksi values('','$tgl_hari_ini','$pelanggan','$harga','$berat','$tgl_selesai','$status')");
$id_terakhir = mysqli_insert_id($koneksi);
$jenis_pakaian = $_POST['jenis_pakaian'];
$jumlah_pakaian = $_POST['jumlah_pakaian'];
for ($x = 0; $x < count($jenis_pakaian); $x++) {
    if ($jenis_pakaian[$x] != "") {
        mysqli_query($koneksi, "insert into pakaian values('','$id_terakhir','$jenis_pakaian[$x]','$jumlah_pakaian[$x]')");
    }
}
header("location:transaksi.php");
