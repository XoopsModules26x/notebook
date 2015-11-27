#
# Table structure for table `notebook`
#

CREATE TABLE `notebook` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `uid_creator` int(11) NOT NULL DEFAULT '0',
  `uid_attributed` varchar(255) NOT NULL,
  `date_created` int(10) NOT NULL DEFAULT '0',
  `date_finished` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;
