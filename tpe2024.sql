-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2024 at 11:28 PM
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
-- Database: `tpe2024`
--

-- --------------------------------------------------------

--
-- Table structure for table `generos`
--

CREATE TABLE `generos` (
  `ID_Genero` int(11) NOT NULL,
  `Nombre` varchar(250) NOT NULL,
  `Descripción` varchar(250) NOT NULL,
  `clasificacion_por_edad` varchar(255) DEFAULT 'Sin clasificar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `generos`
--

INSERT INTO `generos` (`ID_Genero`, `Nombre`, `Descripción`, `clasificacion_por_edad`) VALUES
(1, 'Acción', 'Acción. Generalmente son películas que aportan un toque de adrenalina. Incluyen acrobacias físicas, persecuciones rescates y batallas, lo que las caracteriza principalmente.', 'Sin clasificar'),
(3, 'Drama', 'Drama is the specific mode of fiction represented in performance: a play, opera, mime, ballet, etc., performed in a theatre, or on radio or television. ', 'Sin clasificar'),
(4, 'Terror', 'género que pretende o tiene la capacidad de asustar, causar miedo o aterrorizar sus lectores o espectadores e inducir sentimientos de horror y terror.', 'Sin clasificar'),
(5, 'Ciencia ficcion', 'Science fiction is a genre of speculative fiction, which typically deals with imaginative and futuristic concepts such as advanced science and technology, space exploration, time travel, parallel universes, and extraterrestrial life. It is related to', 'Sin clasificar');

-- --------------------------------------------------------

--
-- Table structure for table `peliculas`
--

CREATE TABLE `peliculas` (
  `ID_pelicula` int(11) NOT NULL,
  `Titulo` varchar(250) NOT NULL,
  `Director` varchar(250) NOT NULL,
  `Anio` int(11) NOT NULL,
  `ID_Genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peliculas`
--

INSERT INTO `peliculas` (`ID_pelicula`, `Titulo`, `Director`, `Anio`, `ID_Genero`) VALUES
(1, 'Rapidos y Furiosos 5', 'Justin Lin', 2011, 1),
(2, 'The Whale', 'Darren Aronofsky', 2022, 3),
(3, 'La Bruja de Blair', 'Adam Wingard', 2016, 4),
(4, 'Interestellar', 'Christopher Nolan', 2014, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`ID_Genero`);

--
-- Indexes for table `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`ID_pelicula`),
  ADD KEY `ID_Generofk` (`ID_Genero`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `generos`
--
ALTER TABLE `generos`
  MODIFY `ID_Genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `ID_pelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peliculas`
--
ALTER TABLE `peliculas`
  ADD CONSTRAINT `peliculas_ibfk_1` FOREIGN KEY (`ID_Genero`) REFERENCES `generos` (`ID_Genero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
