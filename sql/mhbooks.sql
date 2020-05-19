-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2020 at 10:07 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `curtains`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(3) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `admin_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`, `fullName`, `admin_image`) VALUES
(1, 'momen@gmail.com', '123456789', 'Momen Hasanin                     ', 'uploads/admin/mm1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(3) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_image`) VALUES
(1, 'Art & Music', '5ebb26739c705'),
(2, 'Biographies', '5ebb288ab6a2e'),
(3, 'Business', '5ebb28f30d16e'),
(4, 'Computer & Tech', '5ebb2950748b2'),
(5, 'Cooking', '5ebb29d7e534e'),
(6, 'History', '5ebb2a2596fd7'),
(7, 'Horror', '5ebb2e996f9eb'),
(8, 'Science & Math', '5ebb2f1aea73e');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(5) NOT NULL,
  `cust_name` varchar(50) NOT NULL,
  `cust_email` varchar(50) NOT NULL,
  `cust_password` varchar(50) NOT NULL,
  `cust_mobile` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_email`, `cust_password`, `cust_mobile`) VALUES
(2, 'ahmad', 'ahmad@gmail.com', 'ahmad123', '962787067510');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cust_id` int(5) NOT NULL,
  `status` varchar(50) NOT NULL,
  `total_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `cust_id`, `status`, `total_price`) VALUES
(000001, '2020-05-17 05:56:58', 2, 'pending', 19.84),
(000004, '2020-05-17 06:07:31', 2, 'pending', 49.95),
(000005, '2020-05-17 06:16:29', 2, 'pending', 49.95),
(000006, '2020-05-17 06:19:22', 2, 'pending', 18.56),
(000007, '2020-05-17 06:21:18', 2, 'pending', 62.65),
(000008, '2020-05-17 06:49:11', 2, 'pending', 62.65),
(000009, '2020-05-17 06:52:21', 2, 'pending', 69.93),
(000010, '2020-05-17 07:02:29', 2, 'pending', 7.98);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_details_id` int(5) NOT NULL,
  `order_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `product_id` int(5) NOT NULL,
  `qty` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_details_id`, `order_id`, `product_id`, `qty`) VALUES
