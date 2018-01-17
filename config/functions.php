<?php
/**
 * Arquivo que contém as consultas no banco
 * Criado em janeiro/2018 
 * @author: Ander
 */

/**
 * Função para mostrar o valor em moeda nacional
 * @param float $valor = Valor
 * @return string $valor_moeda = Texto com notação da moeda
 */
function moeda($valor) {
    $valor_moeda = 'R$ ' . number_format($valor, 2, ',', '.');
    
    return $valor_moeda;
}

/**
 * Função para obter os espetáculos antes de data e hora atual para o usuário.
 * @return object $espetaculos = Array contendo os espetáculos antes da data e horário do espetáculo
 */
function obterTodosEspetaculos() {
    $PDO = db_connect();
    
    $sql = "call SP_obterTodosEspetaculos";

    $stmt = $PDO->prepare($sql);

    $stmt->execute();

    $espetaculos = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $espetaculos;
}

/**
 * Função para obter todos os espetáculos para o admin
 * @return object $espetaculos = Array contendo todos os espetáculos
 */
function obterTodosEspetaculosAdmin() {
    $PDO = db_connect();
    
    $sql = "call SP_obterTodosEspetaculosAdmin";

    $stmt = $PDO->prepare($sql);

    $stmt->execute();

    $espetaculos = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $espetaculos;
}

/**
 * Função para obter um espetáculo
 * @param int $id_espetaculo = Id do espetáculo
 * @return object $espetaculo = Retorna um espetáculo
 */
function obterEspetaculo($id_espetaculo) {
    $PDO = db_connect();
    
    $sql = "call SP_obterEspetaculo(?)";
    
    $stmt = $PDO->prepare($sql);

    $stmt->bindParam(1, $id_espetaculo);

    $stmt->execute();

    $espetaculo = $stmt->fetch(PDO::FETCH_OBJ);

    return $espetaculo;
}

/**
 * Função para obter as reservas das poltronas do espetáculo
 * @param int $id_espetaculo = Id do espetáculo
 * @return object $poltronas = Array contendo as oltronas reservadas do espetáculo
 */
function obterReservasEspetaculo($id_espetaculo) {
    $PDO = db_connect();

//    $sql = "SELECT tbl_espetaculo.id_espetaculo, espetaculo, Date_Format(date, '%d/%m/%Y') As date, Time_Format(hora, '%H:%i') As hora, tbl_reserva.id_reserva,
//            tbl_poltrona.id_poltrona, poltrona FROM tbl_espetaculo INNER JOIN tbl_reserva ON tbl_espetaculo.id_espetaculo = tbl_reserva.id_espetaculo 
//            INNER JOIN tbl_reservas_poltrona ON tbl_reserva.id_reserva = tbl_reservas_poltrona.id_reserva 
//            INNER JOIN  tbl_poltrona ON tbl_reservas_poltrona.id_poltrona = tbl_poltrona.id_poltrona WHERE tbl_espetaculo.id_espetaculo = ? ;";

    $sql = "call SP_obterReservasEspetaculo(?)";
    
    $stmt = $PDO->prepare($sql);

    $stmt->bindParam(1, $id_espetaculo);

    $stmt->execute();

    $poltronas = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $poltronas;
}

/**
 * Função para obter o valor da poltrona
 * @return float $valor = Valor da poltrona
 */
function obterValorPoltrona() {
    $PDO = db_connect();

    $sql = "call SP_obterValorPoltrona();";

    $stmt = $PDO->prepare($sql);

    $stmt->execute();

    $valor = $stmt->fetch(PDO::FETCH_OBJ);

    return $valor;
}

/**
 * Função para obter o total arrecadado de todas as reservas
 * @return float $valor = Valor arrecadado
 */
function obterTotalArrecadacao() {

    $PDO = db_connect();

    $sql = "call SP_obterTotalArrecadacao";

    $stmt = $PDO->prepare($sql);

    $stmt->execute();

    $valor = $stmt->fetch(PDO::FETCH_OBJ);

    return $valor;
}

/**
 * Função para obter as reservas do usuário
 * @return object $valor = Array contendo as reservas do usuário
 */
function obterReservasUsuario() {
    $PDO = db_connect();

    $sql = "call SP_obterReservasUsuario";
    
    $stmt = $PDO->prepare($sql);

    $stmt->execute();

    $valor = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $valor;
}

/**
 * Função para obter as poltronas de uma reserva
 * @param int $id_reserva = Id da reserva
 * @return object $poltronas = Array contendo as poltronas reservadas
 */
function obterPoltronasReserva($id_reserva) {
    $PDO = db_connect();
   
    $sql = "call SP_obterPoltronasReserva(?)";

    $stmt = $PDO->prepare($sql);
    
    $stmt->bindParam(1, $id_reserva);
    
    $stmt->execute();

    $poltronas = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $poltronas;
}
?>

