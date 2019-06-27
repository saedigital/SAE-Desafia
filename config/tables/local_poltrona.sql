
CREATE TABLE `local_poltrona` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkLocal` int(11) unsigned NOT NULL,
  `chrCodigo` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `local_poltronas_fklocal_foreign` (`fkLocal`),
  CONSTRAINT `local_poltronas_fklocal_foreign` FOREIGN KEY (`fkLocal`)
  REFERENCES `local` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;