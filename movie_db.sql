-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2026 at 01:17 PM
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
-- Database: `movie_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(2, 'admin', '$2y$10$WWkynzW8FzoiefRxba.PK.SSg9ckgy28XbsCwa93OQ5KyFmU1vYI2', '2026-01-28 09:53:15');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `year` int(11) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `rating` decimal(2,1) DEFAULT 0.0,
  `description` text DEFAULT NULL,
  `cast` varchar(255) DEFAULT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `year`, `genre`, `rating`, `description`, `cast`, `poster`, `created_at`) VALUES
(2, 'The Godfather', 1972, 'Crime', 9.2, 'The aging patriarch of an organized crime dynasty transfers control.', 'Marlon Brando, Al Pacino', '6979e59e37aa0_1769596318.jpg', '2026-01-28 09:36:56'),
(3, 'The Dark Knight', 2008, 'Action', 9.0, 'Batman faces the Joker in Gotham City. Joker just wins your heart.', 'Christian Bale, Heath Ledger', '6979e91081166_1769597200.jpg', '2026-01-28 09:36:56'),
(5, 'Pulp Fiction', 1994, 'Crime', 8.9, 'The lives of two mob hitmen, a boxer, a gangster and his wife intertwine in four tales of violence and redemption.', 'John Travolta, Uma Thurman, Samuel L. Jackson', '6979e763aa7cd_1769596771.jpg', '2026-01-28 10:35:38'),
(6, 'Forrest Gump', 1994, 'Drama', 8.8, 'The presidencies of Kennedy and Johnson unfold through the perspective of an Alabama man with an IQ of 75.', 'Tom Hanks, Robin Wright, Gary Sinise', '6979e7a94405d_1769596841.jpg', '2026-01-28 10:35:38'),
(7, 'Inception', 2010, 'Sci-Fi', 8.8, 'A thief who steals corporate secrets through dream-sharing technology is given the inverse task of planting an idea.', 'Leonardo DiCaprio, Joseph Gordon-Levitt, Ellen Page', '6979e7f67dcdf_1769596918.jpg', '2026-01-28 10:35:38'),
(8, 'The Matrix', 1999, 'Sci-Fi', 8.7, 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.', 'Keanu Reeves, Laurence Fishburne, Carrie-Anne Moss', '6979e85a4b82e_1769597018.jpg', '2026-01-28 10:35:38'),
(9, 'Goodfellas', 1990, 'Crime', 8.7, 'The story of Henry Hill and his life in the mob, covering his relationship with his wife Karen Hill and his mob partners.', 'Robert De Niro, Ray Liotta, Joe Pesci', '6979e88c6da81_1769597068.jpg', '2026-01-28 10:35:38'),
(10, 'The Silence of the Lambs', 1991, 'Thriller', 8.6, 'A young FBI cadet must receive the help of an incarcerated cannibal killer to catch another serial killer.', 'Jodie Foster, Anthony Hopkins, Lawrence A. Bonney', '6979eca260339_1769598114.jpg', '2026-01-28 10:35:38'),
(11, 'Saving Private Ryan', 1998, 'War', 8.6, 'Following the Normandy Landings, a group of soldiers go behind enemy lines to retrieve a paratrooper whose brothers have been killed.', 'Tom Hanks, Matt Damon, Tom Sizemore', '6979ecd46383f_1769598164.jpg', '2026-01-28 10:35:38'),
(12, 'Interstellar', 2014, 'Sci-Fi', 8.6, 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity survival.', 'Matthew McConaughey, Anne Hathaway, Jessica Chastain', '6979e9e13f318_1769597409.jpg', '2026-01-28 10:35:38'),
(13, 'The Green Mile', 1999, 'Drama', 8.6, 'The lives of guards on Death Row are affected by one of their charges: a black man accused of child murder who has a mysterious gift.', 'Tom Hanks, Michael Clarke Duncan, David Morse', '6979ede552acc_1769598437.jpg', '2026-01-28 10:35:38'),
(14, 'Gladiator', 2000, 'Action', 8.5, 'A former Roman General sets out to exact vengeance against the corrupt emperor who murdered his family and sent him into slavery.', 'Russell Crowe, Joaquin Phoenix, Connie Nielsen', 'default.jpg', '2026-01-28 10:35:38'),
(15, 'The Departed', 2006, 'Crime', 8.5, 'An undercover cop and a mole in the police attempt to identify each other while infiltrating an Irish gang in Boston.', 'Leonardo DiCaprio, Matt Damon, Jack Nicholson', '6979ed3933cb9_1769598265.jpg', '2026-01-28 10:35:38'),
(16, 'The Prestige', 2006, 'Mystery', 8.5, 'After a tragic accident, two stage magicians engage in a battle to create the ultimate illusion while sacrificing everything.', 'Christian Bale, Hugh Jackman, Scarlett Johansson', '6979ed8deb9b0_1769598349.jpg', '2026-01-28 10:35:38'),
(17, 'Whiplash', 2014, 'Drama', 8.5, 'A promising young drummer enrolls at a cut-throat music conservatory where his dreams are mentored by an instructor.', 'Miles Teller, J.K. Simmons, Melissa Benoist', '6979edb919f19_1769598393.jpg', '2026-01-28 10:35:38'),
(18, 'The Avengers', 2012, 'Action', 8.0, 'Earth mightiest heroes must come together to stop Loki and his alien army from enslaving humanity.', 'Robert Downey Jr., Chris Evans, Scarlett Johansson', '6979ec3c66d63_1769598012.jpg', '2026-01-28 10:35:38'),
(19, 'Joker', 2019, 'Drama', 8.4, 'In Gotham City, mentally troubled comedian Arthur Fleck is disregarded and mistreated by society.', 'Joaquin Phoenix, Robert De Niro, Zazie Beetz', '6979ec151bbbe_1769597973.jpg', '2026-01-28 10:35:38'),
(20, 'Parasite', 2019, 'Thriller', 8.6, 'Greed and class discrimination threaten the newly formed symbiotic relationship between the wealthy Park family and the destitute Kim clan.', 'Song Kang-ho, Lee Sun-kyun, Cho Yeo-jeong', 'default.jpg', '2026-01-28 10:35:38'),
(21, '1917', 2019, 'War', 8.3, 'Two British soldiers are given a seemingly impossible mission to deliver a message deep in enemy territory.', 'Dean-Charles Chapman, George MacKay, Daniel Mays', '6979eab022a1b_1769597616.jpg', '2026-01-28 10:35:38'),
(22, 'Django Unchained', 2012, 'Western', 8.4, 'With the help of a German bounty hunter, a freed slave sets out to rescue his wife from a brutal Mississippi plantation owner.', 'Jamie Foxx, Christoph Waltz, Leonardo DiCaprio', '6979ea6732ec4_1769597543.jpg', '2026-01-28 10:35:38'),
(23, 'Coco', 2017, 'Animation', 8.4, 'Aspiring musician Miguel enters the Land of the Dead to find his great-great-grandfather, a legendary singer.', 'Anthony Gonzalez, Gael García Bernal, Benjamin Bratt', '6979ea2dbb84b_1769597485.jpg', '2026-01-28 10:35:38'),
(24, 'Toy Story', 1995, 'Animation', 8.3, 'A cowboy doll is profoundly threatened when a new spaceman figure supplants him as top toy in a boy room.', 'Tom Hanks, Tim Allen, Don Rickles', '6979e97903137_1769597305.jpeg', '2026-01-28 10:35:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
