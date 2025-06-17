
-- Database: manajemen_nilai_lomba

-- Tabel users (akun login)
CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100),
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    profile_image VARCHAR(255) DEFAULT 'default.png'
);

-- Tabel peserta lomba
CREATE TABLE peserta (
    id_peserta INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nis VARCHAR(20) UNIQUE,
    kelas VARCHAR(20)
);

-- Tabel kategori lomba
CREATE TABLE kategori_lomba (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL
);

-- Tabel lomba
CREATE TABLE lomba (
    id_lomba INT AUTO_INCREMENT PRIMARY KEY,
    nama_lomba VARCHAR(100) NOT NULL,
    id_kategori INT,
    tanggal_lomba DATE NOT NULL,
    FOREIGN KEY (id_kategori) REFERENCES kategori_lomba(id_kategori)
);

-- Tabel nilai lomba
CREATE TABLE nilai_lomba (
    id_nilai INT AUTO_INCREMENT PRIMARY KEY,
    id_peserta INT,
    id_lomba INT,
    nilai DECIMAL(5,2),
    peringkat INT,
    keterangan TEXT,
    FOREIGN KEY (id_peserta) REFERENCES peserta(id_peserta),
    FOREIGN KEY (id_lomba) REFERENCES lomba(id_lomba)
);
