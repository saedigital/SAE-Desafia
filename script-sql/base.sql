create table sae_espetaculo (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(200) NOT NULL,
    `qtd_poltronas` INT(5) NOT NULL,
    `data_espetaculo` datetime NOT NULL,
    `data_criacao` datetime DEFAULT CURRENT_TIMESTAMP,
    `data_atualizacao` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `status` INT(1)
);

create table sae_reserva_poltrona_espetaculo (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `idfk_espetaculo` INT(5) NOT NULL,
    `numero_poltrona` INT(5) NOT NULL
);

