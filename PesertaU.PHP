<?php
include '../Utama/Koneksi.PHP';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM peserta WHERE id_peserta = $id"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Peserta</title>
    <link rel="stylesheet" href="../Design/Peserta.CSS">
</head>
<body>
    <main class="form-card">
        <h1>Edit Peserta</h1>
        <form method="post">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>

            <label for="kelas">Kelas:</label>
            <input type="text" id="kelas" name="kelas" value="<?= htmlspecialchars($data['kelas']) ?>">

            <div class="form-actions">
                <input type="submit" class="btn primary" value="Simpan">
                <a href="../Utama/Data.PHP" class="btn secondary">Kembali</a>
            </div>
        </form>
    </main>

  <?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $update = mysqli_query($con, "UPDATE peserta SET nama='$nama', kelas='$kelas' WHERE id_peserta=$id");
    if ($update) {
      echo "<script>alert('Peserta diupdate'); location.href='../Utama/Data.PHP';</script>";
    } else {
      echo "Gagal mengupdate peserta!";
    }
  }
  ?>
</body>
</html>
