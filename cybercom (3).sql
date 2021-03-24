-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2021 at 03:10 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

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
(1, 'raj', 'rajkandolia', 'Femal', '2021-03-20'),
(2, 'prince', 'princekandolia', 'Male', '2021-03-22');

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
(3, 'product', 'name', '3456', 'text', 'varchar', 4, 'Model\\Attribute\\Option'),
(5, 'product', 'size', '123', 'text', 'int', 4, 'Model\\Attribute\\Option'),
(6, 'product', 'color', '123', 'select', 'varchar', 3, 'Model\\Brand\\Option'),
(7, '', 'color', '12366', '', '', 4, '');

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
(1, 'material', 3, 2),
(2, 'size', 3, 1),
(3, 'color', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandId` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `image` varchar(250) NOT NULL,
  `sortOrder` int(4) NOT NULL,
  `status` varchar(10) NOT NULL,
  `createdDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `total` int(20) NOT NULL,
  `discount` int(10) NOT NULL,
  `paymentMethodId` int(11) NOT NULL,
  `shippingMethodId` int(11) NOT NULL,
  `shippingAmount` int(10) NOT NULL,
  `createdDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cartaddress`
--

CREATE TABLE `cartaddress` (
  `cartAddressId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `addressId` int(11) NOT NULL,
  `addressType` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `zip` int(11) NOT NULL,
  `sameAsBilling` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `cartItemId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(5) NOT NULL,
  `basePrice` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `discount` int(10) NOT NULL,
  `createdDate` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 0, '1', 'bedroom', '', ''),
(3, 1, '1=3', 'panelbed', '', ''),
(4, 3, '1=3=4', 'footer', '', ''),
(5, 3, '1=3=5', 'header', '', '');

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
(1, 'retail', 'raj', 'kandolia', 'raj@gamil', 'raj', 2345678, 'Disable', '2021-03-16', '2021-03-20'),
(2, 'retail', 'nirali', 'kandolia', 'nirali@gmail.com', 'xrctfvgyhujikolp', 4567890, 'Enable', '2021-03-16', '2021-03-21'),
(3, 'wholesale', 'prince', 'kandolia', 'prince@gmail.com', 'princeprince', 4567890, 'Enable', '2021-03-17', '2021-03-22'),
(4, 'wholesale', 'krunal', 'Ambaliya', 'krunal@gmail', '4dfgio', 345678, 'Enable', '2021-03-17', '0000-00-00'),
(5, 'wholesale', 'meet', 'patel', 'meet@gmail.com', 'meeet', 4567890, 'Enable', '2021-03-17', '2021-03-20');

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
(18, 2, 'billing', 'rajkot', 'rajkot', 'gujrat', 12344, 'India'),
(19, 2, 'shipping', 'rajkot', 'rajkot', 'gujrat', 12344, 'India'),
(22, 3, 'billing', 'rajkot', 'rajkot', 'gujrat', 12344, 'India'),
(23, 3, 'shipping', 'rajkot', 'rajkot', 'gujrat', 12344, 'India'),
(24, 1, 'billing', 'rajkot', 'rajkot', 'gujrat', 456789, 'India'),
(25, 1, 'shipping', 'veraval', 'varavl', 'gujrat', 0, 'India'),
(55, 4, 'billing', 'rajkot', 'rajkot', 'gujrat', 12344, 'India'),
(56, 4, 'shipping', 'rajkot', 'rajkot', 'gujrat', 12344, 'India'),
(57, 5, 'billing', 'rajkot', 'rajkot', 'gujrat', 12344, 'India'),
(58, 5, 'shipping', 'rajkot', 'rajkot', 'gujrat', 12344, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `customergroup`
--

CREATE TABLE `customergroup` (
  `customerGroupId` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `createdDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customergroup`
--

INSERT INTO `customergroup` (`customerGroupId`, `name`, `status`, `createdDate`) VALUES
(1, 'retail', 'Disable', '2021-03-20'),
(2, 'wholesale', 'Disable', '2021-03-20');

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
(1, 'reliance', 1, '', 'Enable', '2021-03-20');

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
  `brand` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `name`, `price`, `discount`, `quantity`, `status`, `description`, `brand`, `color`, `size`, `createdAt`, `updatedAt`) VALUES
(1, 'television', 20000, 10, 30, 'Enable', '                                ', NULL, NULL, NULL, '2021-03-20', '0000-00-00'),
(2, 'laptop', 950000, 10, 3, 'Disable', '                                ', NULL, NULL, NULL, '2021-03-22', '0000-00-00');

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
(1, 'reliance', 1, '12345', '', 'Disable', '2021-03-20');

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
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `cartaddress`
--
ALTER TABLE `cartaddress`
  ADD PRIMARY KEY (`cartAddressId`);

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`cartItemId`);

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
  MODIFY `attributeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `attributeoption`
--
ALTER TABLE `attributeoption`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cartaddress`
--
ALTER TABLE `cartaddress`
  MODIFY `cartAddressId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `cartItemId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `pageId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customeraddress`
--
ALTER TABLE `customeraddress`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `customergroup`
--
ALTER TABLE `customergroup`
  MODIFY `customerGroupId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `methodId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `productgroupprice`
--
ALTER TABLE `productgroupprice`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `productimage`
--
ALTER TABLE `productimage`
  MODIFY `imageId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `methodId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attributeoption`
--
ALTER TABLE `attributeoption`
  ADD CONSTRAINT `attributeoption_ibfk_1` FOREIGN KEY (`attributeId`) REFERENCES `attribute` (`attributeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customeraddress`
--
ALTER TABLE `customeraddress`
  ADD CONSTRAINT `customeraddress_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
