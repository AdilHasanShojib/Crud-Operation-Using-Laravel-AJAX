-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 09:06 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_details`
--

CREATE TABLE `hrms_employee_details` (
  `Employee_No_PK` bigint(20) UNSIGNED NOT NULL,
  `Employee_UID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EmployeeName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FatherName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MotherName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DOB` date NOT NULL,
  `Gender` tinyint(4) NOT NULL,
  `Employee_Type_No_FK` bigint(20) UNSIGNED NOT NULL,
  `Designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Contact_Number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email_Address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrms_employee_details`
--

INSERT INTO `hrms_employee_details` (`Employee_No_PK`, `Employee_UID`, `EmployeeName`, `FatherName`, `MotherName`, `DOB`, `Gender`, `Employee_Type_No_FK`, `Designation`, `Contact_Number`, `Email_Address`, `Remarks`, `Status`, `created_at`, `updated_at`) VALUES
(2, 'EMP0002', 'Tisha', 'Azizul Islam', 'Marium Begum', '2005-11-03', 2, 1, 'samsung', '0123456782', 'tisha@gmail.com', 'Good', 1, '2025-05-26 09:19:29', '2025-05-26 12:36:44'),
(3, 'EMP0003', 'Employee 3', 'Father 3', 'akiba', '1997-07-11', 2, 2, 'Designation', '0123456783', 'employee3@example.com', 'This is employee #3', 0, '2025-05-26 09:19:29', '2025-05-26 12:47:29'),
(4, 'EMP0004', 'Employee 4', 'Father 4', 'Mother 4', '2004-01-11', 2, 1, 'Designation 4', '0123456784', 'employee4@example.com', 'This is employee #4', 0, '2025-05-26 09:19:29', '2025-05-26 09:19:29'),
(10, 'EMP0010', 'Employee 10', 'Father 10', 'Mother 10', '2002-04-14', 2, 1, 'Designation 10', '01234567810', 'employee10@example.com', 'This is employee #10', 0, '2025-05-26 09:19:29', '2025-05-26 09:19:29'),
(11, 'EMP0011', 'Md. Shojib Talukder', 'Md. Rehia Talukder', 'Lovely Akter', '1999-06-16', 1, 3, 'UIU', '01797707376', 'adilhasanshojib@gmail.com', 'This is an employee of UIU', 1, '2025-05-26 10:17:23', '2025-05-26 10:17:23'),
(12, 'EMP0001', 'Anamul Haque Sunny', 'Amdadul Haque', 'Sabina Yesmin', '2003-08-17', 1, 1, 'Bangladesh Police', '0172020061', 'anamul@gmail.com', 'Good', 1, '2025-05-26 12:34:42', '2025-05-26 12:34:42');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_types`
--

CREATE TABLE `hrms_employee_types` (
  `Employee_Type_No_PK` bigint(20) UNSIGNED NOT NULL,
  `Type_Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrms_employee_types`
--

INSERT INTO `hrms_employee_types` (`Employee_Type_No_PK`, `Type_Name`, `Status`, `created_at`, `updated_at`) VALUES
(1, 'Permanent', 1, '2025-05-26 05:39:16', '2025-05-26 05:39:16'),
(2, 'Contract', 1, '2025-05-26 05:39:16', '2025-05-26 05:39:16'),
(3, 'Intern', 1, '2025-05-26 05:39:16', '2025-05-26 05:39:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hrms_employee_details`
--
ALTER TABLE `hrms_employee_details`
  ADD PRIMARY KEY (`Employee_No_PK`),
  ADD KEY `hrms_employee_details_employee_type_no_fk_foreign` (`Employee_Type_No_FK`);

--
-- Indexes for table `hrms_employee_types`
--
ALTER TABLE `hrms_employee_types`
  ADD PRIMARY KEY (`Employee_Type_No_PK`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hrms_employee_details`
--
ALTER TABLE `hrms_employee_details`
  MODIFY `Employee_No_PK` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hrms_employee_types`
--
ALTER TABLE `hrms_employee_types`
  MODIFY `Employee_Type_No_PK` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hrms_employee_details`
--
ALTER TABLE `hrms_employee_details`
  ADD CONSTRAINT `hrms_employee_details_employee_type_no_fk_foreign` FOREIGN KEY (`Employee_Type_No_FK`) REFERENCES `hrms_employee_types` (`Employee_Type_No_PK`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
