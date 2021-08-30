-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2021 at 03:24 PM
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
(214748364, 'Dummy@gmail.com', 'Ahmad Saugi', '$2y$10$EX0L5MeIQldpkCuTZW.mjujTaj.Yy20IW0GOluecU/c...', '1'),
(214748365, 'zaidanline67@gmail.com', 'Saauky', '$2y$10$3qQ2TYrtQHy44LblPMexnu4ZQrCWD.dYh20P.sOL5cyo6Z48fJQEq', '3'),
(1819107728, 'imas@gmail.com', 'Imas Kartika', '$2y$10$wCSBYTaCpSJaEX/1VUo1p.YU88vbgr7PeW.j1OkmD2xnKjIbB7SD6', '3'),
(2147483647, 'yusufxyz114@gmail.com', 'xyz', '$2y$10$WFLrxhYPsmEydDUIMPt08.qxTxsQ7FMNvVnwA7Zxz/y4Xdn9L4DzC', '10');

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
(1, 'Kelas X-A', 1, 1);

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
(1, 'X'),
(2, 'XI'),
(3, 'XII');

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
(2, 1, 48);

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
(42, 'Saauky', '3', 'Matematika_-_Dummy_-_1.mp4', 'axasd', '1'),
(43, 'Saauky', '3', 'Matematika_-_Dummy_-_2.mp4', 'Aljabar linear adalah bidang studi matematika yang mempelajari sistem persamaan linear dan solusinya, vektor, serta transformasi linear. Matriks dan operasinya juga merupakan hal yang berkaitan erat dengan bidang aljabar linear.', '1'),
(44, 'Saauky', '3', 'Matematika_-_Dummy_3.mp4', 'Vektor merupakan kajian aljabar yang biasanya digunakan untuk memecahkan permasalahan fisika seperti gerak, gaya, dan sebagainya. ... Sebuah vektor bisa dinyatakan dalam bentuk geometri yang digambarkan sebagai sebuah ruas garis dengan arah tertentu dimana salah satunya merupakan pangkal dan satunya lagi merupakan ujung.', '1'),
(45, 'Saauky', '3', 'Matematika_-_Dummy_4.mp4', 'Vektor dalam matematika dan fisika adalah objek geometri yang memiliki besar dan arah. Vektor jika dilambangkan dengan tanda panah. Besar vektor proporsional dengan panjang panah dan arahnya bertepatan dengan arah panah. Vektor dapat melambangkan perpindahan dari titik A ke B. Vektor sering ditandai sebagai', '1'),
(46, 'Saauky', '3', 'Matematika_-_Dummy_5.mp4', 'Pecahan, atau disebut fraksi adalah istilah dalam matematika yang terdiri dari pembilang dan penyebut. Hakikat transaksi dalam bilangan pecahan adalah bagaimana cara menyederhanakan pembilang dan penyebut.', '1'),
(47, 'Zaaidan', '6', 'IPA_-_Dummy_1.mp4', 'Fisika adalah salah satu disiplin akademik paling tua, mungkin yang tertua melalui astronomi yang juga termasuk di dalamnya.[6] Lebih dari dua milenia, fisika menjadi bagian dari Ilmu Alam bersama dengan kimia, biologi, dan cabang tertentu matematika, tetapi ketika munculnya revolusi ilmiah pada abad ke-17, ilmu alam berkembang sebagai program penelitian sendiri.[b] Fisika berkembang dengan banyak spesialisasi bidang ilmu lain, seperti biofisika dan kimia kuantum, dan batasan fisiknya tidak didefinisikan dengan jelas. Ilmu baru dalam fisika terkadang digunakan untuk menjelaskan mekanisme dasar sains lainnya[3] serta membuka jalan area penelitian lainnya seperti matematika dan filsafat.', '1'),
(50, 'Zaaidan', '6', 'IPA_-_Dummy_2.mp4', 'Kristalisasi adalah proses pembentukan bahan padat dari pengendapan larutan, melt, atau lebih jarang pengendapan langsung dari gas. Kristalisasi juga merupakan teknik pemisahan kimia antara bahan padat-cair, di mana terjadi perpindahan massa dari suat zat terlarut dari cairan larutan ke fase kristal padat', '1'),
(51, 'Zaaidan', '6', 'IPA_-_Dummy_3.mp4', 'Peleburan adalah proses reduksi bijih sehingga menjadi logam unsur yang dapat digunakan berbagai macam zat seperti karbid, hidrogen, logam aktif atau dengan cara elektrolisis. Pemilihan zat pereduksi ini tergantung dari kereaktifan masing-masing zat.', '1'),
(52, 'Zaaidan', '6', 'IPA_-_Dummy_4.mp4', 'Pencairan, pelelehan atau Peleburan adalah proses yang menghasilkan perubahan fase zat dari padat ke cair. Energi internal dari zat padat meningkat mencapai temperatur tertentu saat zat ini berubah menjadi cair.Benda yang telah mencair sepenuhnya disebut benda cair.', '1'),
(53, 'Zaaidan', '6', 'IPA_-_Dummy_5.mp4', 'Dalam ilmu fisika dan kimia, pembekuan adalah proses di mana cairan berubah menjadi padatan. Titik beku adalah temperatur di mana hal ini terjadi. Peleburan, adalah proses kebalikan dari pembekuan di mana padatan berubah manjadi cairan. Pada sebagian besar zat, titik beku dan titik lebur biasanya sama.', '1'),
(54, 'Zaaidan', '6', 'IPA_-_Dummy_6.mp4', 'Teknologi pembekuan makanan adalah teknologi mengawetkan makanan dengan menurunkan temperaturnya hingga di bawah titik beku air.', '1'),
(55, 'Khaairan', '2', 'Inggris_-_Dummy_1.mp4', 'Bahasa Inggris adalah bahasa Jermanik yang pertama kali dituturkan di Inggris pada Abad Pertengahan Awal dan saat ini merupakan bahasa yang paling umum digunakan di seluruh dunia.[4] Bahasa Inggris dituturkan sebagai bahasa pertama oleh mayoritas penduduk di berbagai negara, termasuk Britania Raya, Irlandia, Amerika Serikat, Kanada, Australia, Selandia Baru, dan sejumlah negara-negara Karibia; serta menjadi bahasa resmi di hampir 60 negara berdaulat. Bahasa Inggris adalah bahasa ibu ketiga yang paling banyak dituturkan di seluruh dunia, setelah bahasa Mandarin dan bahasa Spanyol.[5] Bahasa Inggris juga digunakan sebagai bahasa kedua dan bahasa resmi oleh Uni Eropa, Negara Persemakmuran, dan Perserikatan Bangsa-Bangsa, serta beragam organisasi lainnya.', '1'),
(56, 'Khaairan', '2', 'Inggris_-_Dummy_2.mp4', 'Bahasa Inggris berkembang pertama kali di Kerajaan Anglo-Saxon Inggris dan di wilayah yang saat ini membentuk Skotlandia tenggara. Setelah meluasnya pengaruh Britania Raya pada abad ke-17 dan ke-20 melalui Imperium Britania, bahasa Inggris tersebar luas di seluruh dunia.[6][7][8] Di samping itu, luasnya penggunaan bahasa Inggris juga disebabkan oleh penyebaran kebudayaan dan teknologi Amerika Serikat yang mendominasi di sepanjang abad ke-20.[9] Hal-hal tersebut telah menyebabkan bahasa Inggris saat ini menjadi bahasa utama dan secara tidak resmi (de facto) dianggap sebagai lingua franca di berbagai belahan dunia.[10][11]', '1'),
(57, 'Khaairan', '2', 'Inggris_-_Dummy_3.mp4', 'Menurut sejarahnya, bahasa Inggris berasal dari peleburan beragam dialek terkait, yang saat ini secara kolektif dikenal sebagai bahasa Inggris Kuno, yang dibawa ke pantai timur Pulau Britania oleh pendatang Jermanik (Anglo-Saxons) pada abad ke-5; kata English\' berasal dari nama Angles.[12] Suku Anglo-Saxons ini sendiri berasal dari wilayah Angeln (saat ini Schleswig-Holstein, Jerman). Bahasa Inggris awal juga dipengaruhi oleh bahasa Norse Kuno setelah Viking menaklukkan Inggris pada abad ke-9 dan ke-10.', '1'),
(58, 'Khaairan', '2', 'Inggris_-_Dummy_4.mp4', 'Penaklukan Normandia terhadap Inggris pada abad ke-11 menyebabkan bahasa Inggris juga mendapat pengaruh dari bahasa Prancis Norman, dan kosakata serta ejaan dalam bahasa Inggris mulai dipengaruhi oleh bahasa Latin Romawi (meskipun bahasa Inggris sendiri bukanlah rumpun bahasa Romawi),[13][14] yang kemudian dikenal dengan bahasa Inggris Pertengahan. Pergeseran Vokal yang dimulai di Inggris bagian selatan pada abad ke-15 adalah salah satu peristiwa bersejarah yang menandai peralihan bahasa Inggris Pertengahan menjadi bahasa Inggris Modern.', '1'),
(59, 'Khaairan', '2', 'Inggris_-_Dummy_5.mp4', 'Selain Anglo-Saxons dan Prancis Norman, sejumlah besar kata dalam bahasa Inggris juga berakar dari bahasa Latin, karena Latin adalah lingua franca Gereja Kristen dan bahasa utama di kalangan intelektual Eropa,[15] dan telah menjadi dasar kosakata bagi bahasa Inggris modern.', '1'),
(60, 'Khaairan', '2', 'Inggris_-_Dummy_6.mp4', 'Karena telah mengalami perpaduan beragam kata dari berbagai bahasa di sepanjang sejarah, bahasa Inggris modern memiliki kosakata yang sangat banyak, dengan pengejaan yang kompleks dan tidak teratur (irregular), khususnya vokal. Bahasa Inggris modern tidak hanya merupakan perpaduan dari bahasa-bahasa Eropa, tetapi juga dari berbagai bahasa di seluruh dunia. Oxford English Dictionary memuat daftar lebih dari 250.000 kata berbeda, tidak termasuk istilah-istilah teknis, sains, dan bahasa gaul yang jumlahnya juga sangat banyak.[16][17]', '1'),
(61, 'Khairi Firdaus', '1', 'Indonesia_-_Dummy_1.mp4', 'Bahasa Indonesia adalah bahasa Melayu yang dijadikan sebagai bahasa resmi Republik Indonesia[1] dan bahasa persatuan bangsa Indonesia.[2] Bahasa Indonesia diresmikan penggunaannya setelah Proklamasi Kemerdekaan Indonesia, tepatnya sehari sesudahnya, bersamaan dengan mulai berlakunya konstitusi. Di Timor Leste, bahasa Indonesia berstatus sebagai bahasa kerja.', '1'),
(62, 'Khairi Firdaus', '1', 'Indonesia_-_Dummy_2.mp4', 'Dari sudut pandang linguistik, bahasa Indonesia adalah salah satu dari banyak varietas bahasa Melayu.[3] Dasar yang dipakai sebagai dasar bahasa Indonesia baku adalah bahasa Melayu Tinggi (&quot;Riau&quot;).[4][5] Dalam perkembangannya, ia mengalami perubahan akibat penggunaannya sebagai bahasa kerja di lingkungan administrasi kolonial dan berbagai proses pembakuan sejak awal abad ke-20. Penamaan &quot;bahasa Indonesia&quot; diawali sejak dicanangkannya Sumpah Pemuda, 28 Oktober 1928, untuk menghindari kesan &quot;imperialisme bahasa&quot; apabila nama bahasa Melayu tetap digunakan.[6] Proses ini menyebabkan berbedanya bahasa Indonesia saat ini dari varian bahasa Melayu yang digunakan di Riau maupun Semenanjung Malaya. Hingga saat ini, bahasa Indonesia merupakan bahasa yang hidup, yang terus menghasilkan kata-kata baru, baik melalui penciptaan maupun penyerapan dari bahasa daerah dan bahasa asing.', '1'),
(63, 'Khairi Firdaus', '1', 'Indonesia_-_Dummy_3.mp4', 'Meskipun dipahami dan dituturkan oleh lebih dari 90% warga Indonesia, bahasa Indonesia bukanlah bahasa ibu bagi kebanyakan penuturnya. Sebagian besar warga Indonesia menggunakan salah satu dari 748 bahasa yang ada di Indonesia sebagai bahasa ibu.[7] Istilah &quot;bahasa Indonesia&quot; paling umum dikaitkan dengan bahasa baku yang digunakan dalam situasi formal.[4] Ragam bahasa baku tersebut berhubungan diglosik dengan bentuk-bentuk bahasa Melayu vernacular yang digunakan sebagai peranti komunikasi sehari-hari.[4] Artinya, penutur bahasa Indonesia kerap kali menggunakan versi sehari-hari (colloquial) dan/atau mencampuradukkan dengan dialek Melayu lainnya atau bahasa ibunya. Meskipun demikian, bahasa Indonesia digunakan sangat luas di perguruan-perguruan, di media massa, sastra, perangkat lunak, surat-menyurat resmi, dan berbagai forum publik lainnya,[8] sehingga dapatlah dikatakan bahwa bahasa Indonesia digunakan oleh semua warga Indonesia.', '1'),
(64, 'Khairi Firdaus', '1', 'Indonesia_-_Dummy_4.mp4', 'Aksara pertama dalam bahasa Melayu atau Jawi ditemukan di pesisir tenggara Pulau Sumatra, menunjukkan bahwa bahasa ini menyebar ke berbagai tempat di Nusantara dari wilayah ini, berkat penggunaannya oleh Kerajaan Sriwijaya yang menguasai jalur perdagangan. Istilah Melayu atau sebutan bagi wilayahnya sebagai Malaya sendiri berasal dari Kerajaan Malayu yang bertempat di Batang Hari, Jambi.', '1'),
(65, 'Khairi Firdaus', '1', 'Indonesia_-_Dummy_5.mp4', 'stilah Melayu atau Malayu berasal dari Kerajaan Malayu, sebuah kerajaan Hindu-Buddha pada abad ke-7 di hulu sungai Batanghari, Jambi di pulau Sumatra, jadi secara geografis semula hanya mengacu kepada wilayah kerajaan tersebut yang merupakan sebagian dari wilayah pulau Sumatra. Dalam perkembangannya, pemakaian istilah Melayu mencakup wilayah geografis yang lebih luas dari wilayah Kerajaan Malayu tersebut, mencakup negeri-negeri di pulau Sumatra sehingga pulau tersebut disebut juga Bumi Melayu seperti disebutkan dalam Kakawin Nagarakretagama.', '1'),
(67, 'Khairi Firdaus', '1', 'Indonesia_-_Dummy_6.mp4', 'Ibu kota Kerajaan Melayu semakin mundur ke pedalaman karena serangan Sriwijaya dan masyarakatnya diaspora keluar Bumi Melayu, belakangan masyarakat pendukungnya yang mundur ke pedalaman berasimilasi ke dalam masyarakat Minangkabau menjadi klan Malayu (suku Melayu Minangkabau) yang merupakan salah satu marga di Sumatra Barat. Sriwijaya berpengaruh luas hingga ke Filipina membawa penyebaran Bahasa Melayu semakin meluas, tampak dalam prasasti Keping Tembaga Laguna.\r\n\r\nBahasa Melayu kuno yang berkembang di Bumi Melayu tersebut berlogat &quot;o&quot; seperti Melayu Jambi, Minangkabau, Kerinci, Palembang dan Bengkulu. Semenanjung Malaka dalam Nagarakretagama disebut Hujung Medini artinya Semenanjung Medini.', '1'),
(80, 'Saauky', '3', 'Cara_Menyelamatkan_Data_Di_Hardisk_Yang_Minta_Format1.MP4', 'asas', '1'),
(81, '', '3', 'Cara_Menyelamatkan_Data_Hardisk__Flashdisk_Minta_Format_Tanpa_Aplikasi1.MP4', 'asas', '1'),
(84, '214748365', '3', 'Cara_Menyelamatkan_Data_Hardisk__Flashdisk_Minta_Format_Tanpa_Aplikasi2.MP4', 'asa', '1'),
(85, '214748365', '3', 'Cara_Menyelamatkan_Data_Hardisk__Flashdisk_Minta_Format_Tanpa_Aplikasi3.MP4', 'asas', '1');

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
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `password`, `image`, `is_active`, `date_created`) VALUES
(48, '1', 'yusuf', '$2y$10$1.whR3iJHV/DB9../9.mFuDdyqeJvgdQDa9nhhVl4BC9aATaHlyK2', '', 1, '2021-08-28');

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

-- --------------------------------------------------------

--
-- Table structure for table `tugas_kelas`
--

CREATE TABLE `tugas_kelas` (
  `id` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
-- Indexes for table `kelas_kategori`
--
ALTER TABLE `kelas_kategori`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`);

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
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kelas_kategori`
--
ALTER TABLE `kelas_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `pilihan`
--
ALTER TABLE `pilihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tugas_kelas`
--
ALTER TABLE `tugas_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tugas_pertanyaan`
--
ALTER TABLE `tugas_pertanyaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
