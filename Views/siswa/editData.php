<div class="container-md p-2">
  <form method="POST" action="index.php?page=updateDataSiswa">
    <input type="hidden" name="old_nis" value="<?= $data['nis'] ?>">
    
    <input type="number" name="nis" class="form-control mb-3" 
           value="<?= $data['nim'] ?>" required placeholder="NIS">
           
    <input type="text" name="nama" class="form-control mb-3" 
           value="<?= $data['nama'] ?>" required placeholder="Nama Lengkap">
           
    <select class="form-select form-control mb-3" aria-label="Default select example" 
            name="Kelas" required>
      <option value="">Pilih Kelas</option>
      <option value="1 IPA A" <?= $data['kelas'] == '1 IPA A' ? 'selected' : '' ?>>1 IPA A</option>
      <option value="1 IPA B" <?= $data['Kelas'] == '1 IPA B' ? 'selected' : '' ?>>1 IPA B</option>
      <option value="1 IPS A" <?= $data['Kelas'] == '1 IPS A' ? 'selected' : '' ?>>1 IPS A</option>
      <option value="1 IPS B" <?= $data['Kelas'] == '1 IPS B' ? 'selected' : '' ?>>1 IPS B</option>
      <option value="2 IPA A" <?= $data['Kelas'] == '2 IPA A' ? 'selected' : '' ?>>2 IPA A</option>
      <option value="2 IPA B" <?= $data['Kelas'] == '2 IPA B' ? 'selected' : '' ?>>2 IPA B</option>
      <option value="2 IPS A" <?= $data['Kelas'] == '2 IPS A' ? 'selected' : '' ?>>2 IPS A</option>
      <option value="2 IPS B" <?= $data['Kelas'] == '2 IPS B' ? 'selected' : '' ?>>2 IPS B</option>
      <option value="3 IPA A" <?= $data['Kelas'] == '3 IPA A' ? 'selected' : '' ?>>3 IPA A</option>
      <option value="3 IPA B" <?= $data['Kelas'] == '3 IPA B' ? 'selected' : '' ?>>3 IPA B</option>
      <option value="3 IPS A" <?= $data['Kelas'] == '3 IPS A' ? 'selected' : '' ?>>3 IPS A</option>
      <option value="3 IPS B" <?= $data['Kelas'] == '3 IPS B' ? 'selected' : '' ?>>3 IPS B</option>
    </select>
    
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>