-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 26, 2025 at 07:53 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beneranpaham`
--

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `matkul_id` int(11) NOT NULL,
  `matkul_name` varchar(50) NOT NULL,
  `dosen_name` varchar(50) NOT NULL,
  `sks` tinyint(3) UNSIGNED NOT NULL,
  `semester` tinyint(3) UNSIGNED NOT NULL,
  `matkul_desc` text NOT NULL,
  `jadwal_hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') NOT NULL,
  `jadwal_jam` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`matkul_id`, `matkul_name`, `dosen_name`, `sks`, `semester`, `matkul_desc`, `jadwal_hari`, `jadwal_jam`) VALUES
(1, 'Pemrograman Web', 'Pa Erick', 3, 3, 'Basicly belajar pemrograman web, html css js php dan projek projek ', 'Jumat', '08:00'),
(2, 'Sistem Database II', 'Pak Juli', 3, 3, 'Belajar mysql localhost database lanjutan dari database I (default : asyn)', 'Selasa', '07:30'),
(3, 'Aljabar Linear', 'Bu Sisil', 3, 3, 'my fav Varian mtk, matriks ga ribet dan lumayan mudah dipelajari (gaperlu waktu lama cuma perlu latihan)', 'Selasa', '13:00'),
(4, 'Matematika Diskrit', 'Pak Akik', 3, 3, 'idk bro, diawal mudah makin kesini ambil materi dari orarkom dan logif dan ga paham materi ambil dr itb', 'Selasa', '10:30'),
(5, 'Pemrograman Berorientasi Objek', 'Pak Akmal', 3, 3, 'Lanjutan dr alprog dan strukdat, whenever pak akmal is on duty means this topic needs grinding', 'Rabu', '07:30'),
(6, 'Entrepreuneurship', 'Pak Agus', 2, 3, 'Kinda interesting, tp basicly bisnis di informatika. awalnya ikan koi tapi makin kesini jadi ciwalk and interesting hmm', 'Rabu', '10:30'),
(7, 'Sistem Operasi', 'Pak Rudi', 3, 3, 'mempelajari os semua komputer, semoga menyenangkan', 'Rabu', '13:30'),
(8, 'Metode Numerik', 'Bu Helen', 3, 3, 'uhm, praktikum lumayan membantu tapi aku gatau gimana nilai nanti :)))', 'Kamis', '10:00');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `progress_id` int(11) NOT NULL,
  `absensi` tinyint(1) NOT NULL DEFAULT 1,
  `topik` varchar(100) NOT NULL,
  `topic_desc` varchar(255) NOT NULL,
  `status` enum('Online','Offline','Asynchronus') NOT NULL,
  `tugas` tinyint(1) NOT NULL,
  `jenis` enum('Kelas','Kuis','UTS','UAS') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `rating_materi` tinyint(4) NOT NULL,
  `rating_paham` tinyint(4) NOT NULL,
  `review` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  'email' varchar(40) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`matkul_id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`progress_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
  MODIFY `matkul_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
