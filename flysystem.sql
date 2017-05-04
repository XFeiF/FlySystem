-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 12, 2017 at 03:03 PM
-- Server version: 5.6.28
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `flysystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `fly_airlines`
--

CREATE TABLE `fly_airlines` (
  `airlineID` int(32) NOT NULL,
  `airlineName` varchar(100) NOT NULL,
  `beforeIncome` int(50) DEFAULT NULL,
  `afterIncome` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fly_airlines`
--

INSERT INTO `fly_airlines` (`airlineID`, `airlineName`, `beforeIncome`, `afterIncome`) VALUES
(1, '南方航空公司', NULL, NULL),
(2, '海南航空公司', NULL, NULL),
(3, '东方航空公司', NULL, NULL),
(4, '国泰航空公司', NULL, NULL),
(5, '深圳航空公司', NULL, NULL),
(6, '厦门航空公司', NULL, NULL),
(7, '吉祥航空公司', NULL, NULL),
(8, '中华航空公司', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fly_flightlines`
--

CREATE TABLE `fly_flightlines` (
  `flightName` varchar(50) NOT NULL,
  `departure` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `timeOfFly` time NOT NULL,
  `timeOfArrival` time NOT NULL,
  `airlineID` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fly_flightlines`
--

INSERT INTO `fly_flightlines` (`flightName`, `departure`, `destination`, `timeOfFly`, `timeOfArrival`, `airlineID`) VALUES
('AA4110', '南京禄口国际机场T2', '北京首都国际机场T2', '09:00:00', '10:40:00', 3),
('CA1111', '包头海兰泡机场T1', '保山保山机场T2', '12:00:00', '14:20:00', 6),
('CZ9400', '长沙黄花国际机场T2', '上海浦东国际机场T1', '00:00:00', '01:20:00', 3),
('HU7815', '长沙黄花国际机场T2', '上海浦东国际机场T2', '08:00:00', '09:20:00', 2),
('KK4910', '北京首都国际机场T2', '南京禄口国际机场T2', '11:00:00', '12:30:00', 7),
('MU5368', '长沙黄花国际机场T2', '上海虹桥国际机场T2', '14:00:00', '15:20:00', 1),
('VA0001', '北京首都国际机场T2', '上海浦东国际机场T1', '12:00:00', '13:20:00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `fly_flights`
--

CREATE TABLE `fly_flights` (
  `flightID` int(32) NOT NULL,
  `flightName` varchar(50) NOT NULL,
  `dateOfDeparture` date NOT NULL,
  `dateOfArrival` date NOT NULL,
  `price` int(20) NOT NULL,
  `ticketNum` int(20) NOT NULL,
  `ticketLeftNum` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fly_flights`
--

INSERT INTO `fly_flights` (`flightID`, `flightName`, `dateOfDeparture`, `dateOfArrival`, `price`, `ticketNum`, `ticketLeftNum`) VALUES
(1, 'MU5368', '2017-03-24', '2017-03-24', 360, 250, 250),
(2, 'HU7815', '2017-03-30', '2017-03-30', 250, 250, 249),
(3, 'CZ9400', '2017-03-28', '2017-03-28', 480, 180, 180),
(5, 'KK4910', '2017-04-22', '2017-04-22', 960, 100, 99),
(6, 'AA4110', '2017-04-25', '2017-04-25', 480, 200, 199),
(7, 'CA1111', '2017-05-01', '2017-05-01', 668, 100, 100),
(8, 'VA0001', '2017-05-03', '2017-05-03', 888, 100, 100);

-- --------------------------------------------------------

--
-- Table structure for table `fly_orders`
--

CREATE TABLE `fly_orders` (
  `orderID` int(32) NOT NULL,
  `userID` int(32) NOT NULL,
  `flightID` int(32) NOT NULL,
  `status` varchar(50) NOT NULL,
  `isPaid` tinyint(1) DEFAULT '0',
  `isCheckin` tinyint(1) DEFAULT '0',
  `paydate` date DEFAULT NULL,
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fly_orders`
--

INSERT INTO `fly_orders` (`orderID`, `userID`, `flightID`, `status`, `isPaid`, `isCheckin`, `paydate`, `createtime`) VALUES
(1, 2, 6, '已取票', 1, 1, '2017-04-12', '2017-04-12 11:46:41'),
(2, 2, 2, '已付款', 1, 0, '2017-04-12', '2017-04-12 11:48:18'),
(3, 2, 5, '已预订', 0, 0, NULL, '2017-04-12 11:48:34');

-- --------------------------------------------------------

--
-- Table structure for table `fly_users`
--

CREATE TABLE `fly_users` (
  `userID` int(32) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userPhone` varchar(20) NOT NULL,
  `userPassword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fly_users`
--

INSERT INTO `fly_users` (`userID`, `userName`, `userPhone`, `userPassword`) VALUES
(1, 'Suzukaze', '17673042317', 'e10adc3949ba59abbe56e057f20f883e'),
(2, '李强', '17673042000', 'e10adc3949ba59abbe56e057f20f883e'),
(3, '刘奇', '17673042001', 'e10adc3949ba59abbe56e057f20f883e'),
(4, '冯星博', '17673042002', 'e10adc3949ba59abbe56e057f20f883e'),
(5, ' 薛飞飞', '17673042003', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `fly_usersinfo`
--

CREATE TABLE `fly_usersinfo` (
  `userIDCard` varchar(18) NOT NULL,
  `userID` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fly_airlines`
--
ALTER TABLE `fly_airlines`
  ADD PRIMARY KEY (`airlineID`);

--
-- Indexes for table `fly_flightlines`
--
ALTER TABLE `fly_flightlines`
  ADD PRIMARY KEY (`flightName`),
  ADD KEY `line2company` (`airlineID`) USING BTREE;

--
-- Indexes for table `fly_flights`
--
ALTER TABLE `fly_flights`
  ADD PRIMARY KEY (`flightID`),
  ADD KEY `flight2line` (`flightName`) USING BTREE;

--
-- Indexes for table `fly_orders`
--
ALTER TABLE `fly_orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `order2user` (`userID`) USING BTREE,
  ADD KEY `order2flight` (`flightID`) USING BTREE;

--
-- Indexes for table `fly_users`
--
ALTER TABLE `fly_users`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `fly_usersinfo`
--
ALTER TABLE `fly_usersinfo`
  ADD PRIMARY KEY (`userIDCard`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fly_airlines`
--
ALTER TABLE `fly_airlines`
  MODIFY `airlineID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `fly_flights`
--
ALTER TABLE `fly_flights`
  MODIFY `flightID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `fly_orders`
--
ALTER TABLE `fly_orders`
  MODIFY `orderID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `fly_users`
--
ALTER TABLE `fly_users`
  MODIFY `userID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `fly_flights`
--
ALTER TABLE `fly_flights`
  ADD CONSTRAINT `flight2line` FOREIGN KEY (`flightName`) REFERENCES `fly_flightlines` (`flightName`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `fly_orders`
--
ALTER TABLE `fly_orders`
  ADD CONSTRAINT `fly_order2flight` FOREIGN KEY (`flightID`) REFERENCES `fly_flights` (`flightID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fly_order2user` FOREIGN KEY (`userID`) REFERENCES `fly_users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
