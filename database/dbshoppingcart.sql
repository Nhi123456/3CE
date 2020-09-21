-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2020 at 06:13 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbshoppingcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_email` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'HVPhuong', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `p_id`, `ip_add`, `user_id`, `qty`) VALUES
(2, 3, '::1', 0, 1),
(4, 4, '::1', 0, 1),
(13, 3, '::1', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Skin Moisturizing'),
(2, 'Makeup Lips'),
(3, 'Body Lotion'),
(4, 'Hair Care');

-- --------------------------------------------------------

--
-- Table structure for table `orders_info`
--

CREATE TABLE `orders_info` (
  `order_id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `f_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` int(10) NOT NULL,
  `cardname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cardnumber` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expdate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prod_count` int(15) DEFAULT NULL,
  `total_amt` int(15) DEFAULT NULL,
  `cvv` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_info`
--

INSERT INTO `orders_info` (`order_id`, `user_id`, `f_name`, `email`, `address`, `city`, `zip`, `cardname`, `cardnumber`, `expdate`, `prod_count`, `total_amt`, `cvv`) VALUES
(1, 8, 'HUYNH DINH KHANH BINH YEN', 'vn02782878@gmail.com', '392/8/114 Cao Thang street, ward 12, district 10', 'Ho Chi Minh City', 700000, 'HUYNH DINH KHANH BINH YEN', '1232321421321512', '12/22', 1, 9, 2312),
(2, 8, 'HUYNH DINH KHANH BINH YEN', 'vn02782878@gmail.com', '392/8/114 Cao Thang street, ward 12, district 10', 'Ho Chi Minh City', 700000, 'HUYNH DINH KHANH BINH YEN', '1234567899023123', '12/22', 2, 32, 1232),
(3, 8, 'Hung Van Ha', 'hungha@gmail.com', 'Tran Quang Khai', 'TPHCM', 700000, 'Hung Van Ha', '5123 2132 1412 3', '12/22', 2, 59, 1231);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_pro_id` int(10) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(15) DEFAULT NULL,
  `amt` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_pro_id`, `order_id`, `product_id`, `qty`, `amt`) VALUES
(2, 2, 3, 1, 23.00),
(3, 2, 2, 3, 27.00),
(12, 3, 2, 4, 36.00),
(13, 3, 3, 1, 23.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` float(10,2) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`) VALUES
(1, 1, 'Green Tea Mist 50ml', 6.00, '', '27877_l.png', 'skin moisturizing green tea mist'),
(2, 1, 'No sebum lotion 100ml', 9.00, '', '23692_l.png', 'skin moisturizing no sebum lotion'),
(3, 1, 'Bija Cica S.O.S. Kit 1 box', 23.00, '', '29733_l.png', 'bija cica kit box skin moisturizing'),
(4, 2, 'My Lip And Cheek (Airy) 3.8g', 8.00, '', '27739_l.png', 'my lip and cheek airy makeup lips'),
(5, 2, 'Mineral Stick Concealer 2g', 9.00, '', '30378_l.png', 'mineral stick concealer makeup lips'),
(6, 2, 'My Concealer Dark Circle Cover 7g', 11.00, '', '30975_l.png', 'concealer dark circle cover makeup lips'),
(7, 3, 'Hydrating body lotion with green tea', 16.00, '', '231170088.jpg', 'hydrating green tea body lotion'),
(8, 3, 'Enriching body lotion', 20.00, '', '270670204.jpg', 'enriching body lotion'),
(9, 3, 'Moisturizing body oil', 21.00, '', '270670199.jpg', 'moisturizing body lotion'),
(10, 3, 'sad', 12.00, '', '1591635768_93913314_3006272286158928_5105192333561823232_n.jpg', 'ai'),
(11, 1, 'fasfa', 412.00, '', '1591635892_96790243_3667721156577165_5140890843300757504_n.jpg', 'ai'),
(12, 4, 'Essential shampoo', 11.00, 'afsgfasdsad', '1592840300_231170149_Essential_Hair_Shampoo_with_Camellia_Resized_540x.jpg', 'haire care'),
(13, 4, 'Travel buddy! Body & hair care set', 15.00, 'This set of 4 travel-size shower staples is ready to roll, wherever youâ€™re headed.', '1592840463_Travel_Buddy_450x.jpg', 'haire care'),
(14, 4, 'My hair refreshing shampoo [for oily scalp]', 13.00, 'Refreshing shampoo helps remove excess oil from the scalp and thoroughly cleans hair.', '1592840557_231170300_My_Hair_Refreshing_Shampoo_for_Oily_Scalp_Resized_540x.jpg', 'haire care');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `address`) VALUES
(8, 'Hung', 'Van Ha', 'hungha@gmail.com', 'hungha', 123456789, 'Tran Quang Khai'),
(13, 'YEN', 'HUYNH DINH KHANH', 'yen@gmail.com', 'yen', 794891986, '392/8/114 Cao Thang street, ward 12, district 10'),
(15, 'Phat', 'Tan Ha', 'phatha@gmail.com', 'e0f73ab0fb981e10d93db0e5b8129c18', 794891986, '392/8/114 Cao Thang street, ward 12, district 10'),
(17, 'fname', 'lname', '123412@gmail.com', 'vn83206828', 1234567890, '392/8/114 Cao Thang street, ward 12, district 10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders_info`
--
ALTER TABLE `orders_info`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_pro_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders_info`
--
ALTER TABLE `orders_info`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_pro_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
