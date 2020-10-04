-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2020 at 05:31 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id12761061_repertoire`
--

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Hip Hop', 1582218916, 1582218916),
(2, 'Romantic', 1582219465, 1582219465),
(3, 'Classics', 1582219557, 1582219557),
(4, 'Rock', 1582657584, 1582657584),
(5, 'ANOS 60', 1588754001, 1588775068);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1582051127),
('m200218_122750_create_repertoire_runtime_table', 1582051131),
('m200218_122920_create_user_table', 1582051131),
('m200218_123549_create_genre_table', 1582051131),
('m200218_123820_create_songs_table', 1582051132),
('m200218_125305_create_requests_table', 1582051132),
('m200218_125540_create_request_songs_table', 1582051132),
('m200414_113900_add_song_cover_column_in_songs_table', 1586864626),
('m200416_095938_make_url_nullable_in_songs_Table', 1587031307),
('m200424_145609_add_artist_column_in_songs_table', 1587740284);

-- --------------------------------------------------------

--
-- Table structure for table `repertoire_runtime`
--

CREATE TABLE `repertoire_runtime` (
  `id` int(11) NOT NULL,
  `runtime` varchar(255) DEFAULT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `repertoire_runtime`
--

INSERT INTO `repertoire_runtime` (`id`, `runtime`, `created_at`, `updated_at`) VALUES
(1, '1100', 1582224658, 1587580869);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `total_runtime` varchar(10) NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `full_name`, `email`, `contact`, `total_runtime`, `created_at`, `updated_at`) VALUES
(8, 'Shan', 'shan@gmail.com', '0998765432', '09:30', 1582827268, 1582827268),
(9, 'afraz', 'afrazafaq96@gmail.com', '(34) 23423-4324', '003:2', 1583951711, 1583951711),
(10, 'afraz', 'afrazafaq96@gmail.com', '(34) 23432-4324', '003:2', 1583952295, 1583952295),
(11, 'afraz', 'afrazafaq96@gmail.com', '(34) 23432-4324', '003:2', 1583952423, 1583952423),
(12, 'afraz', 'afrazafaq96@gmail.com', '(34) 23432-4324', '003:2', 1583952530, 1583952530),
(13, 'afraz', 'afrazafaq96@gmail.com', '(34) 23432-4324', '003:2', 1583952656, 1583952656),
(14, 'afraz', 'afrazafaq96@gmail.com', '(34) 23432-4324', '003:2', 1583952792, 1583952792),
(15, 'afraz', 'afrazafaq96@gmail.com', '(34) 23432-4324', '003:2', 1583953842, 1583953842),
(16, 'afraz', 'afrazafaq96@gmail.com', '(34) 23432-4324', '003:2', 1583954427, 1583954427),
(17, 'afraz', 'afrazafaq96@gmail.com', '(34) 23432-4324', '003:2', 1583954578, 1583954578),
(18, 'Shan', 'afrazafaq96@gmail.com', '(23) 12321-3123', '003:2', 1584033786, 1584033786),
(19, 'Shan', 'afrazafaq96@gmail.com', '(23) 12321-3123', '003:2', 1584033882, 1584033882),
(20, 'Test Name', 'afrazafaq96@gmail.com', '(34) 23432-4324', '007:0', 1584033937, 1584033937),
(21, 'Shan', 'afrazafaq96@gmail.com', '(34) 23432-4324', '003:2', 1584036864, 1584036864),
(22, 'Shan', 'afrazafaq96@gmail.com', '(33) 24234-3243', '003:2', 1584037183, 1584037183),
(23, 'Shan', 'afrazafaq96@gmail.com', '(42) 34234-3243', '003:4', 1584037364, 1584037364),
(24, 'Denia', 'afrazafaq96@gmail.com', '(32) 42342-3432', '003:2', 1584037554, 1584037554),
(25, 'Denia', 'afrazafaq96@gmail.com', '(32) 42342-3432', '003:2', 1584037571, 1584037571);

-- --------------------------------------------------------

--
-- Table structure for table `request_songs`
--

CREATE TABLE `request_songs` (
  `id` int(11) NOT NULL,
  `request_id` int(11) DEFAULT NULL,
  `song_id` int(11) DEFAULT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `artist` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `link_name` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `genre_id` int(11) NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `name`, `artist`, `url`, `link_name`, `duration`, `genre_id`, `created_at`, `updated_at`) VALUES
(23, 'A hard day\'s night', 'The Beatles', '', 'a', '20', 5, 1589398715, 1589398715),
(26, 'Aadat', 'Atif Aslam', '', '123', '300', 1, 1589650157, 1589650157);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'repertorio@bandamega.com.br', '$2y$13$VSl30B/Qy2Y7AFwoHpSsre5lLU/8GofqczcdceYjaOcPV3JxawYEi', 123456788, 1584037311);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `repertoire_runtime`
--
ALTER TABLE `repertoire_runtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_songs`
--
ALTER TABLE `request_songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-requests-request_id` (`request_id`),
  ADD KEY `idx-songs-song_id` (`song_id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-genre_id` (`genre_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `repertoire_runtime`
--
ALTER TABLE `repertoire_runtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `request_songs`
--
ALTER TABLE `request_songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request_songs`
--
ALTER TABLE `request_songs`
  ADD CONSTRAINT `fk-requests-request_id` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-songs-song_id` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `fk-idx-genre_id` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
