

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `from` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `to` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `when` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `room` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `extra` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;
