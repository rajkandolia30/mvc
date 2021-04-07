-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2021 at 08:36 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cybercom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(100) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `status` varchar(5) NOT NULL,
  `createdDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `userName`, `password`, `status`, `createdDate`) VALUES
(1, 'raj', '', 'Femal', '2021-04-05'),
(2, 'prince', '', '', '2021-04-05');

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `attributeId` int(11) NOT NULL,
  `entityTypeId` varchar(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `code` varchar(20) NOT NULL,
  `inputType` varchar(20) NOT NULL,
  `backendType` varchar(60) NOT NULL,
  `sortOrder` int(4) NOT NULL,
  `backendModel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attributeId`, `entityTypeId`, `name`, `code`, `inputType`, `backendType`, `sortOrder`, `backendModel`) VALUES
(3, 'product', 'name', '3456', 'text', 'varchar', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attributeoption`
--

CREATE TABLE `attributeoption` (
  `optionId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `attributeId` int(11) NOT NULL,
  `sortOrder` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attributeoption`
--

INSERT INTO `attributeoption` (`optionId`, `name`, `attributeId`, `sortOrder`) VALUES
(16, 'color', 3, 2),
(17, 'size', 3, 0),
(18, 'size', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `sessionId` varchar(50) NOT NULL,
  `total` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `paymentMethodId` int(11) NOT NULL,
  `shippingMethodId` int(11) NOT NULL,
  `shippingAmount` int(11) NOT NULL,
  `createdDate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `customerId`, `sessionId`, `total`, `discount`, `paymentMethodId`, `shippingMethodId`, `shippingAmount`, `createdDate`) VALUES
(1, 1, '', 50300, 0, 3, 3, 0, '2021-04-06 06:11:22.000000'),
(2, 2, '', 310500, 0, 1, 1, 200, '2021-04-06 06:11:49.000000'),
(3, 3, '', 0, 0, 0, 0, 0, '2021-04-06 06:12:13.000000'),
(4, 4, '', 0, 0, 0, 0, 0, '2021-04-06 06:12:23.000000'),
(5, 5, '', 0, 0, 0, 0, 0, '2021-04-06 06:12:45.000000'),
(6, 0, '', 0, 0, 0, 0, 0, '2021-04-07 06:16:32.000000');

-- --------------------------------------------------------

--
-- Table structure for table `cartaddress`
--

CREATE TABLE `cartaddress` (
  `cartAddressId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `addressId` varchar(11) NOT NULL,
  `addressType` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(11) NOT NULL,
  `zipcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cartaddress`
--

INSERT INTO `cartaddress` (`cartAddressId`, `cartId`, `addressId`, `addressType`, `address`, `city`, `state`, `country`, `zipcode`) VALUES
(1, 1, '1', 'billing', 'address 1', 'address 1', 'address 1', 'India', 1),
(2, 2, '2', 'billing', 'address 2', 'address 2', 'address 2', 'India', 1),
(3, 1, '3', 'shipping', 'address 1', 'address 1', 'address 1', 'India', 1),
(5, 2, '', 'shipping', 'address 2', 'address 2', 'address 2', 'India', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `cartItemId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `basePrice` int(11) NOT NULL DEFAULT current_timestamp(),
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `createdDate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cartitem`
--

INSERT INTO `cartitem` (`cartItemId`, `cartId`, `productId`, `quantity`, `basePrice`, `price`, `discount`, `createdDate`) VALUES
(11, 4, 73, 5, 400000, 80000, 0, '0000-00-00 00:00:00.000000'),
(12, 4, 72, 11, 550000, 50000, 0, '0000-00-00 00:00:00.000000'),
(13, 4, 74, 2, 600, 300, 0, '0000-00-00 00:00:00.000000'),
(14, 4, 77, 5, 5000, 1000, 0, '0000-00-00 00:00:00.000000'),
(16, 2, 74, 1, 300, 300, 0, '0000-00-00 00:00:00.000000'),
(18, 2, 73, 3, 240000, 80000, 0, '0000-00-00 00:00:00.000000'),
(19, 3, 77, 1, 1000, 1000, 0, '0000-00-00 00:00:00.000000'),
(20, 5, 74, 1, 300, 300, 0, '0000-00-00 00:00:00.000000'),
(21, 5, 72, 1, 50000, 50000, 0, '0000-00-00 00:00:00.000000'),
(22, 1, 74, 1, 300, 300, 0, '0000-00-00 00:00:00.000000'),
(23, 3, 72, 1, 2147483647, 50000, 0, '0000-00-00 00:00:00.000000'),
(24, 1, 72, 1, 50000, 50000, 0, '0000-00-00 00:00:00.000000'),
(25, 2, 72, 2, 100000, 50000, 0, '0000-00-00 00:00:00.000000'),
(26, 6, 72, 1, 2147483647, 50000, 0, '0000-00-00 00:00:00.000000'),
(27, 2, 77, 1, 1000, 1000, 0, '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(100) NOT NULL,
  `parentId` int(100) DEFAULT 0,
  `pathId` varchar(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `parentId`, `pathId`, `name`, `status`, `description`) VALUES
(1, 5, '5=1', 'bedroom', 'Enable', ''),
(2, 1, '5=1=2', 'bed', 'Enable', ''),
(3, 2, '5=1=2=3', 'panel', '', ''),
(4, 3, '5=1=2=3=4', 'panelbed', '', ''),
(5, 0, '5=5=5', 'hall', 'Disable', ''),
(15, 0, '=15=15', 'room', 'Enable', 'room');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `pageId` int(100) NOT NULL,
  `title` varchar(40) NOT NULL,
  `identifier` varchar(20) NOT NULL,
  `content` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `createdDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`pageId`, `title`, `identifier`, `content`, `status`, `createdDate`) VALUES
(3, 'blog', '', '<p>fashion bloger</p>\r\n', 'Disable', '2021-03-09'),
(6, 'example', '', '', 'Disable', '2021-03-11');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(100) NOT NULL,
  `groupId` varchar(11) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobile` int(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `createdDate` date NOT NULL,
  `updatedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `groupId`, `firstName`, `lastName`, `email`, `password`, `mobile`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 'retail', 'raj', 'kandolia', 'raj@gamil', 'raj', 2345678, 'Disable', '2021-03-16', '0000-00-00'),
(2, '', 'nirali', 'kandolia', 'nirali@gmail.com', 'xrctfvgyhujikolp', 4567890, 'Enable', '2021-03-16', '2021-03-17'),
(3, 'retail', 'prince', 'kandolia', 'prince@gmail.com', 'princeprince', 4567890, 'Enable', '2021-03-17', '0000-00-00'),
(4, 'wholesale', 'krunal', 'Ambaliya', 'krunal@gmail', '4dfgio', 345678, 'Enable', '2021-03-17', '0000-00-00'),
(5, 'regular', 'meet', 'patel', 'meet@gmail.com', 'meeet', 4567890, 'Enable', '2021-03-17', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `customeraddress`
--

CREATE TABLE `customeraddress` (
  `addressId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `addressType` varchar(10) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(10) NOT NULL,
  `state` varchar(10) NOT NULL,
  `zipcode` int(10) NOT NULL,
  `country` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customeraddress`
--

INSERT INTO `customeraddress` (`addressId`, `customerId`, `addressType`, `address`, `city`, `state`, `zipcode`, `country`) VALUES
(1, 1, 'billing', 'address 1', 'address 1', 'address 1', 1, 'India'),
(2, 2, 'billing', 'address 2', 'address 2', 'address 2', 1, 'India'),
(3, 1, 'shipping', 'address 1', 'address 1', 'address 1', 1, 'India'),
(5, 2, 'shipping', 'address 2', 'address 2', 'address 2', 1, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `customergroup`
--

CREATE TABLE `customergroup` (
  `customerGroupId` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `createdDate` date NOT NULL,
  `group` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customergroup`
--

INSERT INTO `customergroup` (`customerGroupId`, `name`, `status`, `createdDate`, `group`) VALUES
(6, 'retail', 'Disable', '2021-03-04', ''),
(7, 'wholesale', 'Disable', '2021-03-04', ''),
(18, 'regular', 'Enable', '2021-03-17', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `methodId` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `code` int(10) NOT NULL,
  `description` varchar(250) NOT NULL,
  `status` varchar(10) NOT NULL,
  `createdAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`methodId`, `name`, `code`, `description`, `status`, `createdAt`) VALUES
(1, 'Credit card', 0, '', 'Enable', '2021-04-05'),
(2, 'Debit Card', 0, '', 'Enable', '2021-04-05'),
(3, 'cod', 0, '', 'Enable', '2021-04-05'),
(4, 'paypal', 0, '', 'Enable', '2021-04-05');

-- --------------------------------------------------------

--
-- Table structure for table `placeorder`
--

CREATE TABLE `placeorder` (
  `orderId` int(11) NOT NULL,
  `sessionId` int(50) NOT NULL,
  `customerId` int(11) NOT NULL,
  `total` int(10) NOT NULL,
  `discount` int(10) NOT NULL,
  `paymentMethodId` int(11) NOT NULL,
  `shippingMethodId` int(11) NOT NULL,
  `shippingAmount` int(10) NOT NULL,
  `createdDate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `placeorder`
--

INSERT INTO `placeorder` (`orderId`, `sessionId`, `customerId`, `total`, `discount`, `paymentMethodId`, `shippingMethodId`, `shippingAmount`, `createdDate`) VALUES
(1, 0, 2, 310500, 0, 1, 1, 200, '2021-04-07 08:16:15.000000');

-- --------------------------------------------------------

--
-- Table structure for table `placeorderaddress`
--

CREATE TABLE `placeorderaddress` (
  `orderAddressId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `addressId` int(11) NOT NULL,
  `addressType` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(10) NOT NULL,
  `state` varchar(10) NOT NULL,
  `country` varchar(10) NOT NULL,
  `zipcode` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `placeorderitem`
--

CREATE TABLE `placeorderitem` (
  `orderItemId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(10) NOT NULL,
  `basePrice` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `discount` int(10) NOT NULL,
  `createdDate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `discount` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `description` varchar(250) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `name`, `price`, `discount`, `quantity`, `status`, `description`, `createdAt`, `updatedAt`) VALUES
(72, 'telivision', 50000, 0, 4, 'Disable', 'samsung            ', '2021-03-01', '0000-00-00'),
(73, 'laptop', 80000, 0, 9, 'Disable', 'dell', '2021-03-01', '0000-00-00'),
(74, 'books', 300, 0, 0, 'Disable', '                java                           ', '2021-03-01', '2021-03-14'),
(77, 'ep', 1000, 0, 0, 'Disable', '                                boat                                             ', '2021-03-01', '2021-03-14');

-- --------------------------------------------------------

--
-- Table structure for table `productgroupprice`
--

CREATE TABLE `productgroupprice` (
  `entityId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `groupPrice` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productgroupprice`
--

INSERT INTO `productgroupprice` (`entityId`, `productId`, `groupId`, `groupPrice`) VALUES
(1, 72, 14, 0),
(2, 77, 6, 100),
(3, 77, 7, 200),
(4, 72, 6, 400000),
(5, 72, 7, 40000),
(6, 72, 18, 50000),
(7, 77, 18, 3000),
(8, 74, 6, 2000),
(9, 74, 7, 200),
(10, 74, 18, 0);

-- --------------------------------------------------------

--
-- Table structure for table `productimage`
--

CREATE TABLE `productimage` (
  `imageId` int(100) NOT NULL,
  `productId` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `label` varchar(10) NOT NULL,
  `small` varchar(10) NOT NULL,
  `thumb` varchar(10) NOT NULL,
  `base` varchar(10) NOT NULL,
  `gallery` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productimage`
--

INSERT INTO `productimage` (`imageId`, `productId`, `image`, `label`, `small`, `thumb`, `base`, `gallery`) VALUES
(10, 72, '43107701_72_20150816_091942.jpg', '0', 'on', '0', '0', 'on'),
(11, 72, '54686500_72_20150816_091942.jpg', '0', '0', 'on', '0', 'on'),
(12, 72, '4325676_72_20150816_091942.jpg', '0', '0', '0', 'on', 'on'),
(13, 72, '53835010_72_20150816_091942.jpg', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `methodId` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `code` int(10) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `description` varchar(250) NOT NULL,
  `status` varchar(10) NOT NULL,
  `createdAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`methodId`, `name`, `code`, `amount`, `description`, `status`, `createdAt`) VALUES
(1, 'Express - 1 Day', 0, '200', '', 'Enable', '2021-04-05'),
(2, 'Platinum - 3 Days  ', 0, '100', '', 'Enable', '2021-04-05'),
(3, 'Free delivery - 7 Da', 0, '0', '', 'Enable', '2021-04-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`attributeId`);

--
-- Indexes for table `attributeoption`
--
ALTER TABLE `attributeoption`
  ADD PRIMARY KEY (`optionId`),
  ADD KEY `attributeoption_ibfk_1` (`attributeId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `cartaddress`
--
ALTER TABLE `cartaddress`
  ADD PRIMARY KEY (`cartAddressId`),
  ADD KEY `cartId` (`cartId`);

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`cartItemId`),
  ADD KEY `cartId` (`cartId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`pageId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `customeraddress`
--
ALTER TABLE `customeraddress`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `customergroup`
--
ALTER TABLE `customergroup`
  ADD PRIMARY KEY (`customerGroupId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `placeorder`
--
ALTER TABLE `placeorder`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `placeorderaddress`
--
ALTER TABLE `placeorderaddress`
  ADD PRIMARY KEY (`orderAddressId`);

--
-- Indexes for table `placeorderitem`
--
ALTER TABLE `placeorderitem`
  ADD PRIMARY KEY (`orderItemId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `productgroupprice`
--
ALTER TABLE `productgroupprice`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `groupId` (`groupId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `productimage`
--
ALTER TABLE `productimage`
  ADD PRIMARY KEY (`imageId`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`methodId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `attributeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attributeoption`
--
ALTER TABLE `attributeoption`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cartaddress`
--
ALTER TABLE `cartaddress`
  MODIFY `cartAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `cartItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `pageId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customeraddress`
--
ALTER TABLE `customeraddress`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customergroup`
--
ALTER TABLE `customergroup`
  MODIFY `customerGroupId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `methodId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `placeorder`
--
ALTER TABLE `placeorder`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `placeorderaddress`
--
ALTER TABLE `placeorderaddress`
  MODIFY `orderAddressId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `placeorderitem`
--
ALTER TABLE `placeorderitem`
  MODIFY `orderItemId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `productgroupprice`
--
ALTER TABLE `productgroupprice`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `productimage`
--
ALTER TABLE `productimage`
  MODIFY `imageId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `methodId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attributeoption`
--
ALTER TABLE `attributeoption`
  ADD CONSTRAINT `attributeoption_ibfk_1` FOREIGN KEY (`attributeId`) REFERENCES `attribute` (`attributeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cartaddress`
--
ALTER TABLE `cartaddress`
  ADD CONSTRAINT `cartaddress_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`);

--
-- Constraints for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `cartitem_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customeraddress`
--
ALTER TABLE `customeraddress`
  ADD CONSTRAINT `customeraddress_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
