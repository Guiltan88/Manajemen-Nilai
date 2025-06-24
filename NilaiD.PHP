<?PHP
include '../Utama/Koneksi.PHP';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($con, "DELETE FROM nilai_lomba WHERE id_nilai = '$id'");
    header('Location: ../Utama/Data.PHP');
    exit;
} else {
    echo "ID tidak ditemukan.";
}
?>