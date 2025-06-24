<?php include '../Utama/Koneksi.PHP'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Kategori</title>
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
        <a href="../Utama/Data.PHP" class="btn secondary">Kembali</a>
      </div>
    </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $nama = $_POST['nama_kategori'];
      $insert = mysqli_query($con, "INSERT INTO kategori_lomba (nama_kategori) VALUES ('$nama')");
      if ($insert) {
          echo "<script>alert('Berhasil disimpan'); location.href='../Utama/Data.PHP';</script>";
      } else {
          echo "Gagal menyimpan!";
      }
  }
  ?>
</body>
</html>
