-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2024 at 04:09 AM
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
-- Database: `sigkab`
--

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id_kabupaten` int(11) NOT NULL COMMENT 'primary key tabel (auto increment)',
  `kode_kabupaten` varchar(100) NOT NULL COMMENT 'Kode kabupaten dari \r\nhttps://sig.bps.go.id/bridging-kode/index',
  `nama_kabupaten` varchar(100) NOT NULL,
  `koordinat` varchar(100) NOT NULL COMMENT 'Koordinat kabupaten dari google maps',
  `jumlah_penduduk` int(11) NOT NULL,
  `luas_wilayah` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id_kabupaten`, `kode_kabupaten`, `nama_kabupaten`, `koordinat`, `jumlah_penduduk`, `luas_wilayah`) VALUES
(1, '3302', 'Banyumas', '-7.426283252325609, 109.16436579350325', 1679124, 1327.58);

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `kode_kecamatan` varchar(100) NOT NULL COMMENT 'Primary key tabel (auto increment)\r\nKode kecamatan dari \r\nhttps://sig.bps.go.id/bridging-kode/index',
  `id_kabupaten` int(11) NOT NULL COMMENT 'Foreign Key\r\nData sesuai tabel kabupaten',
  `nama_kecamatan` varchar(100) NOT NULL COMMENT 'Nama kecamatan diisi sesuai kode kecamatan di atas',
  `jumlah_penduduk` int(11) NOT NULL,
  `luas_wilayah` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`kode_kecamatan`, `id_kabupaten`, `nama_kecamatan`, `jumlah_penduduk`, `luas_wilayah`) VALUES
