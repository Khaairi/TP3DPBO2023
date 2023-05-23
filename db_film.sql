-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 01:02 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_film`
--

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE `director` (
  `director_id` int(11) NOT NULL,
  `director_nama` varchar(255) NOT NULL,
  `director_film` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`director_id`, `director_nama`, `director_film`) VALUES
(4, 'Christopher Nolan', 1),
(5, 'Joko Anwar', 1),
(6, 'Ari Aster', 2),
(7, 'Greta Gerwig', 1);

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `film_id` int(11) NOT NULL,
  `film_poster` varchar(255) NOT NULL,
  `film_nama` varchar(255) NOT NULL,
  `film_rilis` int(11) NOT NULL,
  `film_revenue` int(11) NOT NULL,
  `film_director` int(11) NOT NULL,
  `film_genre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`film_id`, `film_poster`, `film_nama`, `film_rilis`, `film_revenue`, `film_director`, `film_genre`) VALUES
(6, '482dc16f01a556eac8df92060440850a.jpg', 'Interstellar', 2010, 50000000, 4, 3),
(7, 'MoKha_Angels_and_Demons_abd86ecc-0049-40ce-9f52-d2182410a98e.png', 'Lady Bird', 2014, 2400000, 7, 7),
(8, 'MoKha_ancestors_gathering_in_the_holy_of_light_7bee5b15-9114-4d0e-b0d5-740fd3651185.png', 'Midsommar', 2020, 100000000, 6, 4),
(9, 'Sp3ak_Turbo_In_The_Name_Of_God_fc7fc637-8c78-40f2-b3d4-abfc361d7dcf.png', 'Pengabdi Setan', 2017, 47000000, 5, 4),
(10, 'MoKha_backroom_d0b2ee40-fc51-4349-b089-f1b0ea419632.png', 'Hereditary', 2020, 35000000, 6, 4);

--
-- Triggers `film`
--
DELIMITER $$
CREATE TRIGGER `AddDirector` AFTER INSERT ON `film` FOR EACH ROW BEGIN
	UPDATE director SET director_film = director_film + 1
    WHERE director_id = NEW.film_director;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AddGenre` AFTER INSERT ON `film` FOR EACH ROW BEGIN
	UPDATE genre SET genre_film = genre_film + 1
    WHERE genre_id = NEW.film_genre;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `deleteDirector` BEFORE DELETE ON `film` FOR EACH ROW BEGIN
	UPDATE director SET director_film = director_film - 1
    WHERE director_id = OLD.film_director;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `deleteGenre` BEFORE DELETE ON `film` FOR EACH ROW BEGIN
	UPDATE genre SET genre_film = genre_film - 1
    WHERE genre_id = OLD.film_genre;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `genre_nama` varchar(255) NOT NULL,
  `genre_film` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre_nama`, `genre_film`) VALUES
(3, 'Sci-fi', 1),
(4, 'Horror', 3),
(5, 'Action', 0),
(6, 'Romance', 0),
(7, 'Drama', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`director_id`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`film_id`),
  ADD KEY `film_director` (`film_director`),
  ADD KEY `film_genre` (`film_genre`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `director`
--
ALTER TABLE `director`
  MODIFY `director_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `film_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`film_director`) REFERENCES `director` (`director_id`),
  ADD CONSTRAINT `film_ibfk_2` FOREIGN KEY (`film_genre`) REFERENCES `genre` (`genre_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
