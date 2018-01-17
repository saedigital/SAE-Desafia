<?php

/**
 * Arquivo que gerencia os espetáculos.
 * Tem as função de inserir, editar e excluir espetáculos
 * Criado em janeiro/2018 
 * @author: Ander
 */
require './init.php';

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

//Inserir espetáculo
if ($acao == 'inserir') {

    $espetaculo = isset($_POST['nome_espetaculo']) ? $_POST['nome_espetaculo'] : '';
    $data = isset($_POST['data_espetaculo']) ? $_POST['data_espetaculo'] : '';
    $hora = isset($_POST['hora_espetaculo']) ? $_POST['hora_espetaculo'] : '';

    // Constrói a data no formato yyyy-mm-dd
    $data_temp = explode('/', $data);
    $data_correta = $data_temp[2] . '-' . $data_temp[1] . '-' . $data_temp[0];

    $PDO = db_connect();

    $sql = "INSERT INTO tbl_espetaculo (espetaculo, date, hora) VALUES (?, ?, ?);";
    $stmt = $PDO->prepare($sql);

    $stmt->bindParam(1, $espetaculo);
    $stmt->bindParam(2, $data_correta);
    $stmt->bindParam(3, $hora);
    
    $stmt->execute();

//Excluir espetáculo
} elseif ($acao == 'excluir') {

    $id_espetaculo = isset($_POST['id']) ? $_POST['id'] : '';

    $PDO = db_connect();

    $sql = "DELETE FROM tbl_espetaculo WHERE id_espetaculo = ? ;";
    $stmt = $PDO->prepare($sql);

    $stmt->bindParam(1, $id_espetaculo);

    $stmt->execute();

//Editar espetáculo
} elseif ($acao == 'editar') {

    $id_espetaculo = isset($_POST['id']) ? $_POST['id'] : '';
    $espetaculo = isset($_POST['nome_espetaculo']) ? $_POST['nome_espetaculo'] : '';
    $data = isset($_POST['data_espetaculo']) ? $_POST['data_espetaculo'] : '';
    $hora = isset($_POST['hora_espetaculo']) ? $_POST['hora_espetaculo'] : '';

    // Constrói a data no formato yyyy-mm-dd
    $data_temp = explode('/', $data);
    $data_correta = $data_temp[2] . '-' . $data_temp[1] . '-' . $data_temp[0];

    $PDO = db_connect();

    $sql = "UPDATE tbl_espetaculo SET espetaculo = ?, date = ?, hora = ? WHERE id_espetaculo = ? ;";
    $stmt = $PDO->prepare($sql);

    $stmt->bindParam(1, $espetaculo);
    $stmt->bindParam(2, $data_correta);
    $stmt->bindParam(3, $hora);
    $stmt->bindParam(4, $id_espetaculo);

    $stmt->execute();
}

if ($stmt) {
    echo 1;
} else {
    echo 0;
}
?>
  