-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2021 at 09:36 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(64) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(0, 'admin', '$2y$10$EX0L5MeIQldpkCuTZW.mjujTaj.Yy20IW0GOluecU/c.es.9r6E5.', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nip` int(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_guru` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_mapel` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `email`, `nama_guru`, `password`, `nama_mapel`) VALUES
(123456, 'guru@gmail.com', 'Teacher', '$2y$10$3qQ2TYrtQHy44LblPMexnu4ZQrCWD.dYh20P.sOL5cyo6Z48fJQEq', '2'),
(214748364, 'Dummy@gmail.com', 'Ahmad Saugi', '$2y$10$EX0L5MeIQldpkCuTZW.mjujTaj.Yy20IW0GOluecU/c...', '1'),
(214748365, 'zaidanline67@gmail.com', 'Saauky', '$2y$10$3qQ2TYrtQHy44LblPMexnu4ZQrCWD.dYh20P.sOL5cyo6Z48fJQEq', '3'),
(1819107728, 'imas@gmail.com', 'Imas Kartika', '$2y$10$wCSBYTaCpSJaEX/1VUo1p.YU88vbgr7PeW.j1OkmD2xnKjIbB7SD6', '3'),
(2147483647, 'yusufxyz114@gmail.com', 'xyz', '$2y$10$M7FgINl4d4KlfrXxFk2yxumTilVzMMGk7XVwHWaIGWye0Wa3jsYXu', '2');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id` int(3) NOT NULL,
  `siswa_id` int(4) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `jawaban` varchar(500) NOT NULL,
  `tanggal_pengerjaan` datetime NOT NULL DEFAULT current_timestamp(),
  `tgl_selesai` datetime NOT NULL DEFAULT current_timestamp(),
  `nilai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id`, `siswa_id`, `tugas_id`, `jawaban`, `tanggal_pengerjaan`, `tgl_selesai`, `nilai`) VALUES
