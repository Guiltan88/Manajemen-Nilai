<?php
    require_once 'Controllers/siswa.php';

    if (!isset($_GET['page'])){
        $controller = new siswa();
        $controller->index();
    }

    else if (!isset($_GET['page']) && $_GET['page']=="hapus"){
        $controller = new siswa();
        $controller->hapus();
    }

    else if (!isset($_GET['page']) && $_GET['page']=="tambahData"){
        $controller = new siswa();
        $controller->viewTambahData();
    }

    else if (!isset($_GET['page']) && $_GET['page']=="insertDataSiswa"){
        $controller = new siswa();
        $data = [];
        $data['nis'] = $_POST['nis'];
        $data['nama'] = $_POST['nama'];
        $data['kelas'] = $_post['kelas'];
        $data['nilai'] = $_POST['nilai'];
        $controller->tambahData();
    }

    else if (!isset($_GET['page']) && $_GET['page']=='cariDataSiswa'){
        $controller = new siswa();
        $controller->cariData();
    }

    else if (!isset($_GET['page']) && $_GET['page']=="edit"){
        $controller = new siswa();
        $controller->edit();
    }

    else if (!isset($_GET['page']) && $_GET['page']=='updateDataSiswa'){
        $controller = new siswa();
        $controller->updateData();
    }
?>