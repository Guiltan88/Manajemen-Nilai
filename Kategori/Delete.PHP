<?php
include '../Utama/Koneksi.PHP';
$id = $_GET['id'];
$hapus = mysqli_query($con, "DELETE FROM kategori_lomba WHERE id_kategori = $id");

if ($hapus) {
    echo "<script>alert('Data berhasil dihapus'); location.href='../Utama/Data.PHP';</script>";
} else {
    echo "Gagal menghapus data!";
}
?>
