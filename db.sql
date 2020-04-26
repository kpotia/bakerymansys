create database bakman;

	use bakman;
--
-- Table structure for table `tbl_product`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` Decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;


CREATE TABLE `order`(
  `id` INT(10) AUTO_INCREMENT,
  `customer_name` VARCHAR(10),
  `order_date` datetime,
  `total` Decimal(8,2),
  PRIMARY KEY(id)
);


CREATE TABLE `order_details`(
  `orderID` INT(10),
  `productID`  int(11),
  `qty` int(3),
  `sub_total` Decimal(8,2)
);
