<div class="container-md p-2">
  <div style="text-align: right; margin: 2rem 5%;">
    <a href="tambah.php" class="btn btn-ubah">Tambah Data</a>
  </div>

  <table id="example" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th>No</th>
        <th>NIS</th>
        <th>Nama Siswa</th>
        <th>Kelas</th>
        <th>Rata Rata</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>

    <tbody>
      <?php
      $i = 1;
      foreach ($data as $row) {
        echo "<tr><td>$i</td>
        <td>".$row['nis']."</td>
        <td>".$row['nama']."</td>
        <td>".$row['kelas']."</td>
        <td>".$row['rata']."</td>
        <td>".$row['status']."</td>
        <td>
          <a href='index.php?page=editnim&nim=". $row['nis'] ."' class='btn btn-info'>Ubah</a>
          <a href='index.php?page=hapus&id=". $row['nis'] ."' class='btn btn-danger' onclick='return confirm(\"Yakin ?\")'>Hapus</a>
        </td></tr>";
        $i++;
      }
      ?>
    </tbody>

    <tfoot>
      <tr>
        <th>No</th>
        <th>NIS</th>
        <th>Nama Siswa</th>
        <th>Kelas</th>
        <th>Rata Rata</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </tfoot>
  </table>
  </div>
</div>
