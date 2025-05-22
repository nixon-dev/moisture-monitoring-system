-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2023 at 04:16 PM
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
-- Database: `monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE `beds` (
  `id` int(11) NOT NULL,
  `bedname` varchar(255) NOT NULL,
  `switch` varchar(3) NOT NULL DEFAULT 'Off',
  `manualswitch` varchar(255) NOT NULL DEFAULT 'Off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beds`
--

INSERT INTO `beds` (`id`, `bedname`, `switch`, `manualswitch`) VALUES
(225, '1', 'Off', 'Off'),
(226, '2', 'Off', 'Off'),
(227, '3', 'Off', 'Off');

-- --------------------------------------------------------

--
-- Table structure for table `bedschedules`
--

CREATE TABLE `bedschedules` (
  `id` int(255) NOT NULL,
  `bedname` int(255) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `sched_switch` varchar(255) NOT NULL DEFAULT 'Off',
  `harvest` varchar(255) NOT NULL DEFAULT 'No',
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bedschedules`
--

INSERT INTO `bedschedules` (`id`, `bedname`, `startdate`, `enddate`, `sched_switch`, `harvest`, `name`) VALUES
(304, 1, '2023-06-14', '2023-06-28', 'Off', 'No', 'Decomposing Period'),
(305, 1, '2023-06-29', '2023-07-28', 'On', 'No', 'Monitoring Period'),
(306, 1, '2023-07-29', '2023-08-11', 'Off', 'Yes', 'Harvesting Week'),
(307, 2, '2023-06-14', '2023-06-28', 'Off', 'No', 'Decomposing Period'),
(308, 2, '2023-06-29', '2023-07-28', 'On', 'No', 'Monitoring Period'),
(309, 2, '2023-07-29', '2023-08-11', 'Off', 'Yes', 'Harvesting Week'),
(310, 3, '2023-06-14', '2023-06-28', 'Off', 'No', 'Decomposing Period'),
(311, 3, '2023-06-29', '2023-07-28', 'On', 'No', 'Monitoring Period'),
(312, 3, '2023-07-29', '2023-08-11', 'Off', 'Yes', 'Harvesting Week');

-- --------------------------------------------------------

--
-- Table structure for table `homepage`
--

CREATE TABLE `homepage` (
  `id` int(11) NOT NULL,
  `title` mediumtext NOT NULL,
  `subtitle` mediumtext NOT NULL,
  `title1` mediumtext NOT NULL,
  `context1` mediumtext NOT NULL,
  `context2` mediumtext NOT NULL,
  `context3` mediumtext NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homepage`
--

INSERT INTO `homepage` (`id`, `title`, `subtitle`, `title1`, `context1`, `context2`, `context3`, `email`, `phonenumber`) VALUES
(1, 'QSU - RDET', 'Vermi-compost Monitoring System', 'About Vermicompost', 'Vermicomposting is a natural process whereby earthworms convert waste material with rigid structures into compost. The compost produced in this green process is traditionally and popularly as a natural fertilizer for enhancing plant growth. When vermicompost is added to soil, it boosts the nutrients available to plants and enhances soil structures and drainage. Vermicomposting is a chemical and biological process for recycling nutrients with the aid of earthworms and microorganisms. Thus, vermicompost is considered a high-nutrient biofertilizer with diverse microbial communities, Parveen Fatemeh Rupani, Jorge Domínguez 2022. Vermicomposting is an Eco-biotechnological process, and joint action of earthworm and microbes for the conversion of organic waste into nutrient-enriched vermicompost products. The various earthworm species such as red worms, tiger worms, and red wigglers are responsible for consuming organic waste such as flower waste, agricultural waste, animal waste, sewage sludge, etc. During the vermicomposting process, the digestive process of the earthworm is used as vermicompost, Kunwar D. Yadav, Rajnikant Prasad 2022, Vermicomposting is a process of decomposition of organic waste with the help of earthworms yielding a better end product called Vermicast. Vermicompost is considered an organic fertilizer as it is rich in nutrients and acts as a soil conditioner, A thakur, A kumar, (2019),', 'However, Quirino State University\'s Research and Development Extension Training (RDET) program continues to rely on manual monitoring. This practice of manual monitoring is time-consuming for the project in charge to generate and consolidate reports. Soil moisture may also become unhealthy and lack moisture due to not checking daily. Soil moisture is also unsecured because of unexpected circumstances, in which case it would be difficult to the Research and Development Extension Training Staff to restore the soil moisturization percentage.', 'Thus, a monitoring system is critical, particularly in research and development extension training for vermicompost. The soil moisture percentage must be maintained in order for management to monitor the success or failure of the soil moisturization percentage. With this, project developers or the researchers decided to propose a project entitled “Quirino State University-Research and Development Extension Training Vermicompost Monitoring System”, so that they are able to generate timely soil moisture of Vermicompost that will help them determine the status of the Vermicompost to initiate appropriate actions needed.', 'info@qsu.edu.ph', '0917-137-3948');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `topimage` varchar(255) NOT NULL,
  `bottomimage` varchar(255) NOT NULL,
  `slider1` varchar(255) NOT NULL,
  `slider2` varchar(255) NOT NULL,
  `slider3` varchar(255) NOT NULL,
  `slider4` varchar(255) NOT NULL,
  `slider5` varchar(255) NOT NULL,
  `slider6` varchar(255) NOT NULL,
  `slider7` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `topimage`, `bottomimage`, `slider1`, `slider2`, `slider3`, `slider4`, `slider5`, `slider6`, `slider7`) VALUES
