CREATE TABLE IF NOT EXISTS `Shoppingcart` (
`UserName` varchar(50) NOT NULL REFERENCES `user`(`UserName`),
`BookID` int(10) NOT NULL REFERENCES `book`(`BookID`),
PRIMARY KEY(`UserName`,`BookID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;