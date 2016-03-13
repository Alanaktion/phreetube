CREATE TABLE `video` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(160) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `filename` varchar(160) NOT NULL,
  `mime_type` varchar(64) NOT NULL,
  `date_added` datetime NOT NULL,
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB
