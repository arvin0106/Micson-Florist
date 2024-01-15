
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db_shopping_cart`
--
CREATE DATABASE IF NOT EXISTS `db_shopping_cart` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_shopping_cart`;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `OID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ORDER_NO` varchar(45) NOT NULL DEFAULT '',
  `ORDER_DATE` date NOT NULL DEFAULT '0000-00-00',
  `UID` int(10) unsigned NOT NULL DEFAULT '0',
  `TOTAL_AMT` double(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`OID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `OID` int(10) unsigned NOT NULL DEFAULT '0',
  `PID` int(10) unsigned NOT NULL DEFAULT '0',
  `PNAME` varchar(45) NOT NULL DEFAULT '',
  `PRICE` double(10,2) NOT NULL DEFAULT '0.00',
  `QTY` int(10) unsigned NOT NULL DEFAULT '0',
  `TOTAL` double(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `PID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PRODUCT` varchar(45) NOT NULL DEFAULT '',
  `PRICE` double(10,2) NOT NULL DEFAULT '0.00',
  `IMAGE` varchar(45) NOT NULL DEFAULT '',
  `DESCRIPTION` text,
  PRIMARY KEY (`PID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`PID`, `PRODUCT`, `PRICE`, `IMAGE`, `DESCRIPTION`) VALUES
(1, 'Sunshine',150.00, '1.png', 'Medium come with 2 stalks of sunflower,roses,daisy and small bear.'),
(2, 'Maltida', 180.00, '2.png', 'Medium Large come with 12 stalk of roses and baby breath.'),
(3, 'Gradua Love', 150.00, '3.png', 'Medium handcraft flower and winniethepooh'),
(4, 'Tea Mo', 185.00, '4.png', 'Medium Large come with 8 stalk of tulip.'),
(5, 'Sweet Love', 55.00, '5.png', 'Small come with 3 stalk of roses.'),
(7, 'Wedding Dress', 70.00, '6.png', 'Small come with baby breath.'),
(8, 'White Love', 60.00, '7.png', 'Small come with 3 stalk of roses, eucalyptus.'),
(9, 'Lock Your Love', 180.00, '8.png', 'Medium Large'),
(10, 'Lock Your Love', 180.00, '9.png', 'Medium Large'),
(11, 'Hilary', 120.00, '10.png', 'Medium Small come with 6 stalk of roses.'),
(12, 'You re Mine', 60.00, '11.png', 'Small come with 1 stalk of roses,caspia and daisy'),
(13, 'Mini Love', 60.00, '12.png', 'Small handmade love.'),
(14, 'Birthday Wish', 140.00, '13.png', 'Medium come with 8 stalk of roses.'),
(15, 'In The Moon', 80.00, '14.png', 'Small come with baby breath in non-helium balloon.'),
(16, 'Rabbit Love', 120.00, '15.png', 'Medium small with 7 stalks roses.'),
(17, 'Sweet Heart', 138.00, '16.png', 'Medium small with handcraft flower.'),
(18, 'Magical Moment', 150.00, '17.png', 'Medium come with 10 stalk of roses.'),
(19, 'Glamorous', 80.00, '18.png', 'Small come with 4 roses, baby breath.'),
(20, 'Hilary', 100.00, '19.png', 'Medium Small come with 5 stalk of roses and caspia.'),
(21, 'Lock Your Love', 89.00, '20.png', 'Small'),
(22, 'Loving Wish', 220.00, '21.png', 'Medium come with 22 stalks roses and caspia.'),
(23, 'Kissy Baby', 98.00, '22.png', 'Medium come with 7 stalk of roses.'),
(24, 'Romance Love', 100.00, '23.png', 'Medium small with handcraft flower.'),
(25, 'Romeo', 180.00, '24.png', 'Medium with handcraft flower.'),
(26, 'Balloon Flower Bouquet', 120.00, '25.png', 'Large come with 6 stalks pastel flower balloons.'),
(27, 'Forever U', 120.00, '26.png', 'Medium small with handcraft flower.'),
(28, 'Balloon Flower Bouquet', 140.00, '27.png', 'Large come with 9 stalks pastel flower balloons.'),
(29, 'Grand Love', 88.00, '28.png', 'Medium Small come with 3 stalk of roses with chamomile.'),
(30, 'Clara Chamomile Bouquet', 89.00, '29.png', 'Being known as “energy during adversity” which represent a powerful, tough soul in storms.'),
(31, 'Zara', 100.00, '30.png', 'Large come with 18 stalk of roses and baby breath.'),
(32, 'Princess Garden', 480.00, '31.png', 'Large come with 50 stalk of roses and a princess crown.'),
(33, 'Love Blossom', 55.00, '32.png', 'Small come with 4 stalk of roses.'),
(34, 'Magical Moment', 168.00, '33.png', 'Medium come with 13 stalk of roses.'),
(35, 'Melt Your Heart', 120.00, '34.png', 'Medium small come with 5 stalk of roses and eucalyptus.'),
(36, 'The One One', 120.00, '35.png', 'Medium come with 7 stalk of roses.'),
(37, 'BlackPink', 100.00, '36.png', 'Medium come with 7 stalk of roses.'),
(38, 'Elle', 80.00, '37.png', 'Medium small come with 3 stalk of roses and eucalyptus.'),
(39, 'Sweet Love', 100.00, '38.png', 'Medium small come with 6 stalk of roses.'),
(40, 'Fluorescence', 130.00, '39.png', 'Medium come with 7 stalk of roses.'),
(41, 'Sweet Sucess', 150.00, '40.png', 'Medium small come with 5 stalk handcraft roses and eucalyptus.'),
(42, 'Lucky Bloom', 350.00, '41.png', 'Large come with fortune cat, preserved flower,dry flower and etc.'),
(43, 'Amour', 150.00, '42.png', 'Medium Large come with 12 stalk of roses.'),
(44, 'Huggable Flower Balloon Bouquet', 120.00, '43.png', 'Large come with 7 stalks pastel flower balloons.'),
(45, 'Ms Tulip', 120.00, '44.png', 'Medium small come with 10 stalk of tulip and baby breath.'),
(46, 'Small Flower Balloon', 15.00, '45.png', '1 stalk pastel flower balloons.'),
(47, 'Grateful Heart', 128.00, '46.png', 'Medium small come with 9 stalks roses.'),  
(48, 'Colour Baby Moon', 200.00, '47.png', 'Moon shape baby breath.'),
(49, 'Love Blossom', 250.00, '48.png', 'Large come with 40 staks of roses.'),
(50, 'Pinky Promise', 150.00, '49.png', 'Medium small come with 5 stalks roses,baby breath and etc.'),
(51, 'Helene', 180.00, '50.png', 'Medium Large come with 10 stalks of roses.');

