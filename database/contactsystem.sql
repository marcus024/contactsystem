-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2024 at 12:51 PM
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
-- Database: `contactsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactdetails`
--

CREATE TABLE `contactdetails` (
  `name` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactdetails`
--

INSERT INTO `contactdetails` (`name`, `emailAddress`, `password`, `confirmPassword`) VALUES
('Akira', 'akira@gmail.com', '$2y$10$WHUWkWr02jlAxXd207dBTecJ0Fv6iZq228Av9n2vabqbswDr8jRdC', '$2y$10$WHUWkWr02jlAxXd207dBTecJ0Fv6iZq228Av9n2vabqbswDr8jRdC'),
('bendo', 'calipayan@ssu.edu.ph', '$2y$10$lfLDy0o5VnnIHyCVoruWkOuoPwdlNWWmLItVJS5.aS34LfVx5P0XG', '$2y$10$lfLDy0o5VnnIHyCVoruWkOuoPwdlNWWmLItVJS5.aS34LfVx5P0XG'),
('Christina', 'christina@gmail.com', '$2y$10$sU0OYETkwZ71D4y1G6tzf.WJ6w5Rw1eX2tqAag39kyTFpX22xnZue', '$2y$10$sU0OYETkwZ71D4y1G6tzf.WJ6w5Rw1eX2tqAag39kyTFpX22xnZue'),
('Mark Antony Calipayan', 'john@gmail.com', '$2y$10$zPa5UkAKNf2OyW3DOn618euumJX6vMYgiBxiug1oEiLnKLHFa0IPy', '$2y$10$zPa5UkAKNf2OyW3DOn618euumJX6vMYgiBxiug1oEiLnKLHFa0IPy'),
('Marcus', 'marcus@gmail.com', '$2y$10$PIOdPvRpG6EuZTX2hFlxFeCN6P1Ide2XUB/Ii.i4iicr1mcw.igIu', '$2y$10$PIOdPvRpG6EuZTX2hFlxFeCN6P1Ide2XUB/Ii.i4iicr1mcw.igIu'),
('Mark', 'mark@gmail.com', '$2y$10$nrJXRYGLeiyBfo7Nyaf51upGcLR6qPGOJxle7zpvFWROUvpyrsho6', '$2y$10$nrJXRYGLeiyBfo7Nyaf51upGcLR6qPGOJxle7zpvFWROUvpyrsho6'),
('marcusxxx24', 'markantony.calipayan@ssu.edu.ph', '$2y$10$Ukcw93Vc6DEJS7.q6h1tIuWK7RscH9P4dWAW.bQsN0vO7Y2wazNsS', '$2y$10$Ukcw93Vc6DEJS7.q6h1tIuWK7RscH9P4dWAW.bQsN0vO7Y2wazNsS'),
('Silverio Calipayan', 'silverio@gmail.com', '$2y$10$XLGLB.jNxzWXg8bVGDtg3egXsrMBAwS7VLH7rdWHNZbCdsWIGLkUq', '$2y$10$XLGLB.jNxzWXg8bVGDtg3egXsrMBAwS7VLH7rdWHNZbCdsWIGLkUq');

-- --------------------------------------------------------

--
-- Table structure for table `contactinfo`
--

CREATE TABLE `contactinfo` (
  `contact_id` int(11) NOT NULL,
  `contactName` varchar(255) NOT NULL,
  `contactEmail` varchar(255) NOT NULL,
  `contactCompany` varchar(255) NOT NULL,
  `contactPhone` int(22) NOT NULL,
  `emailFK` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactinfo`
--

INSERT INTO `contactinfo` (`contact_id`, `contactName`, `contactEmail`, `contactCompany`, `contactPhone`, `emailFK`) VALUES
(1, 'Mark Anthony Calipayan', 'markantony.calipayan@ssu.edu.ph', 'accenture', 2147483647, 'akira@gmail.com'),
(2, 'Silverio Versoza', 'ff@gmail.com', 'concentrix', 2147483647, 'silverio@gmail.com'),
(3, 'veronica calipayan', 'markantony.calipayan@ssu.edu.ph', 'asdsdfa', 2147483647, 'silverio@gmail.com'),
(4, 'Mark Antony Calipayan', 'markantonyvc01@gmail.com', 'dsfdsf', 2147483647, 'silverio@gmail.com'),
(7, 'veronica calipayan', 'markantony.calipayan@ssu.edu.ph', 'dsfsd', 2147483647, 'marcus@gmail.com'),
(9, 'Mark Antony Calipayan', 'markantonyvc01@gmail.com', 'concentrix', 2147483647, 'marcus@gmail.com'),
(10, 'sdf', 'markantony.calipayan@ssu.edu.ph', 'accenture', 2147483647, 'marcus@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactdetails`
--
ALTER TABLE `contactdetails`
  ADD UNIQUE KEY `1` (`emailAddress`);

--
-- Indexes for table `contactinfo`
--
ALTER TABLE `contactinfo`
  ADD PRIMARY KEY (`contact_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactinfo`
--
ALTER TABLE `contactinfo`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
