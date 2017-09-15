CREATE TABLE IF NOT EXISTS `daitaction2category` (
  `OXID` varchar(32) NOT NULL COMMENT 'Record id',
  `OXACTIONID` varchar(32) NOT NULL COMMENT 'Action id (oxactions)',
  `OXCATID` varchar(32) NOT NULL COMMENT 'Category id (oxcategories)',
  PRIMARY KEY (`OXID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