-- --------------------------------------------------------

-- Table structure for table `users`
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FIRST_NAME` varchar(100) NOT NULL DEFAULT '',
  `LAST_NAME` varchar(100) NOT NULL DEFAULT '',
  `EMAIL_ADDRESS` varchar(150) NOT NULL DEFAULT '',
  `PHONE` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table structure for table `shipping_details`
CREATE TABLE IF NOT EXISTS `shipping_details` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) NOT NULL,
  `FIRST_NAME` varchar(100) NOT NULL DEFAULT '',
  `LAST_NAME` varchar(100) NOT NULL DEFAULT '',
  `EMAIL_ADDRESS` varchar(150) NOT NULL DEFAULT '',
  `PHONE` varchar(20) NOT NULL DEFAULT '',
  `COMPANY_NAME` varchar(150) DEFAULT NULL,
  `SHIPPING_ADDRESS_LINE_1` varchar(255) NOT NULL DEFAULT '',
  `SHIPPING_ADDRESS_LINE_2` varchar(255) DEFAULT NULL,
  `COUNTRY_REGION` varchar(100) NOT NULL DEFAULT '',
  `STATE` varchar(100) NOT NULL DEFAULT '',
  `CITY` varchar(100) NOT NULL DEFAULT '',
  `POSTCODE` varchar(20) NOT NULL DEFAULT '',
  `PICKUP_DATE` DATE NOT NULL,
  `DELIVERY_TIME` VARCHAR(20) NOT NULL,
  `REMARK` text,
  PRIMARY KEY (`ID`),
  INDEX `uid_index` (`UID`),
  CONSTRAINT `fk_user_shipping`
  FOREIGN KEY (`UID`)
  REFERENCES `users` (`ID`)
  ON DELETE CASCADE
  ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE pickup_detail (
    `id` INT(100) AUTO_INCREMENT PRIMARY KEY,
    `UID` INT(100) NOT NULL,
    `FIRST_NAME` VARCHAR(50) NOT NULL,
    `LAST_NAME` VARCHAR(50) NOT NULL,
    `EMAIL_ADDRESS` VARCHAR(100) NOT NULL,
    `PHONE` VARCHAR(20) NOT NULL,
    `REMARK` TEXT,
    `PICKUP_DATE` DATE NOT NULL,  -- New column for pickup date
    `CREATED_AT` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `uid_index` (`UID`),
    FOREIGN KEY (`UID`)
    REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

