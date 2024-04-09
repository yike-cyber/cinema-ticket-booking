-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2023 at 10:00 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `answer` varchar(50) NOT NULL,
  `questionId` int(11) DEFAULT NULL,
  `role` varchar(15) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `fname`, `lname`, `email`, `password`, `answer`, `questionId`, `role`, `gender`, `phone`) VALUES
(15, 'yikeber', 'misganaw', 'www.admin@gmail.com', 'ADMIN123', 'bahirdar', 1, 'admin', 'male', 946472687),
(16, 'solomon', 'haile', 'www.selomon@gmail.com', 'ADMIN123', '', NULL, 'admin', 'male', 937406498);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentId` int(11) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `sentDate` date NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentId`, `description`, `sentDate`, `userId`, `status`) VALUES
(27, 'this is the  first comment', '2023-07-30', 13, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `gener`
--

CREATE TABLE `gener` (
  `generId` int(11) NOT NULL,
  `generName` varchar(15) NOT NULL,
  `roomName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gener`
--

INSERT INTO `gener` (`generId`, `generName`, `roomName`) VALUES
(1, 'action', 'action room'),
(2, 'comedy', 'comedy room');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `movieId` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `duration` varchar(10) NOT NULL,
  `language` varchar(15) NOT NULL,
  `Date` date NOT NULL,
  `actor` varchar(100) NOT NULL,
  `country` varchar(20) NOT NULL,
  `director` varchar(30) NOT NULL,
  `rating` varchar(15) NOT NULL,
  `generId` int(11) DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `filetype` varchar(50) NOT NULL,
  `trailer` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`movieId`, `title`, `description`, `duration`, `language`, `Date`, `actor`, `country`, `director`, `rating`, `generId`, `filename`, `filepath`, `filetype`, `trailer`) VALUES
(1, 'ete', '', '3:00', '', '0000-00-00', 'yike,xamd', 'USA', 'tusi', '', NULL, '', '', '', ''),
(2, 'ehdfhdfodi', '', '3:00', '', '0000-00-00', 'yike,xamd', 'USA', 'tusi', '', NULL, 'csscsc.jpg', 'movies/csscsc.jpg', 'image/jpeg', ''),
(3, 'eerhehrehh', 'eerer3 ', '3:00', 'Amharic', '0000-00-00', 'semanda', 'india', 'tusi', '4', 1, 'photocccc.jpg', 'movies/photocccc.jpg', 'image/jpeg', ''),
(4, 'ryyeyryeyy', 'eyyeyryy4y', '3:00', 'English', '0000-00-00', 'yike,xamd', 'USA', 'tusi', '5', 1, 'first page.PNG', 'movies/first page.PNG', 'image/png', 'http://youtube.com'),
(5, 'rhrhhrhh', 'rrn4hhrhh', '3:00', 'English', '2023-07-03', 'yike,xamd', 'india', 'yike', '5', 1, 'about me.PNG', 'movies/about me.PNG', 'image/png', 'http://youtube.com'),
(7, 'tyey9884', 'ehhreh', '2:00', 'English', '2023-06-28', 'john stones,sansa,arian', 'England', '', '5', 1, 'photocccc.jpg', 'movies/photocccc.jpg', 'image/jpeg', 'http://www.bahirdarcinema.com'),
(8, 'yyyy', 'this is the last discription   ', '2:00', 'English', '2023-07-05', 'john stones,sansa,arian', 'England', 'johny and xruze', '5', 1, 'my educataon.PNG', 'movies/my educataon.PNG', 'image/png', 'http://www.bahirdarcinema.com'),
(9, 'yikeer', 'this is the last description                       ', '2:00', 'English', '2023-07-06', 'john stones,sansa,arian', 'England', 'johny and yike', '5', 1, 'photocccc.jpg', 'movies/photocccc.jpg', 'image/jpeg', 'http://www.bahirdarcinema.com');

-- --------------------------------------------------------

--
-- Table structure for table `movieshow`
--

CREATE TABLE `movieshow` (
  `showId` int(11) NOT NULL,
  `showDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `movieId` int(11) DEFAULT NULL,
  `roomId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movieshow`
--

INSERT INTO `movieshow` (`showId`, `showDate`, `startTime`, `endTime`, `movieId`, `roomId`) VALUES
(2, '2023-07-27', '21:19:00', '21:24:00', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notifId` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(200) NOT NULL,
  `sentDate` datetime NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomId` int(11) NOT NULL,
  `roomName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomId`, `roomName`) VALUES
(1, 'action room'),
(2, 'drama room'),
(3, 'comedy room'),
(4, 'tragedy room');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `seatId` int(11) NOT NULL,
  `rowNumber` int(11) NOT NULL,
  `isAvailable` tinyint(1) NOT NULL,
  `availableSeat` int(11) NOT NULL,
  `showId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `securityquestion`
--

CREATE TABLE `securityquestion` (
  `questionId` int(11) NOT NULL,
  `question` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `securityquestion`
--

INSERT INTO `securityquestion` (`questionId`, `question`) VALUES
(1, 'where were you born ?'),
(2, 'what is the name of your high school ?'),
(3, 'what is the name of your mother?');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticketId` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `numberOfSeats` int(11) NOT NULL,
  `seatNumber` int(11) NOT NULL,
  `ticketPrice` double NOT NULL,
  `isPaid` tinyint(1) NOT NULL,
  `purchaseDate` date NOT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transactionId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `showId` int(11) DEFAULT NULL,
  `seatId` int(11) DEFAULT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `balance` double NOT NULL,
  `gender` varchar(7) NOT NULL,
  `phone` int(11) NOT NULL,
  `questionId` int(11) DEFAULT NULL,
  `answer` varchar(30) NOT NULL,
  `notId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `fname`, `lname`, `email`, `password`, `balance`, `gender`, `phone`, `questionId`, `answer`, `notId`) VALUES
(12, 'yike', 'misganaw', 'www.yike@gmail.com', 'USER123', 31066, 'male', 946472687, 3, 'Aregash', 0),
(13, 'selam', 'tesfaye', 'www.selam@gmail.com', 'USER123', 500, 'female', 9988888, 2, 'ghion', 0),
(14, 'yikeber', 'misganaw', 'www.sol@gmail.com', '123', 0, 'male', 2147483647, NULL, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`),
  ADD KEY `questionId` (`questionId`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `gener`
--
ALTER TABLE `gener`
  ADD PRIMARY KEY (`generId`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movieId`),
  ADD KEY `generId` (`generId`);

--
-- Indexes for table `movieshow`
--
ALTER TABLE `movieshow`
  ADD PRIMARY KEY (`showId`),
  ADD KEY `movieId` (`movieId`),
  ADD KEY `roomId` (`roomId`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notifId`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomId`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`seatId`),
  ADD KEY `showId` (`showId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `securityquestion`
--
ALTER TABLE `securityquestion`
  ADD PRIMARY KEY (`questionId`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticketId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `showId` (`showId`),
  ADD KEY `seatId` (`seatId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `questionId` (`questionId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `gener`
--
ALTER TABLE `gener`
  MODIFY `generId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `movieId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `movieshow`
--
ALTER TABLE `movieshow`
  MODIFY `showId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notifId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `seatId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `securityquestion`
--
ALTER TABLE `securityquestion`
  MODIFY `questionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticketId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `securityquestion` (`questionId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`generId`) REFERENCES `gener` (`generId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movieshow`
--
ALTER TABLE `movieshow`
  ADD CONSTRAINT `movieshow_ibfk_2` FOREIGN KEY (`movieId`) REFERENCES `movie` (`movieId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movieshow_ibfk_3` FOREIGN KEY (`roomId`) REFERENCES `room` (`roomId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seat`
--
ALTER TABLE `seat`
  ADD CONSTRAINT `seat_ibfk_1` FOREIGN KEY (`showId`) REFERENCES `movieshow` (`showId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seat_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`showId`) REFERENCES `movieshow` (`showId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`seatId`) REFERENCES `seat` (`seatId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `securityquestion` (`questionId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