('3302010', 1, 'LUMBIR', 54291, 103),
('3302020', 1, 'WANGON', 32323, 61),
('3302030', 1, 'JATILAWANG', 23432, 48),
('3302040', 1, 'RAWALO', 56064, 50),
('3302050', 1, 'Kebasen', 71324, 54),
('3302060', 1, 'KEMRANJEN', 76639, 61),
('3302070', 1, 'Sumpiuh', 60896, 60),
('3302080', 1, 'TAMBAK', 52972, 52),
('3302090', 1, 'SOMAGEDE', 39672, 61),
('3302100', 1, 'KALIBAGOR', 58785, 36),
('3302110', 1, 'BANYUMAS', 55528, 38),
('3302120', 1, 'PATIKRAJA', 62391, 43),
('3302130', 1, 'Purwojati', 39294, 38),
('3302140', 1, 'Ajibarang', 109529, 67),
('3302150', 1, 'GUMELAR', 23232, 94),
('3302160', 1, 'PEKUNCEN', 78196, 93),
('3302170', 1, 'CILONGOK', 131829, 105),
('3302180', 1, 'KARANGLEWAS', 69197, 32),
('3302190', 1, 'KEDUNGBANTENG', 64508, 60),
('3302200', 1, 'BATURRADEN', 55894, 46),
('3302210', 1, 'SUMBANG', 97756, 53),
('3302220', 1, 'KEMBARAN', 82897, 26),
('3302230', 1, 'SOKARAJA', 91988, 30),
('3302710', 1, 'PURWOKERTO SELATAN', 74305, 14),
('3302720', 1, 'PURWOKERTO BARAT', 53447, 7),
('3302730', 1, 'PURWOKERTO TIMUR', 58351, 8),
('3302740', 1, 'PURWOKERTO UTARA', 48264, 9);

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `npsn` int(11) NOT NULL,
  `kode_kecamatan` varchar(100) NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `alamat_sekolah` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `jenjang_pendidikan` varchar(100) NOT NULL,
  `koordinat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`npsn`, `kode_kecamatan`, `nama_sekolah`, `alamat_sekolah`, `status`, `jenjang_pendidikan`, `koordinat`) VALUES
(20301545, '3302010', 'SMK SRIWIJAYA 3 LUMBIR', 'RT 001 RW 004 Desa Lumbir', 'Swasta', 'SMK', '-7.4442,108.9569'),
(20301603, '3302010', 'SD NEGERI 6 LUMBIR', 'Butulan', 'NEGERI', 'SD', '-7.4482,108.9618'),
(20301608, '3302020', 'SDN 4 PENGADEGAN', 'Pengadegan Rt 2 Rw 8', 'NEGERI', 'SD', '-7.5145,109.0699'),
(20301747, '3302150', 'SD NEGERI 2 SAMUDRA', 'Jl. Raya Renggong RT 01/06 Desa Samudra', 'NEGERI', 'SD', '-7.3514,109.0144'),
(20301881, '3302710', 'SMP MUHAMMADIYAH 1 PURWOKERTO', 'Jl. Perintis Kemerdekaan No.6, Penisian, Purwokerto Kulon, Kec. Purwokerto Sel., Kabupaten Banyumas,', 'SWASTA', 'SMP', '-7.430255785093129, 109.24047518311862'),
(20301882, '3302020', 'SMP MUHAMMADIYAH 1 WANGON', 'Jalan Raya Utara Wangon', 'SWASTA', 'SMP', '-7.5135,109.0702'),
(20301932, '3302200', 'SMP NEGERI 2 BATURRADEN', 'Jalan Raya, Dusun II, Kemutug Kidul, Kec. Baturaden, Kabupaten Banyumas, Jawa Tengah 53151', 'NEGERI', 'SMP', '-7.339467133172349, 109.23686473690853'),
(20301944, '3302150', 'SMP NEGERI 2 GUMELAR', 'Jalan Raya Paningkaban', 'NEGERI', 'SMP', '-7.3456,108.9774'),
(20302002, '3302080', 'SMP NEGERI 1 TAMBAK', 'JL. Watu Agung Tambak, RT. 08 RW. 03, Kamulyan Tambak, Kaligalih, Kamulyan, Banyumas, Kabupaten Bany', 'NEGERI', 'SMP', '-7.609377233576643, 109.40518328108786'),
(20302005, '3302730', 'SMP NEGERI 1 PURWOKERTO', 'Jl. Jend. Sudirman No.181, Brubahan, Kranji, Kec. Purwokerto Tim., Kabupaten Banyumas, Jawa Tengah 5', 'NEGERI', 'SMP', '-7.425541660191995, 109.23356095428306'),
(20302011, '3302060', 'SMP NEGERI 1 KEMRANJEN', 'Simpangwijahan, Karangjati, Kec. Kemranjen, Kabupaten Banyumas, Jawa Tengah 53194', 'NEGERI', 'SMP', '-7.595500729077942, 109.31054540622982'),
(20302170, '3302140', 'SMAN 1 AJIBARANG', 'Jl. Pancurendang, Pondokgandu, Pancurendang, Kec. Ajibarang, Kabupaten Banyumas, Jawa Teng', 'NEGERI', 'SMA', '-7.403588044231896, 109.09251160992069'),
(20302171, '3302110', 'SMA NEGERI 1 BANYUMAS', 'Jalan Pramuka 13, Banyumas, Sudagaran, Kec. Banyumas, Kabupaten Banyumas, Jawa Tengah 53192', 'NEGERI', 'SMA', '-7.511179646648453, 109.2934556432816'),
(20302181, '3302120', 'SMA NEGERI 1 PATIKRAJA', 'Jl. Adipura No.3, Patikraja, Jawa, Tengah, Kec. Patikraja, Kabupaten Banyumas, 53171', 'NEGERI', 'SMA', '-7.485007045001205, 109.2282019350638'),
(20302638, '3302070', 'SD NEGERI 2 KUNTILI', 'Kuntili, Kec. Sumpiuh, Kabupaten Banyumas, Jawa Tengah 53195', 'NEGERI', 'SD', '-7.62771254325577, 109.34546716944041'),
(20302734, '3302170', 'SD N 1 PERNASIDI', 'Batuanten, Cilongok, Dusun II, Pernasidi, Banyumas, Kabupaten Banyumas, Jawa Tengah 53162', 'NEGERI', 'SD', '-7.401791922268882, 109.13754389457974'),
(20302799, '3302100', 'SD NEGERI SURO', 'Jalan Siliwangi RT. 01/RW. 02 Suro, Kalibagor, Suro, Kec. Kalibagor, Kabupaten Banyumas, Jawa Tengah', 'NEGERI', 'SD', '-7.487882844401609, 109.32695042341597'),
(20302850, '3302040', 'SD NEGERI 1 RAWALO', 'Kaliwadas, Rawalo, Kec. Rawalo, Kabupaten Banyumas, Jawa Tengah 53172', 'NEGERI', 'SD', '-7.535163551685361, 109.18172219458134'),
(20330442, '3302230', 'SMK BUDI UTOMO SOKARAJA', 'Gg. 3 No.07, Dusun II Sokaraja Tengah, Sokaraja Tengah, Kec. Banyumas, Kabupaten Banyumas, Jawa Teng', 'SWASTA', 'SMK', '-7.458355186156533, 109.28343193540636'),
(20330447, '3302180', 'SMK IT Ma\'arif NU Karanglewas', 'Dusun I, Babakan, Kec. Karanglewas, Kabupaten Banyumas, Jawa Tengah 53161', 'SWASTA', 'SMK', '-7.3890064388848025, 109.18841329457955'),
(20330454, '3302720', 'SMK Muhammadiyah 1 Purwokerto', 'H6G4+VG9, Jl. Yos Sudarso No.Kebanaran, Pasir Kidul, Purwokerto Barat, Karanglewas Lor, Kec. Purwoke', 'SWASTA', 'SMK', '-7.422540502573581, 109.20638045225044'),
(20330457, '3302090', 'SMK Muhammadiyah Somagede', 'Jalan Raya Somagede KM. 5, Somagede, Karanganyar, Somagede, Kec. Somagede, Kabupaten Banyumas, Jawa ', 'SWASTA', 'SMK', '-7.5175989334037645, 109.3349223829334'),
(20338198, '3302160', 'SMP DIPONEGORO 10 PEKUNCEN', 'JL. Stasiun Legok Pekuncen, RT. 01 RW. 01, Legok Pekuncen, Pekuncen, Kec. Pekuncen, Kabupaten Banyum', 'SWASTA', 'SMP', '-7.344085029664457, 109.08386248873579'),
(20338214, '3302740', 'SMA Diponegoro 1 Purwokerto', 'Jl. Letjend Pol. Soemarto Gg. VI No.63, Karangsuci, Purwanegara, Kec. Purwokerto Utara, Kabupaten Ba', 'NEGERI', 'SMA', '-7.405229666291346, 109.23137308108545'),
(20338300, '3302190', 'SD NEGERI 1 KALISALAK', 'J5RV+VQ4, Dusun II, Kalisalak, Kec. Kedungbanteng, Kabupaten Banyumas, Jawa Tengah 53152', 'NEGERI', 'SD', '-7.3504236689683, 109.194029073033'),
(20347320, '3302130', 'SMK N 1 PURWOJATI', 'Klapasawit Kidul, Klapasawit, Kec. Purwojati, Kabupaten Banyumas, Jawa Tengah 53175', 'NEGERI', 'SMK', '-7.484127681277077, 109.12015872341595'),
(20353982, '3302030', 'SMKS KARYA TEKNOLOGI', 'JL. RAYA KEDUNGWRINGIN NO. 4 JATILAWANG', 'SWASTA', 'SMK', '-7.5357683,109.121275'),
(20354395, '3302030', 'SD NEGERI 2 PEKUNCEN', 'Jl. Kalilirip', 'NEGERI', 'SD', '-7.5693,109.1201'),
(20363456, '3302020', 'MTs Muhammadyah Wangon', 'JL. ASTANA NO. 915 RT.02/06 WANGON', 'SWASTA', 'SMP', '-7.517575874742579, 109.05222858084441'),
(69786510, '3302050', 'SMP ISLAM ANDALUSIA KEBASEN', 'Gombolsalak, Randegan, Kec. Kebasen, Kabupaten Banyumas, Jawa Tengah 53172', 'SWASTA', 'SMP', '-7.56788346173751, 109.22695536759304');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id_kabupaten`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`kode_kecamatan`),
  ADD KEY `k_kab` (`id_kabupaten`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`npsn`),
  ADD KEY `k_kec` (`kode_kecamatan`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD CONSTRAINT `k_kab` FOREIGN KEY (`id_kabupaten`) REFERENCES `kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD CONSTRAINT `k_kec` FOREIGN KEY (`kode_kecamatan`) REFERENCES `kecamatan` (`kode_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
