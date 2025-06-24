<?php
include '../Utama/Koneksi.PHP';
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM kategori_lomba WHERE id_kategori = $id");
$data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Kategori</title>
  <link rel="stylesheet" href="../Design/Kategori.CSS">
</head>
<body>
  <main class="form-card">
    <h1>Tambah Kategori</h1>
    <form method="post">
      <label for="nama_kategori">Nama Kategori</label>
      <input type="text" name="nama_kategori" id="nama_kategori" required>

      <div class="form-actions">
        <input type="submit" class="btn primary" value="Simpan">
        <a href="Data.PHP" class="btn secondary">Kembali</a>
      </div>
    </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $nama = $_POST['nama_kategori'];
      $update = mysqli_query($con, "UPDATE kategori_lomba SET nama_kategori = '$nama' WHERE id_kategori = $id");
      if ($update) {
          echo "<script>alert('Berhasil diubah'); location.href='../Utama/Data.PHP';</script>";
      } else {
          echo "Gagal update!";
      }
  }
  ?>
</body>
</html>
