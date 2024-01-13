<?php
include '../koneksi.php';
$password_baru = md5($_POST['password_baru']);
mysqli_query($koneksi, "update admin set password='$password_baru'");
header("location:ganti_password.php?pesan=oke");
