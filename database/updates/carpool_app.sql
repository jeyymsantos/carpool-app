-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2023 at 07:27 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carpool_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `book_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_seat_location` varchar(20) NOT NULL,
  `book_pickup_barangay` varchar(255) NOT NULL,
  `book_pickup_city` varchar(255) NOT NULL,
  `book_pickup_province` varchar(255) NOT NULL,
  `book_pickup_description` varchar(255) DEFAULT NULL,
  `book_driver_confirmation` tinyint(1) DEFAULT NULL,
  `book_passenger_confirmation` tinyint(1) DEFAULT NULL,
  `book_status` varchar(20) NOT NULL,
  `book_driver_confirmed_at` timestamp NULL DEFAULT NULL,
  `book_passenger_confirmed_at` timestamp NULL DEFAULT NULL,
  `book_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_field_office` varchar(256) NOT NULL,
  `car_office_code` varchar(256) NOT NULL,
  `car_receipt_no` varchar(256) NOT NULL,
  `car_tin_no` varchar(256) DEFAULT NULL,
  `car_plate_no` char(9) NOT NULL,
  `car_model` varchar(20) NOT NULL,
  `car_color` varchar(20) NOT NULL,
  `car_brand` varchar(20) NOT NULL,
  `car_classification` varchar(256) NOT NULL,
  `car_engine_no` varchar(256) NOT NULL,
  `car_chassis_no` varchar(256) NOT NULL,
  `car_year` char(4) NOT NULL,
  `car_type` varchar(256) NOT NULL,
  `car_category` varchar(256) NOT NULL,
  `car_fuel` varchar(256) NOT NULL,
  `car_rejected` tinyint(1) NOT NULL,
  `car_renewal_date` timestamp NULL DEFAULT NULL,
  `car_confirmed_at` timestamp NULL DEFAULT NULL,
  `car_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `user_id`, `car_field_office`, `car_office_code`, `car_receipt_no`, `car_tin_no`, `car_plate_no`, `car_model`, `car_color`, `car_brand`, `car_classification`, `car_engine_no`, `car_chassis_no`, `car_year`, `car_type`, `car_category`, `car_fuel`, `car_rejected`, `car_renewal_date`, `car_confirmed_at`, `car_created_at`) VALUES
(7, 14, 'Pasig Office', '1203', 'RECEIPT-104', '34930243298I02', 'ABC-1234', 'Model', 'Yellow', 'Toyota', 'Public', '94832dsa', 'dasjisa342jidj34g', '2011', 'Sedan', 'Passenger Car', 'Gasoline', 0, '2023-05-21 16:00:00', '2023-05-21 16:52:47', '2023-05-21 16:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `fdb_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `fdb_driver` varchar(255) NOT NULL,
  `fdb_driver_rating` char(5) NOT NULL,
  `fdb_passenger` varchar(255) NOT NULL,
  `fdb_passenger_rating` char(5) NOT NULL,
  `fdb_driver_created_at` timestamp NULL DEFAULT NULL,
  `fdb_passenger_created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `payment_amount` float(9,2) NOT NULL,
  `payment_status` varchar(8) NOT NULL,
  `payment_confirmed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `rate_id` int(11) NOT NULL,
  `rate_front` float(9,2) NOT NULL,
  `rate_left` float(9,2) NOT NULL,
  `rate_right` float(9,2) NOT NULL,
  `rate_middle` float(9,2) NOT NULL,
  `rate_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `trans_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trans_type` char(8) NOT NULL,
  `trans_reference_no` char(8) DEFAULT NULL,
  `trans_gcash_no` char(11) NOT NULL,
  `trans_amount` float(9,2) NOT NULL,
  `trans_fee` float(9,2) NOT NULL,
  `trans_rejected` tinyint(1) NOT NULL,
  `trans_verified_at` timestamp NULL DEFAULT NULL,
  `trans_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`trans_id`, `user_id`, `trans_type`, `trans_reference_no`, `trans_gcash_no`, `trans_amount`, `trans_fee`, `trans_rejected`, `trans_verified_at`, `trans_created_at`) VALUES
