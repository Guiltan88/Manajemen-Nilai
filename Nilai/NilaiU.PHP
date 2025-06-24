<?PHP
include '../Utama/Koneksi.PHP';

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan.";
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_peserta = $_POST['id_peserta'];
    $id_lomba = $_POST['id_lomba'];
    $nilai1 = $_POST['nilai1'];
    $nilai2 = $_POST['nilai2'];
    $nilai3 = $_POST['nilai3'];

    mysqli_query($con, "UPDATE nilai_lomba SET 
          nilai1 = '$nilai1',
          nilai2 = '$nilai2',
          nilai3 = '$nilai3'
          WHERE id_nilai = '$id_nilai'");
    header('Location: ../Utama/Data.PHP');
    exit;
}

$data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM nilai_lomba WHERE id_nilai = '$id'"));
$peserta = mysqli_query($con, "SELECT * FROM peserta");
$lomba = mysqli_query($con, "SELECT * FROM lomba");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Nilai Lomba</title>
    <link rel="stylesheet" href="../Design/Nilai.CSS">
</head>
<body>
    <main class="form-card">
        <h1>Tambah Nilai Lomba</h1>
        <form method="POST">
            <label for="id_peserta">Peserta</label>
            <select name="id_peserta" id="id_peserta" required>
                <?php while($p = mysqli_fetch_assoc($peserta)): ?>
                <option value="<?= $p['id_peserta'] ?>"><?= $p['nama'] ?></option>
                <?php endwhile; ?>
            </select>

            <label for="id_lomba">Lomba</label>
            <select name="id_lomba" id="id_lomba" required>
                <?php while($l = mysqli_fetch_assoc($lomba)): ?>
                <option value="<?= $l['id_lomba'] ?>"><?= $l['nama_lomba'] ?></option>
                <?php endwhile; ?>
            </select>

            <label for="nilai1">Nilai 1</label>
            <input type="number" name="nilai1" id="nilai1" step="0.01" required>

            <label for="nilai2">Nilai 2</label>
            <input type="number" name="nilai2" id="nilai2" step="0.01" required>

            <label for="nilai3">Nilai 3</label>
            <input type="number" name="nilai3" id="nilai3" step="0.01" required>

            <div class="form-actions">
                <button type="submit" class="btn primary">Simpan</button>
                <a href="../Utama/Data.PHP" class="btn secondary">Kembali</a>
            </div>
        </form>
    </main>
</body>
</html>