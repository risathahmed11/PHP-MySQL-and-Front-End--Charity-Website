-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2023 at 01:35 AM
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
-- Database: `22131051_20141188_22222895`
--
CREATE DATABASE IF NOT EXISTS `22131051_20141188_22222895` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `22131051_20141188_22222895`;

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE `campaign` (
  `CampaignID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `CharityID` int(11) DEFAULT NULL,
  `CampaignName` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `TargetAmount` decimal(10,2) DEFAULT NULL,
  `CurrentAmount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `charity`
--

CREATE TABLE `charity` (
  `CharityID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `CharityName` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Website` varchar(255) DEFAULT NULL,
  `Founder` varchar(255) DEFAULT NULL,
  `ContactEmail` varchar(255) DEFAULT NULL,
  `ContactPhone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `ContactID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Mobile` varchar(20) DEFAULT NULL,
  `Message` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `DonationID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `UserID` int(11) DEFAULT NULL,
  `CharityID` int(11) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `DonationID` int(11) DEFAULT NULL,
  `PaymentMethod` varchar(255) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `CardNumber` varchar(16) DEFAULT NULL,
  `ExpiryDate` date DEFAULT NULL,
  `CardHolderName` varchar(255) DEFAULT NULL,
  `BillingAddress` varchar(255) DEFAULT NULL,
  `CVC` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `TransactionID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `DonationID` int(11) DEFAULT NULL,
  `PaymentDate` date DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `phone` VARCHAR(15) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `confirmpassword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `VolunteerID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `UserID` int(11) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD KEY `CharityID` (`CharityID`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD KEY `UserID` (`UserID`),
  ADD KEY `CharityID` (`CharityID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD KEY `DonationID` (`DonationID`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD KEY `DonationID` (`DonationID`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD KEY `UserID` (`UserID`);

--
-- Constraints for table `campaign`
--
ALTER TABLE `campaign`
  ADD CONSTRAINT `campaign_ibfk_1` FOREIGN KEY (`CharityID`) REFERENCES `charity` (`CharityID`);

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `donation_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `donation_ibfk_2` FOREIGN KEY (`CharityID`) REFERENCES `charity` (`CharityID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`DonationID`) REFERENCES `donation` (`DonationID`);

--
-- Constraints for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD CONSTRAINT `transaction_history_ibfk_1` FOREIGN KEY (`DonationID`) REFERENCES `donation` (`DonationID`);

--
-- Add `charity`
--
INSERT INTO charity (CharityName, Description, Website, Founder, ContactEmail, ContactPhone) 
VALUES (
  'CTA Foundation', 
  'Welcome to the CTA Foundation, where compassion meets action, and a community unites to eradicate hunger. We were founded in 2023 with a vision shared by a group of individuals determined to confront the challenges of food poverty head-on', 
  'cta-foundation.org',
  'BCU',
  'cta-foundation@gmail.com',
  '01212134352'
);
