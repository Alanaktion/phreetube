CREATE TABLE `video` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `title` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
    `description` text COLLATE utf8_unicode_ci NOT NULL,
    `slug` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
    `filename` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
    `mime_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
    `date_added` datetime NOT NULL,
    `views` int(10) unsigned NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
