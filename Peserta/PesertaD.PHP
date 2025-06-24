<?php
include '../Utama/Koneksi.PHP';
$id = $_GET['id'];
$hapus = mysqli_query($con, "DELETE FROM peserta WHERE id_peserta = $id");

if ($hapus) {
  echo "<script>alert('Peserta dihapus'); location.href='../Utama/Data.PHP';</script>";
} else {
  echo "Gagal menghapus peserta!";
}
?>