(1, '64620025f16fd.jpg', '6460d70954763.jpg', '646200661d5c8.jpg', '64620066285fb.jpg', '646200662d5ab.jpg', '646200663230e.jpg', '646200663784d.jpg', '646200663c5f2.jpg', '6462006641ada.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `bedname` int(255) NOT NULL,
  `gauge1` int(255) NOT NULL,
  `gauge2` int(255) NOT NULL,
  `gauge3` int(255) NOT NULL,
  `logdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `bedname`, `gauge1`, `gauge2`, `gauge3`, `logdate`) VALUES
(5807, 6, 0, 0, 0, '2023-05-27 13:57:00'),
(5808, 7, 0, 0, 0, '2023-05-27 13:57:00'),
(5809, 8, 0, 0, 0, '2023-05-27 13:57:00'),
(5810, 9, 0, 0, 0, '2023-05-27 13:57:00'),
(5811, 10, 0, 0, 0, '2023-05-27 13:57:00'),
(5812, 11, 0, 0, 0, '2023-05-27 13:57:00'),
(5813, 12, 0, 0, 0, '2023-05-27 13:57:00'),
(5814, 13, 0, 0, 0, '2023-05-27 13:57:00'),
(5815, 14, 0, 0, 0, '2023-05-27 13:57:00'),
(5816, 15, 0, 0, 0, '2023-05-27 13:57:00'),
(5817, 15, 0, 0, 0, '2023-05-27 13:57:00'),
(5818, 16, 0, 0, 0, '2023-05-27 13:57:00'),
(5819, 17, 0, 0, 0, '2023-05-27 13:57:00'),
(5820, 18, 0, 0, 0, '2023-05-27 13:57:00'),
(5821, 19, 0, 0, 0, '2023-05-27 13:57:00'),
(5822, 20, 0, 0, 0, '2023-05-27 13:57:00'),
(5823, 20, 0, 0, 0, '2023-05-27 13:57:00'),
(5824, 21, 0, 0, 0, '2023-05-27 13:57:00'),
(5825, 22, 0, 0, 0, '2023-05-27 13:57:00'),
(5826, 23, 0, 0, 0, '2023-05-27 13:57:00'),
(5827, 24, 0, 0, 0, '2023-05-27 13:57:00'),
(5828, 25, 0, 0, 0, '2023-05-27 13:57:00'),
(5829, 26, 0, 0, 0, '2023-05-27 13:57:00'),
(5830, 27, 0, 0, 0, '2023-05-27 13:57:00'),
(5831, 28, 0, 0, 0, '2023-05-27 13:57:00'),
(5832, 29, 0, 0, 0, '2023-05-27 13:57:00'),
(5833, 30, 0, 0, 0, '2023-05-27 13:57:00'),
(5839, 6, 0, 0, 0, '2023-05-27 13:58:57'),
(5840, 7, 0, 0, 0, '2023-05-27 13:58:57'),
(5841, 8, 0, 0, 0, '2023-05-27 13:58:57'),
(5842, 9, 0, 0, 0, '2023-05-27 13:58:57'),
(5843, 10, 0, 0, 0, '2023-05-27 13:58:57'),
(5844, 11, 0, 0, 0, '2023-05-27 13:58:57'),
(5845, 12, 0, 0, 0, '2023-05-27 13:58:57'),
(5846, 13, 0, 0, 0, '2023-05-27 13:58:57'),
(5847, 14, 0, 0, 0, '2023-05-27 13:58:57'),
(5848, 15, 0, 0, 0, '2023-05-27 13:58:57'),
(5849, 15, 0, 0, 0, '2023-05-27 13:58:57'),
(5850, 16, 0, 0, 0, '2023-05-27 13:58:57'),
(5851, 17, 0, 0, 0, '2023-05-27 13:58:57'),
(5852, 18, 0, 0, 0, '2023-05-27 13:58:57'),
(5853, 19, 0, 0, 0, '2023-05-27 13:58:57'),
(5854, 20, 0, 0, 0, '2023-05-27 13:58:57'),
(5855, 20, 0, 0, 0, '2023-05-27 13:58:57'),
(5856, 21, 0, 0, 0, '2023-05-27 13:58:57'),
(5857, 22, 0, 0, 0, '2023-05-27 13:58:57'),
(5858, 23, 0, 0, 0, '2023-05-27 13:58:57'),
(5859, 24, 0, 0, 0, '2023-05-27 13:58:57'),
(5860, 25, 0, 0, 0, '2023-05-27 13:58:57'),
(5861, 26, 0, 0, 0, '2023-05-27 13:58:57'),
(5862, 27, 0, 0, 0, '2023-05-27 13:58:57'),
(5863, 28, 0, 0, 0, '2023-05-27 13:58:57'),
(5864, 29, 0, 0, 0, '2023-05-27 13:58:57'),
(5865, 30, 0, 0, 0, '2023-05-27 13:58:57'),
(5871, 6, 0, 0, 0, '2023-05-27 13:59:00'),
(5872, 7, 0, 0, 0, '2023-05-27 13:59:00'),
(5873, 8, 0, 0, 0, '2023-05-27 13:59:00'),
(5874, 9, 0, 0, 0, '2023-05-27 13:59:00'),
(5875, 10, 0, 0, 0, '2023-05-27 13:59:00'),
(5876, 11, 0, 0, 0, '2023-05-27 13:59:00'),
(5877, 12, 0, 0, 0, '2023-05-27 13:59:00'),
(5878, 13, 0, 0, 0, '2023-05-27 13:59:00'),
(5879, 14, 0, 0, 0, '2023-05-27 13:59:00'),
(5880, 15, 0, 0, 0, '2023-05-27 13:59:00'),
(5881, 15, 0, 0, 0, '2023-05-27 13:59:00'),
(5882, 16, 0, 0, 0, '2023-05-27 13:59:00'),
(5883, 17, 0, 0, 0, '2023-05-27 13:59:00'),
(5884, 18, 0, 0, 0, '2023-05-27 13:59:00'),
(5885, 19, 0, 0, 0, '2023-05-27 13:59:00'),
(5886, 20, 0, 0, 0, '2023-05-27 13:59:00'),
(5887, 20, 0, 0, 0, '2023-05-27 13:59:00'),
(5888, 21, 0, 0, 0, '2023-05-27 13:59:00'),
(5889, 22, 0, 0, 0, '2023-05-27 13:59:00'),
(5890, 23, 0, 0, 0, '2023-05-27 13:59:00'),
(5891, 24, 0, 0, 0, '2023-05-27 13:59:00'),
(5892, 25, 0, 0, 0, '2023-05-27 13:59:00'),
(5893, 26, 0, 0, 0, '2023-05-27 13:59:00'),
(5894, 27, 0, 0, 0, '2023-05-27 13:59:00'),
(5895, 28, 0, 0, 0, '2023-05-27 13:59:00'),
(5896, 29, 0, 0, 0, '2023-05-27 13:59:00'),
(5897, 30, 0, 0, 0, '2023-05-27 13:59:00'),
(5899, 0, 0, 0, 0, '2023-05-27 13:59:23'),
(7574, 1, 0, 0, 0, '2023-06-14 21:44:12'),
(7575, 2, 0, 0, 0, '2023-06-14 21:44:14'),
(7576, 3, 0, 0, 0, '2023-06-14 21:44:15'),
(7577, 1, 68, 98, 49, '2023-06-14 16:02:22'),
(7578, 2, 75, 42, 44, '2023-06-14 16:02:22'),
(7579, 1, 3, 25, 45, '2023-06-14 16:02:28'),
(7580, 2, 70, 54, 19, '2023-06-14 16:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `roles` text NOT NULL,
  `profilepfn` varchar(999) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `verified` int(1) NOT NULL DEFAULT 0,
  `activated` varchar(11) NOT NULL DEFAULT 'Yes',
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `roles`, `profilepfn`, `code`, `verified`, `activated`, `token`) VALUES
(21, 'Staff', 'staff@email.com', 'staff', 'staff', 'Staff', '645ef5a61456f.jpg', '', 1, 'Yes', ''),
(50, 'Administrator', 'admin@gmail.com', 'admin', 'admin', 'Administrator', '646cc7af7aec0.jpg', 'f7e89e97e794eaac9256f0717bc8f6d8', 1, 'Yes', ''),
(61, 'Web Master', 'nanashi.ruuza74@gmail.com', 'nanashi', 'nanashi', 'Administrator', '', '', 1, 'No', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bedschedules`
--
ALTER TABLE `bedschedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage`
--
ALTER TABLE `homepage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beds`
--
ALTER TABLE `beds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `bedschedules`
--
ALTER TABLE `bedschedules`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;

--
-- AUTO_INCREMENT for table `homepage`
--
ALTER TABLE `homepage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7581;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
