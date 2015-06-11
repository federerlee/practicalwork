
/*CREATE DATABASE dbe4lguoli1;


USE dbe4lguoli1;
customers_authproducts
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";*/


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `angularcode_products`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `mrp` double NOT NULL,
  `description` varchar(500) NOT NULL,
  `packing` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL,
  `category` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=951 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `price`, `mrp`, `description`, `packing`, `image`, `category`, `stock`, `status`) VALUES
(138, 5053, 'Aramusk Bath Soap For Men   ', 108, 108, '', '3 X 125 g ', 'aramusk-bath-soap-for-men-3-x-125-g.png', 140, 100, 'Active'),
(248, 386, 'Adidas Deo Ice Dive Deo Body Spray   ', 199, 199, '', '150 ml ', 'adidas-adidas-body-deo-ice-dive-150-ml.png', 130, 20, 'Inactive'),
(318, 6124, 'Baba Ramdev Patanjali Anti Bacterial Herbal Hand Wash Refill   ', 40, 40, '', '200 ml ', 'baba-ramdev-patanjali-anti-bacterial-herbal-hand-wash-refill-200-ml.png', 160, 50, 'Inactive'),
(432, 5625, 'Adidas Ice Dive Shower Gel   ', 150, 150, '', '250 ml ', 'adidas-ice-dive-shower-gel-250-ml.png', 170, 0, 'Active'),
(448, 2298, 'Axe Denim Cologne Talc   ', 115, 115, '', '300 g ', '1327941212-Jan30-1147.png', 180, 0, 'Active'),
(490, 8909, 'All Out Off Family Insect Repellent Lotion   ', 39, 39, '', '50 ml ', 'missingimagegr200.png', 190, 0, 'Active'),
(589, 4202, 'Baba Ramdev Patanjali Gulab Jal   ', 25, 25, '', '120 ml ', 'patanjali-gulab-jal-120-ml.png', 220, 0, 'Active'),
(722, 8068, 'Areev Melon &amp; Peach Mild Shampoo   ', 275, 275, '', '300 ml ', 'areev-melon-peach-mild-shampoo-v-300-ml-3.png', 200, 0, 'Active'),
(769, 8152, '18 Herbs K-Oil 100% Herbal Care   ', 275, 275, 'Hair Oil', '100 ml ', '18-herbs-18-herbs-k-oil-100-herbal-care-100-ml-1.png', 210, 100, 'Active'),
(797, 8273, 'Baba Ramdev Patanjali Kesh Kanti Anti Dandruff Hair Cleanser With Natural Conditioner   ', 110, 110, 'Anti Dandruff Shampoo', '200 ml ', 'baba-ramdev-patanjali-kesh-kanti-hair-cleanser-with-natural-conditioner-200-ml.png', 230, 22, 'Active'),
(901, 3936, 'Roots Hair Brush 2011   ', 175, 175, 'Hair Brush', '1 pc ', 'roots-hair-brush-2011-1-pc.png', 240, 5, 'Active'),
(918, 4273, 'Biotique Bio Henna Fresh Powder Hair Color   ', 199, 199, 'Powder', '90 g ', 'biotique-bio-henna-fresh-powder-hair-color-90-g.png', 250, 50, 'Active'),
(943, 7904, 'Brylcreem Anti Dandruff Aqua Oxy Hair Gel   ', 400, 40, 'Hair Gel', '50 g ', 'brylcreem-brylcreem-anti-dandruff-aqua-oxy-hair-gel-50-g.png', 260, 15, 'Active'),
(949, 5848, 'Ayur Natural Rajasthani Heena Mehendi   ', 11, 25, 'Mehendi.', '100 gm', 'ayur-natural-rajasthani-heena-mehendi-100-g.png', 270, 150, 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


DROP TABLE IF EXISTS `customers_auth`;

CREATE TABLE IF NOT EXISTS `customers_auth` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=187 ;

--
-- Dumping data for table `customers_auth`
--

INSERT INTO `customers_auth` (`uid`, `name`, `email`, `phone`, `password`, `address`, `city`, `created`) VALUES
(169, 'Swadesh Behera', 'swadesh@gmail.com', '1234567890', '$2a$10$251b3c3d020155f7553c1ugKfEH04BD6nbCbo78AIDVOqS3GVYQ46', '4092 Furth Circle', 'Singapore', '2014-08-31 18:21:20'),
(170, 'Ipsita Sahoo', 'ipsita@gmail.com', '1111111111', '$2a$10$d84ffcf46967db4e1718buENHT7GVpcC7FfbSqCLUJDkKPg4RcgV2', '2, rue du Commerce', 'NYC', '2014-08-31 18:30:58'),
(171, 'Trisha Tamanna Priyadarsini', 'trisha@gmail.com', '2222222222', '$2a$10$c9b32f5baa3315554bffcuWfjiXNhO1Rn4hVxMXyJHJaesNHL9U/O', 'C/ Moralzarzal, 86', 'Burlingame', '2014-08-31 18:32:03'),
(172, 'Sai Rimsha', 'rimsha@gmail.com', '3333333333', '$2a$10$477f7567571278c17ebdees5xCunwKISQaG8zkKhvfE5dYem5sTey', '897 Long Airport Avenue', 'Madrid', '2014-08-31 20:34:21'),
(173, 'Satwik Mohanty', 'satwik@gmail.com', '4444444444', '$2a$10$2b957be577db7727fed13O2QmHMd9LoEUjioYe.zkXP5lqBumI6Dy', 'Lyonerstr. 34', 'San Francisco\n', '2014-08-31 20:36:02'),
(174, 'Tapaswini Sahoo', 'linky@gmail.com', '5555555555', '$2a$10$b2f3694f56fdb5b5c9ebeulMJTSx2Iv6ayQR0GUAcDsn0Jdn4c1we', 'ul. Filtrowa 68', 'Warszawa', '2014-08-31 20:44:54'),
(175, 'Manas Ranjan Subudhi', 'manas@gmail.com', '6666666666', '$2a$10$03ab40438bbddb67d4f13Odrzs6Rwr92xKEYDbOO7IXO8YvBaOmlq', '5677 Strong St.', 'Stavern\n', '2014-08-31 20:45:08'),
(178, 'AngularCode Administrator', 'admin@angularcode.com', '0000000000', '$2a$10$72442f3d7ad44bcf1432cuAAZAURj9dtXhEMBQXMn9C8SpnZjmK1S', 'C/1052, Bangalore', '', '2014-08-31 21:00:26');
