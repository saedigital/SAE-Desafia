
CREATE TABLE `espetaculo_reserva` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkPoltrona`  int(11) unsigned NOT NULL,
  `fkEspetaculo`  int(11) unsigned NOT NULL,
  `dttReserva` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  KEY `espetaculo_reserva_fkpoltrona_foreign` (`fkPoltrona`),
  CONSTRAINT `espetaculo_reserva_fkpoltrona_foreign` FOREIGN KEY (`fkPoltrona`)
    REFERENCES `local_poltrona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  KEY `espetaculo_reserva_fkespetaculo_foreign` (`fkEspetaculo`),
  CONSTRAINT `espetaculo_reserva_fkespetaculo_foreign` FOREIGN KEY (`fkEspetaculo`)
    REFERENCES `espetaculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;