(14, 14, 'Email', NULL, 'NA', 0.00, 10.00, 0, '2023-05-21 16:46:58', '2023-05-21 16:46:58'),
(15, 14, 'Cash In', '34827439', '09324343243', 100.00, 80.00, 0, '2023-05-21 16:48:04', '2023-05-21 16:47:14'),
(16, 14, 'Cash In', '47624896', 'dsadasdas23', 500.00, 450.00, 0, '2023-05-21 16:48:08', '2023-05-21 16:47:26'),
(17, 14, 'Car', NULL, 'NA', 0.00, 40.00, 0, '2023-05-21 16:52:47', '2023-05-21 16:52:47'),
(18, 14, 'Cash Out', NULL, '09312873621', 100.00, 20.00, 1, NULL, '2023-05-21 16:53:06'),
(19, 14, 'Cash Out', '34827439', '09312873621', 100.00, 20.00, 0, '2023-05-21 16:53:41', '2023-05-21 16:53:31'),
(20, 14, 'Cash Out', '45875943', '09312873621', 100.00, 20.00, 0, '2023-05-21 16:55:08', '2023-05-21 16:54:36'),
(21, 14, 'Cash In', '47624896', '09432746234', 500.00, 450.00, 0, NULL, '2023-05-21 16:54:45');

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `trip_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `rate_id` int(11) NOT NULL,
  `trip_departure_datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `trip_start_barangay` varchar(255) NOT NULL,
  `trip_start_city` varchar(255) NOT NULL,
  `trip_start_province` varchar(255) NOT NULL,
  `trip_end_barangay` varchar(255) NOT NULL,
  `trip_end_city` varchar(255) NOT NULL,
  `trip_end_province` varchar(255) NOT NULL,
  `trip_status` varchar(20) NOT NULL,
  `trip_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_type` varchar(10) DEFAULT NULL,
  `user_fname` varchar(255) NOT NULL,
  `user_mname` varchar(255) DEFAULT NULL,
  `user_lname` varchar(255) NOT NULL,
  `user_contact_no` char(13) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_barangay` varchar(255) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_province` varchar(255) NOT NULL,
  `user_id_type` varchar(255) DEFAULT NULL,
  `user_id_number` varchar(255) DEFAULT NULL,
  `user_id_rejected` tinyint(1) NOT NULL,
  `user_id_confirmed_at` timestamp NULL DEFAULT NULL,
  `user_verified_at` timestamp NULL DEFAULT NULL,
  `user_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_balance` float(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_type`, `user_fname`, `user_mname`, `user_lname`, `user_contact_no`, `user_email`, `user_password`, `user_barangay`, `user_city`, `user_province`, `user_id_type`, `user_id_number`, `user_id_rejected`, `user_id_confirmed_at`, `user_verified_at`, `user_created_at`, `user_balance`) VALUES
(1, 'admin', 'Jhon Mark', '', 'Santos', '09654106978', 'jeyym@gmail.com', '12345678', 'Corazon', 'Calumpit', 'Bulacan', NULL, NULL, 0, NULL, '2023-05-10 11:34:34', '2023-05-03 16:47:04', 0.00),
(14, 'Driver', 'Jhon Mark', '', 'Santos', '09217456414', 'jeyymsantos@gmail.com', '12345678', 'Chenelyn', 'Calumpit', 'Bulacan', 'Driver\'s License', '2341dsa', 0, '2023-05-21 16:50:58', '2023-05-21 16:46:58', '2023-05-21 16:46:46', 340.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `trip_id` (`trip_id`),
  ADD KEY `pass_id` (`user_id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `driv_id` (`user_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`fdb_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `trans_id` (`trans_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`trip_id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `rate_id` (`rate_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `fdb_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`trip_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `bookings` (`book_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `bookings` (`book_id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `trips_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`),
  ADD CONSTRAINT `trips_ibfk_2` FOREIGN KEY (`rate_id`) REFERENCES `rates` (`rate_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
