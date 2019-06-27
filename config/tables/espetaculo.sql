CREATE TABLE `espetaculo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkLocal` int(11) unsigned NOT NULL,
  `chrEspetaculo` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `espetaculo_fklocal_foreign` (`fkLocal`),
  CONSTRAINT `espetaculo_fklocal_foreign` FOREIGN KEY (`fkLocal`) REFERENCES `local` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
