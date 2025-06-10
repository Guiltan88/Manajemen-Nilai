<?php
include 'Core/Database.php';
class Mahasiswa_model extends Database{
    private $db;
    function __construct(){
        $this->db=new Database();
    }
    function getAllData(){
        $query = "SELECT * FROM siswa ORDER BY created DESC";
        $data = $this->db->execute($query);
        return $data;
    }
    function hapusData($id){
        $where = 'nis='.$id;
        $status = $this->db->delete('siswa',$where);
        if ($status){
            echo "<script> alert('Data Berhasil Dihapus!');
            window.location.href = 'index.php';
            </script>";
        }else{
            echo "<script> alert('Data Gagal dihapus!');
            </script>";
        }
    }
    function getDataByNim($nis) {
        $query = "SELECT * FROM siswa WHERE nis = '$nis'";
        $result = $this->db->execute($query);
        return $result[0]; 
    }

    function updateData($old_nim, $data) {
        $query = "UPDATE siswa SET 
              nis = '".$data['nis']."',
              nama = '".$data['nama']."',
              kelas = '".$data['kelas']."'
              WHERE nis = '$old_nim'";
    
    $result = mysqli_query($this->db->getConnection(), $query);
    
    if ($result) {
        echo "<script>
            alert('Data Berhasil Diupdate!');
            window.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data Gagal Diupdate!');
            window.location.href = 'index.php';
        </script>";
    }
}
        function tambahData($data){
        $col = ['nis','nama','kelas'];
        $status = $this->db->insert('siswa',$col,$data);
        if ($status){
            echo "<script>
            alert('Data Berhasil ditambahkan!')
            window.location.href = 'index.php';
            </script>";
            
        }else{
            echo "<script>
            alert('Data Gagal ditambahkan!');
            </script>";
        }
    }
}   
?>