DROP TABLE IF EXISTS `#__private_label`;
DROP TABLE IF EXISTS `#__private_label_pages`;
DROP TABLE IF EXISTS `#__private_label_users`;

CREATE TABLE `#__private_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subdomain` BOOLEAN NOT NULL DEFAULT 0,
  `label` varchar(200) NOT NULL,
  `virtual_domain_id` INT(11),
  `enabled` BOOLEAN NOT NULL DEFAULT 0,
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE `#__private_label_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `role_id` int(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE `#__private_label_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

INSERT INTO `#__private_label` (`label`, `subdomain`, `enabled`) VALUES
        ('primary', 0, 1);

INSERT INTO `#__private_label_users` (`user_id`)
  SELECT DISTINCT id FROM `#__users` ON DUPLICATE KEY UPDATE user_id=VALUES(user_id);

