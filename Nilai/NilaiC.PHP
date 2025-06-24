<?PHP
include '../Utama/Koneksi.PHP';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_peserta = $_POST['id_peserta'];
    $id_lomba = $_POST['id_lomba'];
    $nilai1 = $_POST['nilai1'];
    $nilai2 = $_POST['nilai2'];
    $nilai3 = $_POST['nilai3'];

    // Validasi apakah id_lomba ada di database
    $check_lomba = mysqli_query($con, "SELECT id_lomba FROM lomba WHERE id_lomba = '$id_lomba'");
    if(mysqli_num_rows($check_lomba) == 0) {
        die("<script>alert('Error: Lomba tidak valid!'); window.history.back();</script>");
    }

    // Query INSERT yang benar dengan menyertakan id_lomba
    $query = "INSERT INTO nilai_lomba (id_peserta, id_lomba, nilai1, nilai2, nilai3) 
              VALUES ('$id_peserta', '$id_lomba', '$nilai1', '$nilai2', '$nilai3')";
    
    if(mysqli_query($con, $query)) {
        header('Location: ../Utama/Data.PHP');
        exit;
    } else {
        die("<script>alert('Gagal menyimpan data: " . mysqli_error($con) . "'); window.history.back();</script>");
    }
}

// Query peserta dan lomba
$peserta = mysqli_query($con, "SELECT * FROM peserta");
$lomba = mysqli_query($con, "SELECT * FROM lomba");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Nilai Lomba</title>
    <link rel="stylesheet" href="../Design/Nilai.CSS">
    <style>
        .error { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <main class="form-card">
        <h1>Tambah Nilai Lomba</h1>
        <form method="POST">
            <!-- Peserta -->
            <label for="id_peserta">Peserta</label>
            <select name="id_peserta" id="id_peserta" required>
                <?php 
                if(mysqli_num_rows($peserta) > 0) {
                    while($p = mysqli_fetch_assoc($peserta)): 
                ?>
                    <option value="<?= $p['id_peserta'] ?>"><?= $p['nama'] ?></option>
                <?php 
                    endwhile; 
                } else {
                    echo '<option value="">Tidak ada peserta</option>';
                }
                ?>
            </select>

            <!-- Lomba -->
            <label>Jenis Lomba:</label>
            <select name="id_lomba" id="id_lomba" required>
                <?php 
                if(mysqli_num_rows($lomba) > 0) {
                    while($l = mysqli_fetch_assoc($lomba)): 
                ?>
                    <option value="<?= $l['id_lomba'] ?>">
                        <?= $l['nama_lomba'] ?>
                    </option>
                <?php 
                    endwhile; 
                } else {
                    echo '<option value="">Tidak ada lomba tersedia</option>';
                }
                ?>
            </select>

            <!-- Nilai -->
            <label for="nilai1">Nilai 1</label>
            <input type="number" name="nilai1" id="nilai1" min="0" max="100" step="0.01" required>

            <label for="nilai2">Nilai 2</label>
            <input type="number" name="nilai2" id="nilai2" min="0" max="100" step="0.01" required>

            <label for="nilai3">Nilai 3</label>
            <input type="number" name="nilai3" id="nilai3" min="0" max="100" step="0.01" required>

            <div class="form-actions">
                <button type="submit" class="btn primary">Simpan</button>
                <a href="../Utama/Data.PHP" class="btn secondary">Kembali</a>
            </div>
        </form>
    </main>
</body>
</html>