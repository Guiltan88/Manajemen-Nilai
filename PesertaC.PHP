<?php include '../Utama/Koneksi.PHP'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Peserta</title>
  <link rel="stylesheet" href="../Design/Peserta.CSS"> 
</head>
<body>
  <main class="form-card">
    <h1>Tambah Peserta</h1>
    <form method="post">
      <label for="nama">Nama:</label>
      <input type="text" id="nama" name="nama" required>

      <label for="kelas">Kelas:</label>
      <input type="text" id="kelas" name="kelas">

      <div class="form-actions">
        <input type="submit" class="btn primary" value="Simpan">
        <a href="../Utama/Data.PHP" class="btn secondary">Kembali</a>
      </div>
    </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $insert = mysqli_query($con, "INSERT INTO peserta (nama, kelas) VALUES ('$nama', '$kelas')");
    if ($insert) {
      echo "<script>alert('Peserta ditambahkan'); location.href='../Utama/Data.PHP';</script>";
    } else {
      echo "Gagal menambahkan peserta!";
    }
  }
  ?>
</body>
</html>