(1, 000001, 4, 4),
(2, 000002, 3, 12),
(3, 000003, 2, 5),
(4, 000004, 3, 5),
(5, 000005, 3, 5),
(6, 000006, 10, 2),
(7, 000006, 5, 2),
(8, 000007, 2, 7),
(9, 000007, 4, 7),
(10, 000008, 2, 7),
(11, 000008, 4, 7),
(12, 000009, 3, 7),
(13, 000010, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pro_id` int(5) NOT NULL,
  `pro_name` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `pro_price` float NOT NULL,
  `pro_img` varchar(50) NOT NULL,
  `pro_desc` varchar(250) NOT NULL,
  `state` int(11) NOT NULL,
  `cat_id` varchar(3) NOT NULL,
  `sub_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pro_id`, `pro_name`, `author`, `pro_price`, `pro_img`, `pro_desc`, `state`, `cat_id`, `sub_id`) VALUES
(1, 'Presepolis', 'Marjane Satrapi', 3.99, '5ebb4ee9c2132', 'A New York Times Notable Book A Time Magazine \"Best Comix of the Year\" A San Francisco Chronicle and Los Angeles Times Best-seller Wise, funny, and heartbreaking.                          ', 1, '1', 1),
(2, 'How the Irish Saved Civilization', 'Thomas Cahill', 3.99, '5ebb55ef9fef4', '                                The perfect St. Patrick -- the untold story of Irelands role in maintaining Western culture while the Dark Ages settled on Europe. Every year millions of Americans celebrate St.                            ', 1, '1', 1),
(3, 'Just Kids', ' Patti Smith', 9.99, '5ebb57a288c0e', 'WINNER OF THE NATIONAL BOOK AWARD It was the summer Coltrane died, the summer of love and riots, and the summer when a chance encounter in Brooklyn led two young people on a path of art, devotion, and initiation.', 1, '1', 1),
(4, 'Star Wars the Complete Visual Dictionary', 'Ryder Windham, Jason Fry, James Luceno, et al', 4.96, '5ebb58853632f', 'No Synopsis Available.', 0, '1', 2),
(5, 'The Lord of the Rings : The Making of the Movie Tr', 'Brian Sibley', 4.19, '5ebb58ca70470', 'From conceptual design to filming, this book explores the making of The Lord of the Rings movie trilogy, with interviews with cast members, commentary from the director, and hundreds of stunning behind-the-scenes images, many exclusive to this book.', 1, '1', 2),
(6, 'Harry Potter: Hogwarts and Beyond', 'Warner Bros. Entertainment, Inc. and Scholastic In', 4.79, '5ebb591a17759', 'The most lucrative film franchise EVER returns Follow Harry, Ron, and Hermione through six years at Hogwarts School of Witchcraft and Wizardry - from their first days at school to the Triwizard Tournament, the D.A., the Slug Club, and much more. Incl', 1, '1', 2),
(7, 'Hulk', 'Tom DeFalco', 5.09, '5ebb594a3f11e', 'No Synopsis Available.', 1, '1', 2),
(8, 'Drawing with Children : A Creative Teaching and Le', 'Mona Brookes', 3.99, '5ebb59afb5c34', 'No Synopsis Available.', 1, '1', 3),
(9, 'Technical Drawing', ' Henry Cecil Spencer, Alva Mitchell, James E. Nova', 4.16, '5ebb59e653a11', 'No Synopsis Available.', 0, '1', 2),
(10, 'Manga for the Beginner : Everything You Need to St', 'Christopher Hart', 5.09, '5ebb5a66761cf', 'Got manga? Christopher Hart is got manga, and he wants to share it with all his millions of readers--especially the beginners. With Manga for the Beginner , anyone who can hold a pencil can start drawing great manga characters right away.', 0, '1', 3),
(11, 'Thunderstruck', 'Erik Larson', 6.89, '5ebb6cd5e741e', 'No Synopsis Available.', 0, '2', 4),
(12, 'Survivors : True Stories of Children in the Holoca', 'Allan Zullo', 4.19, '5ebb6d855a920', 'Gripping and inspiring, these true stories of bravery, terror, and hope chronicle nine different children is experiences during the Holocaust.', 0, '2', 4),
(13, 'Over the Edge of the World', 'Laurence Bergreen', 17.75, '5ebb6ddd7e027', 'A middle-grade adaptation of Laurence Bergreen is adult bestseller, about Magellan is historic voyage around the globe.', 1, '2', 4),
(14, 'All But My Life', 'Gerda Weissmann Klein', 5.88, '5ebb6e1f26916', 'No Synopsis Available.', 0, '2', 4),
(15, 'Infidel', 'Ayaan Hirsi Ali', 4.69, '5ebb6e65d3b1a', 'One of today is most admired and controversial political figures, Ayaan Hirsi Ali burst into international headlines following the murder of Theo van Gogh by an Islamist who threatened that she would be next. ', 0, '2', 4),
(16, 'A Year in Provence', 'Peter Mayle', 4.19, '5ebb6eb227f03', 'No Synopsis Available.', 0, '2', 4);

-- --------------------------------------------------------

--
-- Table structure for table `sub_cat`
--

CREATE TABLE `sub_cat` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(50) NOT NULL,
  `cat_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_cat`
--

INSERT INTO `sub_cat` (`sub_id`, `sub_name`, `cat_id`) VALUES
(1, 'Art History', 1),
(2, 'Film', 1),
(3, 'Drawing', 1),
(4, 'Europe', 2),
(5, 'Military', 2),
(6, 'Careers', 3),
(7, 'finance', 3),
(8, 'Apple', 4),
(9, 'CAD', 4),
(10, 'Databases', 4),
(11, 'Baking', 5),
(12, 'Asian', 6),
(13, 'Black History', 6),
(14, 'African', 6),
(15, 'Vampires', 7),
(16, 'Biology', 8),
(17, 'Anatomy', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_details_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `sub_cat`
--
ALTER TABLE `sub_cat`
  ADD PRIMARY KEY (`sub_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pro_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sub_cat`
--
ALTER TABLE `sub_cat`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
