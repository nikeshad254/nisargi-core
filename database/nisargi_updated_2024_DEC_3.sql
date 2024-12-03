-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2024 at 01:31 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nisargi`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `street` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `order_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ordered_product`
--

CREATE TABLE `ordered_product` (
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `orderproduct_view`
-- (See below for the actual view)
--
CREATE TABLE `orderproduct_view` (
`order_id` int
,`date` datetime
,`status` enum('complete','in review','approved','canceled','in delivery')
,`user_id` int
,`quantity` int
,`product_id` int
,`delivery_id` int
,`delivery_name` varchar(100)
,`city` varchar(100)
,`street` varchar(100)
,`mobile` varchar(25)
,`message` text
,`product_name` varchar(255)
,`price` int
,`stock` int
,`deleteFlag` enum('d','o')
,`shop_id` int
,`unit` varchar(50)
,`product_image` varchar(255)
,`photo` varchar(255)
,`delivery_message` text
,`shop_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delivery_date` date DEFAULT NULL,
  `status` enum('complete','in review','approved','canceled','in delivery') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'in review',
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `stock` int NOT NULL,
  `unit` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `shop_id` int NOT NULL,
  `deleteFlag` enum('d','o') COLLATE utf8mb4_general_ci DEFAULT 'o'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_review_view`
-- (See below for the actual view)
--
CREATE TABLE `product_review_view` (
`review_id` int
,`review_date` datetime
,`review_msg` text
,`reviewer_id` int
,`reviewer_name` varchar(255)
,`reviewer_pic` varchar(255)
,`rating` float
,`product_id` int
,`product_name` varchar(255)
,`shop_id` int
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_view`
-- (See below for the actual view)
--
CREATE TABLE `product_view` (
`id` int
,`name` varchar(255)
,`image` varchar(255)
,`description` text
,`category` varchar(100)
,`price` int
,`stock` int
,`unit` varchar(50)
,`deleteFlag` enum('d','o')
,`shop_id` int
,`shop_name` varchar(255)
,`review_count` bigint
,`avg_rating` double
);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int NOT NULL,
  `star_count` float NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_id` int NOT NULL,
  `item_id` int NOT NULL,
  `type` enum('shop','product') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `bio` text COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `badge` tinyint NOT NULL DEFAULT '-1',
  `user_id` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'demo_shop.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `shop_review_view`
-- (See below for the actual view)
--
CREATE TABLE `shop_review_view` (
`shop_id` int
,`shop_name` varchar(255)
,`shop_badge` tinyint
,`shop_img` varchar(255)
,`review_id` int
,`rating` float
,`review_msg` text
,`review_on` datetime
,`reviewer_id` int
,`reviewer_name` varchar(255)
,`reviewer_img` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'demo-profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `address`, `email`, `password`, `photo`) VALUES
(45, 'demo', 'demo address', 'demo@gmail.com', '$2y$10$aky8EeiaUnL9wWSKjq/sLuXyu2h86vrm8xITgahKMTwKpHYzw0zPK', 'demo-profile.png');

-- --------------------------------------------------------

--
-- Structure for view `orderproduct_view`
--
DROP TABLE IF EXISTS `orderproduct_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `orderproduct_view`  AS SELECT `o`.`id` AS `order_id`, `o`.`date` AS `date`, `o`.`status` AS `status`, `o`.`user_id` AS `user_id`, `op`.`quantity` AS `quantity`, `op`.`product_id` AS `product_id`, `d`.`id` AS `delivery_id`, `d`.`name` AS `delivery_name`, `d`.`city` AS `city`, `d`.`street` AS `street`, `d`.`mobile` AS `mobile`, `d`.`message` AS `message`, `p`.`name` AS `product_name`, `p`.`price` AS `price`, `p`.`stock` AS `stock`, `p`.`deleteFlag` AS `deleteFlag`, `p`.`shop_id` AS `shop_id`, `p`.`unit` AS `unit`, `p`.`image` AS `product_image`, `u`.`photo` AS `photo`, `d`.`message` AS `delivery_message`, `s`.`name` AS `shop_name` FROM (((((`orders` `o` join `ordered_product` `op` on((`o`.`id` = `op`.`order_id`))) join `delivery` `d` on((`o`.`id` = `d`.`order_id`))) join `product` `p` on((`op`.`product_id` = `p`.`id`))) join `user` `u` on((`o`.`user_id` = `u`.`id`))) join `shop` `s` on((`p`.`shop_id` = `s`.`id`))) ORDER BY `o`.`date` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `product_review_view`
--
DROP TABLE IF EXISTS `product_review_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_review_view`  AS SELECT `r`.`id` AS `review_id`, `r`.`date` AS `review_date`, `r`.`message` AS `review_msg`, `r`.`customer_id` AS `reviewer_id`, `u`.`name` AS `reviewer_name`, `u`.`photo` AS `reviewer_pic`, `r`.`star_count` AS `rating`, `p`.`id` AS `product_id`, `p`.`name` AS `product_name`, `p`.`shop_id` AS `shop_id` FROM ((`review` `r` join `product` `p` on(((`r`.`item_id` = `p`.`id`) and (`r`.`type` = 'product')))) join `user` `u` on((`u`.`id` = `r`.`customer_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `product_view`
--
DROP TABLE IF EXISTS `product_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_view`  AS SELECT `p`.`id` AS `id`, `p`.`name` AS `name`, `p`.`image` AS `image`, `p`.`description` AS `description`, `p`.`category` AS `category`, `p`.`price` AS `price`, `p`.`stock` AS `stock`, `p`.`unit` AS `unit`, `p`.`deleteFlag` AS `deleteFlag`, `p`.`shop_id` AS `shop_id`, `s`.`name` AS `shop_name`, count(`r`.`id`) AS `review_count`, avg(`r`.`star_count`) AS `avg_rating` FROM ((`product` `p` join `shop` `s` on((`p`.`shop_id` = `s`.`id`))) left join `review` `r` on(((`p`.`id` = `r`.`item_id`) and (`r`.`type` = 'product')))) GROUP BY `p`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `shop_review_view`
--
DROP TABLE IF EXISTS `shop_review_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `shop_review_view`  AS SELECT `s`.`id` AS `shop_id`, `s`.`name` AS `shop_name`, `s`.`badge` AS `shop_badge`, `s`.`image` AS `shop_img`, `r`.`id` AS `review_id`, `r`.`star_count` AS `rating`, `r`.`message` AS `review_msg`, `r`.`date` AS `review_on`, `u`.`id` AS `reviewer_id`, `u`.`name` AS `reviewer_name`, `u`.`photo` AS `reviewer_img` FROM ((`review` `r` join `shop` `s` on(((`r`.`item_id` = `s`.`id`) and (`r`.`type` = 'shop')))) left join `user` `u` on((`r`.`customer_id` = `u`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `shop_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
