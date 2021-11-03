-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2021 at 02:17 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoiceID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userIC` varchar(12) NOT NULL,
  `userPhone` varchar(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `pickupLocation` varchar(255) NOT NULL,
  `returnLocation` varchar(255) NOT NULL,
  `pickupDate` varchar(30) NOT NULL,
  `pickupTime` varchar(30) NOT NULL,
  `returnDate` varchar(30) NOT NULL,
  `returnTime` varchar(30) NOT NULL,
  `vehicleID` int(11) NOT NULL,
  `vehicleName` varchar(255) NOT NULL,
  `ownerName` varchar(50) NOT NULL,
  `vehicleType` varchar(255) NOT NULL,
  `vehiclePrice` int(11) NOT NULL,
  `OwnerPhoneNumber` varchar(11) NOT NULL,
  `payment` varchar(30) NOT NULL,
  `timerent` date NOT NULL,
  `rating` double NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoiceID`, `userID`, `userName`, `userIC`, `userPhone`, `userEmail`, `pickupLocation`, `returnLocation`, `pickupDate`, `pickupTime`, `returnDate`, `returnTime`, `vehicleID`, `vehicleName`, `ownerName`, `vehicleType`, `vehiclePrice`, `OwnerPhoneNumber`, `payment`, `timerent`, `rating`, `status`) VALUES
(5, 1, 'Kah Wei Oh', '001121070131', '0174985808', 'ohkahwei@gmail.com', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '2021-10-03', '19:08', '2021-10-03', '19:09', 3, 'Toyota Corolla Altis', 'Kah Wei Oh', 'Sedan', 25, '0174985808', 'CreditCard', '2021-10-03', 1, 'APPROVED'),
(6, 1, 'Kah Wei Oh', '001121070131', '0174985808', 'ohkahwei@gmail.com', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '2021-10-03', '07:11', '2021-10-10', '07:11', 3, 'Toyota Corolla Altis', 'Kah Wei Oh', 'Sedan', 25, '0174985808', 'CreditCard', '2021-10-03', 5, 'APPROVED'),
(7, 1, 'Oh Kah Wei', '001121070131', '0174985808', 'ohkahwei@gmail.com', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '2021-10-07', '17:46', '2021-10-07', '17:46', 3, 'Toyota Corolla Altis', 'Kah Wei Oh', 'Sedan', 25, '0174985808', 'Cash', '2021-10-07', 5, 'APPROVED'),
(8, 1, 'Oh Kah Wei', '001121070131', '0174985808', 'ohkahwei@gmail.com', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '2021-10-08', '23:15', '2021-10-08', '00:15', 3, 'Toyota Corolla Altis', 'Kah Wei Oh', 'Sedan', 25, '0174985808', 'Cash', '2021-10-08', 5, 'APPROVED'),
(9, 1, 'Oh Kah Wei', '001121070131', '0174985808', 'ohkahwei@gmail.com', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '2021-10-08', '23:16', '2021-10-08', '01:16', 3, 'Toyota Corolla Altis', 'Kah Wei Oh', 'Sedan', 25, '0174985808', 'FPX', '2021-10-08', 1, 'APPROVED'),
(10, 1, 'Oh Kah Wei', '001121070131', '0174985808', 'ohkahwei@gmail.com', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '2021-10-08', '23:19', '2021-10-23', '23:19', 1, 'Mazda CX-5', 'Kah Wei Oh', 'SUV', 40, '0174985808', 'Ewallet', '2021-10-08', 5, 'APPROVED'),
(11, 1, 'Oh Kah Wei', '001121070131', '0174985808', 'ohkahwei@gmail.com', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '2021-10-08', '23:21', '2021-10-24', '23:21', 1, 'Mazda CX-5', 'Kah Wei Oh', 'SUV', 40, '0174985808', 'Cash', '2021-10-08', 4, 'APPROVED'),
(12, 2, 'Marcus Khaw', '', '0174985808', 'wei-2000@live.com', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '2021-10-11', '16:52', '2021-10-11', '04:52', 5, 'HONDA City', 'Kah Wei Oh', 'Sedan', 35, '0174985808', 'Cash', '2021-10-11', 0, 'APPROVED'),
(13, 1, 'Oh Kah Wei', '001121070131', '0174985808', 'ohkahwei@gmail.com', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '2021-10-13', '15:34', '2021-10-14', '16:34', 3, 'Toyota Corolla Altis', 'Kah Wei Oh', 'Sedan', 25, '0174985808', 'Cash', '2021-10-13', 4, 'APPROVED'),
(14, 1, 'Oh Kah Wei', '001121070131', '0174985808', 'ohkahwei@gmail.com', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '2021-10-13', '16:04', '2021-10-14', '16:04', 3, 'Toyota Corolla Altis', 'Kah Wei Oh', 'Sedan', 25, '0174985808', 'Cash', '2021-10-13', 0, 'REJECTED'),
(15, 1, 'Oh Kah Wei', '001121070131', '0174985808', 'ohkahwei@gmail.com', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '2021-10-13', '17:09', '2021-10-13', '18:09', 3, 'Toyota Corolla Altis', 'Kah Wei Oh', 'Sedan', 25, '0174985808', 'Cash', '2021-10-13', 3, 'APPROVED'),
(16, 1, 'Oh Kah Wei', '001121070131', '0174985808', 'ohkahwei@gmail.com', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '1-Z, Lebuh Bukit Jambul, Bukit Jambul, 11900 Bayan Lepas, Pulau Pinang', '2021-10-13', '17:32', '2021-10-13', '17:32', 3, 'Toyota Corolla Altis', 'Kah Wei Oh', 'Sedan', 25, '0174985808', 'Cash', '2021-10-13', 0, 'APPROVED');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoiceID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