(1, 2, 1, '{\"durasi\":27,\"jawaban\":{\"1\":\"A\",\"2\":\"A\",\"3\":\"E\",\"4\":\"B\",\"5\":\"D\"}}', '2021-11-10 21:42:37', '2021-11-10 21:42:37', '20'),
(2, 2, 2, '{\"durasi\":11,\"jawaban\":{\"6\":\"C\"}}', '2021-11-11 09:22:35', '2021-11-11 09:22:35', '100');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=aktif 0=tidak'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `kategori_id`, `aktif`) VALUES
(1, 'XI IPA B', 1, 1),
(2, 'XI IPS A', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kelas_guru`
--

CREATE TABLE `kelas_guru` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas_guru`
--

INSERT INTO `kelas_guru` (`id`, `id_kelas`, `id_guru`) VALUES
(4, 2, 2147483647),
(5, 1, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `kelas_kategori`
--

CREATE TABLE `kelas_kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas_kategori`
--

INSERT INTO `kelas_kategori` (`id`, `kategori`) VALUES
(1, 'IPA'),
(2, 'IPS');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_mapel`
--

CREATE TABLE `kelas_mapel` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas_mapel`
--

INSERT INTO `kelas_mapel` (`id`, `id_kelas`, `id_mapel`) VALUES
(19, 2, 1),
(20, 2, 2),
(21, 2, 3),
(22, 2, 4),
(23, 2, 7),
(24, 2, 8),
(25, 1, 1),
(26, 1, 2),
(27, 1, 3),
(28, 1, 6),
(29, 1, 7),
(30, 1, 8),
(31, 1, 9),
(32, 1, 10),
(33, 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `kelas_siswa`
--

CREATE TABLE `kelas_siswa` (
  `id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kelas_siswa`
--

INSERT INTO `kelas_siswa` (`id`, `kelas_id`, `siswa_id`) VALUES
(1, 1, 0),
(2, 1, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `info` text DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = ya, 0 = tidak'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id`, `nama`, `info`, `aktif`) VALUES
(1, 'Bahasa Indonesia', NULL, 1),
(2, 'Bahasa Inggris', NULL, 1),
(3, 'Matematika', NULL, 1),
(4, 'Ekonomi', NULL, 1),
(6, 'IPA', NULL, 1),
(7, 'Penjas', NULL, 1),
(8, 'Agama', NULL, 1),
(9, 'Fisika', NULL, 1),
(10, 'Kimia', NULL, 1),
(11, 'Biologi', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` int(11) NOT NULL,
  `nama_guru` varchar(128) NOT NULL,
  `nama_mapel` varchar(128) NOT NULL,
  `video` varchar(255) NOT NULL,
  `deskripsi` varchar(1024) NOT NULL,
  `kelas` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id`, `nama_guru`, `nama_mapel`, `video`, `deskripsi`, `kelas`) VALUES
(1, '123456', '2', 'ELearning-SMANSA_!_-_Google_Chrome_2021-09-02_12-19-222.mp4', '                                        materi', '11'),
(2, '123456', '2', 'VID20200827130349_x264.mp4', 'fgygyg', '11'),
(3, '123456', '2', 'Data_Siswa_-_Google_Chrome_2021-10-27_14-11-02.mp4', 'materi', '11');

-- --------------------------------------------------------

--
-- Table structure for table `pilihan`
--

CREATE TABLE `pilihan` (
  `id` int(11) NOT NULL,
  `pertanyaan_id` int(11) NOT NULL,
  `konten` text NOT NULL,
  `kunci` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=tidak',
  `urutan` char(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pilihan`
--

INSERT INTO `pilihan` (`id`, `pertanyaan_id`, `konten`, `kunci`, `urutan`, `aktif`) VALUES
(1, 1, '<p><span xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed>Analytical Exposition</span></span></span></span></span></span></p>', 1, 'A', 1),
(2, 1, '<p>Report</p>', 0, 'B', 1),
(3, 1, '<p>Hortatory Exposition</p>', 0, 'C', 1),
(4, 1, '<p>Explanation Text</p>', 0, 'D', 1),
(5, 1, '<p>Descriptive text</p>', 0, 'E', 1),
(6, 2, '<p><span xss=removed><span xss=removed><span xss=removed>Federal government</span></span></span></p>', 1, 'A', 1),
(7, 2, '<p><span xss=removed><span xss=removed><span xss=removed>State Government</span></span></span></p>', 0, 'B', 1),
(8, 2, '<p><span xss=removed><span xss=removed><span xss=removed>Federal and State Government</span></span></span></p>', 0, 'C', 1),
(9, 2, '<p><span xss=removed><span xss=removed><span xss=removed>Federal and Local Government</span></span></span></p>', 0, 'D', 1),
(10, 2, '<p><span xss=removed><span xss=removed><span xss=removed>Local Government</span></span></span></p>', 0, 'E', 1),
(11, 3, '<p><span xss=removed><span xss=removed><span xss=removed>all governments</span></span></span></p>', 0, 'A', 1),
(12, 3, '<p><span xss=removed><span xss=removed><span xss=removed>Australia</span></span></span></p>', 0, 'B', 1),
(13, 3, '<p><span xss=removed><span xss=removed><span xss=removed>Federal government</span></span></span></p>', 0, 'C', 1),
(14, 3, '<p><span xss=removed><span xss=removed><span xss=removed>State governement</span></span></span></p>', 0, 'D', 1),
(15, 3, '<p><span xss=removed><span xss=removed><span xss=removed>Local government</span></span></span></p>', 1, 'E', 1),
(16, 4, '<p><span xss=removed><span xss=removed><span xss=removed>Plants</span></span></span></p>', 0, 'A', 1),
(17, 4, '<p><span xss=removed><span xss=removed><span xss=removed>Ecology</span></span></span></p>', 0, 'B', 1),
(18, 4, '<p><span xss=removed><span xss=removed><span xss=removed>Animals</span></span></span></p>', 0, 'C', 1),
(19, 4, '<p>Environment</p>', 0, 'D', 1),
(20, 4, '<p>Human Beings</p>', 1, 'E', 1),
(21, 5, '<p><span xss=removed><span xss=removed><span xss=removed>The fourth paragraph supports the idea stated in paragraph two.</span></span></span></p>', 0, 'A', 1),
(22, 5, '<p>Both paragraphs tell about the disadvantages of using pesticides.</p>', 1, 'B', 1),
(23, 5, '<p>Both paragraphs tell about how pesticides affect the quality of farm products.</p>', 0, 'C', 1),
(24, 5, '<p>The statement in paragraph is contrary to the statement in paragraph four.</p>', 0, 'D', 1),
(25, 5, '<p>The second paragraph tells about the effects of using pesticides on animals mentioned in paragraph four.</p>', 0, 'E', 1),
(26, 6, '<p><span xss=removed><span xss=removed><span xss=removed>Narrative.</span></span></span></p>', 0, 'A', 1),
(27, 6, '<p><span xss=removed><span xss=removed><span xss=removed>Report.</span></span></span></p>', 0, 'B', 1),
(28, 6, '<p><span xss=removed><span xss=removed><span xss=removed>Analytical.</span></span></span></p>', 1, 'C', 1),
(29, 6, '<p><span xss=removed><span xss=removed><span xss=removed>Explanation.</span></span></span></p>', 0, 'D', 1),
(30, 6, '<p><span xss=removed><span xss=removed><span xss=removed>Description</span></span></span></p>', 0, 'E', 1);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(64) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `password`, `image`, `is_active`, `date_created`) VALUES
(1, '1', 'Fadilla', '$2y$10$neIvPc.R5M/eRufzARKctecwXuWPxiK4Ahswa96fC26xsDK/TDQl6', '', 1, '0000-00-00'),
(2, '2', 'Citra', '$2y$10$/0Hoyo4n/mAPgLWeV4asP.SdL2SvQ.IXgMleE3GdATOyyEBMTESL2', '', 1, '0000-00-00'),
(3, '3', 'Nina', '$2y$10$0/SFHdVS5embulP3UOv0supAPDQqxynQAI9RmEQCMmYWEvLqjrDne', '', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `nip` int(70) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `durasi` int(11) NOT NULL COMMENT 'lama pengerjaan dalam menit',
  `info` text DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 0,
  `tgl_buat` datetime DEFAULT current_timestamp(),
  `tgl_akhir` datetime NOT NULL,
  `tampil_siswa` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=tidak tampil di siswa, 1=tampil siswa'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `mapel_id`, `nip`, `judul`, `durasi`, `info`, `aktif`, `tgl_buat`, `tgl_akhir`, `tampil_siswa`) VALUES
(1, 2, 123456, 'Tugas', 30, 'bbxjshu', 0, '2021-10-27 14:21:31', '2021-12-31 00:00:00', 1),
(2, 2, 123456, 'Tugas 2', 30, 'Tugas 2', 0, '2021-11-11 09:12:48', '2021-11-12 09:10:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tugas_kelas`
--

CREATE TABLE `tugas_kelas` (
  `id` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tugas_kelas`
--

INSERT INTO `tugas_kelas` (`id`, `tugas_id`, `kelas_id`) VALUES
(1, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tugas_pertanyaan`
--

CREATE TABLE `tugas_pertanyaan` (
  `id` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `urutan` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tugas_pertanyaan`
--

INSERT INTO `tugas_pertanyaan` (`id`, `pertanyaan`, `urutan`, `tugas_id`, `aktif`) VALUES
(1, '<p><span xss=removed><span xss=removed><span xss=removed>Text 1<br>\r\nIn Australia there are three levels of governments, the federal government, state governments and local governments. All of these levels of government are necessary. This is so for number of reasons. First, the federal government is necessary for the big things. They keep the economy in order and look after like defensE. Similarly, the state governments look after the middle sized things. For example they look after law and order, preventing things like vandalism in school. Finally, local government look after the small thins. They look after things like collecting rubbish, otherwise everyone would have diseasE. Thus for the reason above, we can conclude that the three levels of the government are necessary.</span></span></span></p>\r\n\r\n<p><span xss=removed><span xss=removed><span xss=removed>What kind of text is this?</span></span></span></p>\r\n\r\n<p> </p>', 1, 1, 1),
(2, '<p><span xss=removed><span xss=removed><span xss=removed>In Australia there are three levels of governments, the federal government, state governments and local governments. All of these levels of government are necessary. This is so for number of reasons. First, the federal government is necessary for the big things. They keep the economy in order and look after like defensE. Similarly, the state governments look after the middle sized things. For example they look after law and order, preventing things like vandalism in school. Finally, local government look after the small thins. They look after things like collecting rubbish, otherwise everyone would have diseasE. Thus for the reason above, we can conclude that the three levels of the government are necessary.</span></span></span></p>\r\n\r\n<p><span xss=removed><span xss=removed><span xss=removed>Who is responsible for defense?</span></span></span></p>', 2, 1, 1),
(3, '<p><span xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed>In Australia there are three levels of governments, the federal government, state governments and local governments. All of these levels of government are necessary. This is so for number of reasons. First, the federal government is necessary for the big things. They keep the economy in order and look after like defensE. Similarly, the state governments look after the middle sized things. For example they look after law and order, preventing things like vandalism in school. Finally, local government look after the small thins. They look after things like collecting rubbish, otherwise everyone would have diseasE. Thus for the reason above, we can conclude that the three levels of the government are necessary.</span></span></span></span></span></span></p>\r\n\r\n<p><span xss=removed><span xss=removed><span xss=removed>The litter management is the responsibility of ….</span></span></span></p>', 3, 1, 1),
(4, '<p><span xss=removed><span xss=removed><span xss=removed>There is no best way to deal with pests in agriculturE. Pesticides which are commonly used may cause many problems. I think combining different management operations is the most effective way to control pests.<br>\r\nFirstly, the chemicals in the pesticides may build up as residues in the environment and in the soil which absorbs the chemicals. This reduces the quality of farm product.<br>\r\nSecondly, pests can gradually become resistant to pesticides. This means that newer and stronger ones have to be developed.<br>\r\nLastly, some pesticides affect non target plants and animals such as fish and bees. This affects the ecology and environment as well.<br>\r\nSo, understanding of ecology of an area helps a lot in pest control. Pesticides should be chosen and applied carefully so that they don’t affect the ecological balance and environment. Therefore, integrated pest management is a safe and more effective option to fight pest in agriculture and livestock.</span></span></span></p>\r\n\r\n<p><span xss=removed><span xss=removed><span xss=removed>Which of the following is not directly affected by pesticides used?</span></span></span></p>', 4, 1, 1),
(5, '<p><span xss=removed><span xss=removed><span xss=removed>There is no best way to deal with pests in agriculturE. Pesticides which are commonly used may cause many problems. I think combining different management operations is the most effective way to control pests.<br>\r\nFirstly, the chemicals in the pesticides may build up as residues in the environment and in the soil which absorbs the chemicals. This reduces the quality of farm product.<br>\r\nSecondly, pests can gradually become resistant to pesticides. This means that newer and stronger ones have to be developed.<br>\r\nLastly, some pesticides affect non target plants and animals such as fish and bees. This affects the ecology and environment as well.<br>\r\nSo, understanding of ecology of an area helps a lot in pest control. Pesticides should be chosen and applied carefully so that they don’t affect the ecological balance and environment.</span></span></span> <span xss=removed><span xss=removed><span xss=removed>Therefore, integrated pest management is a safe and more effective option to fight pest in agriculture and livestock.</span></span></span></p>\r\n\r\n<p><span xss=removed><span xss=removed><span xss=removed>What can you say about paragraph two and four?</span></span></span></p>', 5, 1, 1),
(6, '<p><span xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed>As we all know, cars create pollution, and cause a lot of road deaths and other accidents.<br>\r\nFirstly, cars, as we all know contribute the most of pollution in the world. Cars emit a deadly gas causes illnesses such as bronchitis, lung cancer, and trigger of asthmA. Some of these illness are so bad that people can die from them.<br>\r\nSecondly, the city is very busy. Pedestrians wander every where and cars commonly hit pedestrians in the city, which causes them to diE. Cars today are our roads biggest killers.<br>\r\nThirdly, cars are very noisy. If you live in the city, you may find it hard to sleep at night, or concentrate in your homework, and especially talk to someonE.<br>\r\nIn conclusion, cars should be banned from the city for the reasons listed.</span></span></span></span></span></span></p>\r\n\r\n<p><span xss=removed><span xss=removed><span xss=removed>What type of the text above?</span></span></span></p>', 1, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas_guru`
--
ALTER TABLE `kelas_guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas_kategori`
--
ALTER TABLE `kelas_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas_mapel`
--
ALTER TABLE `kelas_mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_id` (`kelas_id`,`siswa_id`),
  ADD KEY `kelas_id_2` (`kelas_id`,`siswa_id`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pilihan`
--
ALTER TABLE `pilihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pertanyaan_id` (`pertanyaan_id`),
  ADD KEY `pertanyaan_id_2` (`pertanyaan_id`,`kunci`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas_kelas`
--
ALTER TABLE `tugas_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas_pertanyaan`
--
ALTER TABLE `tugas_pertanyaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tugas_id` (`tugas_id`),
  ADD KEY `tugas_id_2` (`tugas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas_guru`
--
ALTER TABLE `kelas_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelas_kategori`
--
ALTER TABLE `kelas_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas_mapel`
--
ALTER TABLE `kelas_mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pilihan`
--
ALTER TABLE `pilihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tugas_kelas`
--
ALTER TABLE `tugas_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tugas_pertanyaan`
--
ALTER TABLE `tugas_pertanyaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
