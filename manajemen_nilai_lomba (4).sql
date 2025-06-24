-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2025 at 10:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manajemen_nilai_lomba`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `HitungKeterangan` (`nilai1` DECIMAL(5,2), `nilai2` DECIMAL(5,2), `nilai3` DECIMAL(5,2)) RETURNS VARCHAR(50) CHARSET latin1 COLLATE latin1_swedish_ci DETERMINISTIC BEGIN
    DECLARE rata_rata DECIMAL(5,2);
    SET rata_rata = (nilai1 + nilai2 + nilai3) / 3;
    
    RETURN CASE
        WHEN rata_rata >= 90 THEN 'Sangat Baik'
        WHEN rata_rata >= 80 THEN 'Baik'
        WHEN rata_rata >= 70 THEN 'Cukup'
        ELSE 'Perlu Pembinaan'
    END;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_lomba`
--

CREATE TABLE `kategori_lomba` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori_lomba`
--

INSERT INTO `kategori_lomba` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Pidato'),
(2, 'Cerdas Cermat'),
(3, 'Debat'),
(4, 'Desain Poster');

-- --------------------------------------------------------

--
-- Table structure for table `lomba`
--

CREATE TABLE `lomba` (
  `id_lomba` int(11) NOT NULL,
  `nama_lomba` varchar(100) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `tanggal_lomba` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `lomba`
--

INSERT INTO `lomba` (`id_lomba`, `nama_lomba`, `id_kategori`, `tanggal_lomba`) VALUES
(1, 'Pidato Nasional', 1, '2025-06-30'),
(2, 'Olimpiade Sains', 2, '2025-06-29'),
(3, 'Lomba Debat Pelajar', 3, '2025-06-27'),
(4, 'Desain Poster Kreatif', 4, '2025-06-26');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_lomba`
--

CREATE TABLE `nilai_lomba` (
  `id_nilai` int(11) NOT NULL,
  `id_peserta` int(11) DEFAULT NULL,
  `id_lomba` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `nilai1` decimal(5,2) NOT NULL,
  `nilai2` decimal(5,2) NOT NULL,
  `nilai3` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `nilai_lomba`
--

INSERT INTO `nilai_lomba` (`id_nilai`, `id_peserta`, `id_lomba`, `keterangan`, `nilai1`, `nilai2`, `nilai3`) VALUES
(6, 7, 1, 'Cukup', 87.00, 67.00, 78.00),
(7, 1, 2, 'Baik', 87.00, 78.00, 94.00),
(8, 2, 3, 'Sangat Baik', 98.00, 96.00, 97.00),
(9, 3, 4, 'Cukup', 87.00, 78.00, 65.00),
(10, 6, 1, 'Perlu Pembinaan', 56.00, 67.00, 59.00),
(14, 8, 3, 'Baik', 78.00, 91.00, 85.00),
(15, 9, 3, 'Perlu Pembinaan', 57.00, 48.00, 67.00);

--
-- Triggers `nilai_lomba`
--
DELIMITER $$
CREATE TRIGGER `AutoKeteranganInsert` BEFORE INSERT ON `nilai_lomba` FOR EACH ROW BEGIN
    SET NEW.keterangan = HitungKeterangan(
        NEW.nilai1, 
        NEW.nilai2, 
        NEW.nilai3
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AutoKeteranganUpdate` BEFORE UPDATE ON `nilai_lomba` FOR EACH ROW BEGIN
    SET NEW.keterangan = HitungKeterangan(
        NEW.nilai1, 
        NEW.nilai2, 
        NEW.nilai3
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nama`, `kelas`) VALUES
(1, 'Ahmad Budi', '1 IPA A'),
(2, 'Siti Aisyah', '3 IPS B'),
(3, 'Rizky Furman', '2 IPA D'),
(6, 'Hilman Yahya', '3 IPA A'),
(7, 'Regina Ricci', '3 IPA D'),
(8, 'Yuki Akuto', '2 IPS B'),
(9, 'Gerald Sanjaya', '3 IPA A');

--
-- Triggers `peserta`
--
DELIMITER $$
CREATE TRIGGER `after_peserta_delete` AFTER DELETE ON `peserta` FOR EACH ROW BEGIN
    INSERT INTO peserta_history (id_peserta, nama, kelas)
    VALUES (OLD.id_peserta, OLD.nama, OLD.kelas);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `peserta_history`
--

CREATE TABLE `peserta_history` (
  `id_history` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `peserta_history`
--

INSERT INTO `peserta_history` (`id_history`, `id_peserta`, `nama`, `kelas`, `deleted_at`) VALUES
(1, 5, 'Imam Saputra', '1 IPA C', '2025-06-21 08:16:38'),
(2, 4, 'Lina Marlina', '2 IPA B', '2025-06-21 08:18:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `phone`) VALUES
(1, 'Dzaky', 'dzaky@example.id', 'dzaky', '081128128734'),
(2, 'Homan', 'lukman@example.id', 'kamen', '084562347231'),
(3, 'Langgun', 'langgun@example.id', 'langgun', '087364123857'),
(4, 'Boby', 'boby@example.id', 'boby', '083626427345');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_peringkat_peserta`
-- (See below for the actual view)
--
CREATE TABLE `view_peringkat_peserta` (
`id_nilai` int(11)
,`nama_peserta` varchar(100)
,`jenis_lomba` varchar(100)
,`total_nilai` decimal(7,2)
,`peringkat` bigint(22)
);

-- --------------------------------------------------------

--
-- Structure for view `view_peringkat_peserta`
--
DROP TABLE IF EXISTS `view_peringkat_peserta`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_peringkat_peserta`  AS SELECT `n`.`id_nilai` AS `id_nilai`, `p`.`nama` AS `nama_peserta`, `k`.`nama_kategori` AS `jenis_lomba`, `n`.`nilai1`+ `n`.`nilai2` + `n`.`nilai3` AS `total_nilai`, (select count(0) + 1 from `nilai_lomba` `n2` where `n2`.`nilai1` + `n2`.`nilai2` + `n2`.`nilai3` > `n`.`nilai1` + `n`.`nilai2` + `n`.`nilai3`) AS `peringkat` FROM (((`nilai_lomba` `n` join `peserta` `p` on(`n`.`id_peserta` = `p`.`id_peserta`)) join `lomba` `l` on(`n`.`id_lomba` = `l`.`id_lomba`)) join `kategori_lomba` `k` on(`l`.`id_kategori` = `k`.`id_kategori`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori_lomba`
--
ALTER TABLE `kategori_lomba`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `lomba`
--
ALTER TABLE `lomba`
  ADD PRIMARY KEY (`id_lomba`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `nilai_lomba`
--
ALTER TABLE `nilai_lomba`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_peserta` (`id_peserta`),
  ADD KEY `id_lomba` (`id_lomba`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Indexes for table `peserta_history`
--
ALTER TABLE `peserta_history`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori_lomba`
--
ALTER TABLE `kategori_lomba`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lomba`
--
ALTER TABLE `lomba`
  MODIFY `id_lomba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nilai_lomba`
--
ALTER TABLE `nilai_lomba`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `peserta_history`
--
ALTER TABLE `peserta_history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lomba`
--
ALTER TABLE `lomba`
  ADD CONSTRAINT `lomba_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_lomba` (`id_kategori`);

--
-- Constraints for table `nilai_lomba`
--
ALTER TABLE `nilai_lomba`
  ADD CONSTRAINT `nilai_lomba_ibfk_1` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`),
  ADD CONSTRAINT `nilai_lomba_ibfk_2` FOREIGN KEY (`id_lomba`) REFERENCES `lomba` (`id_lomba`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
