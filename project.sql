-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2023 at 07:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `title` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `luggage` tinyint(4) NOT NULL,
  `doors` tinyint(4) NOT NULL,
  `passenger` tinyint(4) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `image` varchar(60) NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '0->inactive, 1->active',
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `regDate`, `title`, `price`, `luggage`, `doors`, `passenger`, `content`, `image`, `active`, `category_id`) VALUES
(3, '2023-10-25 17:30:09', 'Dodge Hornet GT 2005', 32462, 2, 4, 4, 'Meet the 2024 Dodge Hornet GT, the fastest CUV in the segment 2. 268 horsepower. 295 pound-feet of torque. 0 to 60 mph in 6.5 seconds. And one seriously turbocharged engine.', '551c1736a55c38a6bc85bda90cf32bc2.jpeg', 1, 6),
(4, '2023-10-25 17:43:01', 'Dodge Durango SRT Hellcat 2023', 99787, 2, 4, 4, 'Overview. A ludicrous beast born largely of opportunity, the 2024 Dodge Durango SRT Hellcat blends the 6.2-liter supercharged “Hellcat” engine of Challenger and Charger Hellcat fame with a traditional SUV body style and succeeds with remarkably tractable results.', '9cac2fe3d8ead24a831d17027fca29be.jpeg', 0, 6),
(5, '2023-10-25 13:20:56', 'Dodge Ram 2500 Sport 2007', 66990, 6, 4, 7, 'AND MUCH MUCH MORE!! PRICED TO SELL, Wait any longer and youll miss out! Looking to finance? Go through our Quick and EASY FINANCE application! WARRANTY PACKAGES available spanning 1-5 years! TRADE-INs welcomed! Thorough safety checks done on all our vehicles!', '6c1d99237311f87c97d47f48f6aa8741.jpeg', 1, 6),
(6, '2023-10-25 13:08:06', 'Dodge Dakota SLT 2001', 4095, 6, 4, 5, 'The SLT served as the \"mid-level\" Dakota model. It added the following features to the base ST model: sixteen-inch sport-styled alloy wheels, cloth seating surfaces, and power windows and door locks with keyless entry.', '1a536d9c93a81749b2f9532fba0371b3.jpeg', 1, 6),
(7, '2023-10-25 13:08:34', 'Dodge Caravan 1997', 17235, 3, 4, 5, 'The Caravan and Grand Caravan models were the best-selling vans in 1996, outselling Ford’s Windstar by 100,000. Through June, Chrysler had sold 273,430 of its three vans (Caravan, Voyager, Town & Country) vs. 64,581 for GM’s three vans (Trans Sport, Oldsmobile Silhouette, Chevrolet Venture.).', 'd295a3ecf267e53f576b103e88c79e60.jpeg', 1, 6),
(8, '2023-10-25 13:17:13', 'Bentley Bentayga Hybrid 2023', 197300, 2, 4, 4, 'Base, Azure and S trims come standard with a turbocharged 3.0-liter V6 paired to a plug-in hybrid system. The hybrid component is composed of a 100-kW electric motor and an 18-kWh battery pack. Total system output is 456 horsepower and 516 lb-ft of torque.', 'c6ccf7e47debdd17e7cce1d0e918ee60.jpeg', 1, 4),
(9, '2023-10-25 13:16:53', 'Bentley Flying Spur Speed 2023', 270985, 3, 4, 4, ' the car\'s breathtaking acceleration, from a standing start to 60 mph in just 3.7 seconds (0 to 100 km/h in 3.8 seconds). Its top speed, thanks to the 6.0 litre W12 engine, is 207 mph (333 km/h) – performance literally unheard of in the world of the luxury sedan', 'b1726ec007532622927a5f1567f0297a.jpeg', 1, 4),
(10, '2023-10-25 13:17:41', 'Bentley Continental GT Speed 2023', 397970, 2, 2, 2, 'The powerful 542 hp engine will get you from zero to 60 in just 3.9 seconds and reach a formidable top speed of 198 mph.', '78e132d023c7032e7525fca95e7243d6.jpeg', 1, 4),
(11, '2023-10-25 13:15:04', 'Bentley Bentayga 2023', 315620, 2, 2, 2, 'With active all-wheel drive and a choice of two powertrains – a thrilling 4.0 litre Bentley V8* with a top speed of 180 mph (290 km/h) or a 3.0 litre hybrid that can reach 158 mph (254 km/h) – it is a unique fusion of performance, craftsmanship and go-anywhere style.', 'a49db4d52104e17428b089f80ed183a5.jpeg', 1, 4),
(12, '2023-10-25 17:28:27', 'Bentley Bentayga EWB 2022', 279000, 2, 4, 5, 'The New Bentayga Extended Wheelbase is a car with incredible road presence, while offering a superlative experience for passengers who sit in the rear. The letters \'EWB\' denote its extended wheelbase – a 180mm stretch that increases rear legroom significantly.', '1142a9addb96798af753918c0ff7b539.jpeg', 1, 4),
(13, '2023-10-25 17:32:27', 'Cadillac Escalade Hybrid 2013', 74425, 2, 4, 4, 'Cadillac’s eight-seat Escalade Hybrid uses GM’s 2-Mode Hybrid system to reduce fuel consumption yet retain the traditional capabilities of a full-size SUV. It’s available in rear- or four-wheel-drive form, and its hybrid system works with a 6.0-liter V-8 gasoline engine. Primary competitors include the related Chevrolet Tahoe Hybrid and GMC Yukon Hybrid.', 'd80979b7186397181acb7e33a3d2cdb5.jpeg', 1, 5),
(14, '2023-10-25 17:34:12', 'Ford Ecosport Titanium 1.5 BK 2013', 15495, 4, 4, 6, 'Equally as important as selecting the best vehicle on the market is who you choose to buy your car from. Here are just a few reasons why our dealership is the perfect choice for your next purchase. - Our focus is on you so that our repeat and referral business continue to grow. - Our Sales Specialists are trained to ensure their sole focus is on providing you a flawless customer experience. - We understand the car buying experience is very different today compared to many years ago. So, we take a genuinely unique approach to make sure that the car you buy is aligned perfectly with your needs. Put simply, we make it super easy for you to buy from us. We have an excellent internet pricing comparison tool that is monitored daily & allows us to search all over Australia - in an instant - for other vehicles like the one you are looking at and compare prices of all the cars out there. We index the price of our vehicles below the others, so we can ensure you are not only getting the best pres', '6ecc0db7db41afc56e434361280026c3.jpeg', 1, 8),
(15, '2023-10-25 17:35:48', 'Ford Crown Victoria 2010', 29905, 2, 2, 2, 'This car has been week maintained with all records available. It has newer tires, new battery, all electrical checked and only 109,000 freeway miles. It rides and drives like a dream and has a huge trunk and plenty of legroom in back. The front seats are lumbar adjustable, making for a comfortable long driving experience.', '735c995d2228700af07aae90c0d9fc43.jpeg', 1, 8),
(16, '2023-10-25 17:37:13', 'Mercedes-Benz AMG CLA 35 2023', 49500, 2, 4, 4, 'Hot-blooded performance and angry styling are hallmarks of the Mercedes-AMG brand, and the 2023 CLA-class offers plenty of both in a compact, fastback-sedan package. The entry-level CLA35 is powered by a 302-hp turbo-four while the CLA45 enjoys a boost in engine output to an impressive 382 horses.', 'cca8464b1a987f16e33a17005b50493d.jpeg', 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `regDate`, `category`) VALUES
(1, '2023-10-23 12:48:22', 'BMW'),
(2, '2023-10-23 12:24:13', 'Ferrari'),
(4, '2023-10-24 13:29:15', 'Bentley'),
(5, '2023-10-24 13:29:34', 'Cadillac'),
(6, '2023-10-24 13:29:44', 'Dodge'),
(7, '2023-10-24 13:30:02', 'Fiat'),
(8, '2023-10-24 13:30:12', 'Ford'),
(12, '2023-10-24 13:32:01', 'Mercedes-Benz'),
(15, '2023-10-25 17:40:49', 'Kia');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(50) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0->inactive,1->active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `regDate`, `name`, `userName`, `email`, `password`, `active`) VALUES
(1, '2023-10-22 14:38:58', 'Menna Emad', 'mennaemad96', 'mennaemad6196@gmail.com', '$2y$10$sSMOUtxhO8DVzQXBrE35DeoX6HEfqrQzwv5gzPBIDu4FzuV/26S0y', 1),
(5, '2023-10-22 23:18:20', 'Omar Emad', 'omaremad2000', 'omar@gmail.com', '$2y$10$jQQcb9sgPHhmbYogNy2Tce6v0gOA3tYth9VDuqaj.XqrmGr/NQJLm', 0),
(6, '2023-10-25 17:14:34', 'Remy Ahmad', 'remyahmad2021', 'remy@gmail.com', '$2y$10$i2vXTCl8sEoYXfOpwe/GkuU2CZsRuyud6TSWN0El6v1wDGm1CK7vW', 1),
(7, '2023-10-22 23:15:44', 'Ahmad Shokry', 'shokry93', 'ahmad@gmail.com', '$2y$10$/0u3AhF8ZCixMC.KfY//LuO63WdPoqgqaYOGmCgGnoWBQuEs5Zir2', 1),
(8, '2023-10-25 17:38:55', 'Nada Majdy', 'nadamajdy93', 'nada@gmail.com', '$2y$10$oeaVk5cN1k8aFf8QBf10B.JUHp/KChrcUjXlUiEXzXCdbwxKMrlrq', 1),
(16, '2023-10-22 23:32:04', 'Raghad Ahmad', 'raghood95', 'raghad@gmail.com', '$2y$10$l2Du7HCzZLkjZ8LPS6R.Y.DXpbgpcPwubsGV2O1kMXY5Emmiwim.G', 0),
(28, '2023-10-25 16:02:28', 'try user', 'tryuser', 'tryuser@gmail.com', '$2y$10$4QOkNkkkJg9KxjSrfI/jXOhLnquQqQQ66Ah0ZC7Ed9rPwbw50zSOe', 0),
(33, '2023-10-25 17:39:43', 'Azza Eliwa', 'azeez66', 'azza@gmail.com', '$2y$10$I3EytlnYWI.ypuAO634FZ.WsYB7ZbuJBfzeOensFkegjIVAirPwxa', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `title_2` (`title`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category` (`category`),
  ADD KEY `category_2` (`category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `userName_2` (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
