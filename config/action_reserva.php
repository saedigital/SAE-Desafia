<?php

/**
 * Arquivo que gerencia as reservas
 * Tem as função de inserir, editar e excluir reservas e poltronas
 * Criado em janeiro/2018 
 * @author: Ander
 */

require './init.php';
require './functions.php';

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

//Reservar poltronas
if ($acao == 'reservar') {

    $id_espetaculo = isset($_POST['id']) ? $_POST['id'] : '';
    $sel_poltronas = isset($_POST['sel_poltronas']) ? $_POST['sel_poltronas'] : '';

    if (empty($id_espetaculo) || empty($sel_poltronas)) {
        echo 0;
        exit;
    }

    $PDO = db_connect();

    //Primeiro insere o número da reserva no tabela tbl_reserva
    $sql = "INSERT INTO tbl_reserva (id_espetaculo) VALUES (?) ;";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(1, $id_espetaculo);
    $stmt->execute();

    $last_id = $PDO->lastInsertId();

    //Depois insere as poltronas selecionadas com base no id da reserva anteriormente inserido
    $array_poltronas = explode(';', $sel_poltronas);

    foreach ($array_poltronas as $selpoltrona):

        $sql = "INSERT INTO tbl_reservas_poltrona (id_reserva, id_poltrona) VALUES (
                (SELECT id_reserva FROM tbl_reserva WHERE id_reserva = ? ),
                (SELECT id_poltrona FROM tbl_poltrona WHERE poltrona = ? LIMIT 1)); ";

        $stmt = $PDO->prepare($sql);

        $stmt->bindParam(1, $last_id);
        $stmt->bindParam(2, $selpoltrona);

        $stmt->execute();

        if ($stmt) {
            echo 1;
        } else {
            echo 0;
        }

    endforeach;

//Deletar poltrona
} elseif ($acao == 'deletar') {

    $id_poltrona = isset($_POST['id']) ? $_POST['id'] : '';

    $PDO = db_connect();

    $sql = "DELETE FROM tbl_reservas_poltrona WHERE id_poltrona = ? ; ";
    $stmt = $PDO->prepare($sql);

    $stmt->bindParam(1, $id_poltrona);

    $stmt->execute();

    if ($stmt) {
        echo 1;
    } else {
        echo 0;
    }

//Mostrar poltronas da cada reserva
} else if ($acao == 'mostrapoltronas') {

    $id_reserva = isset($_POST['id_reserva']) ? $_POST['id_reserva'] : '';

    $poltronas = obterPoltronasReserva($id_reserva);

    echo '<table class="table table-striped">';
    echo '<thead>';
    echo '<tr class="active">';
    echo '<th>Poltrona</th>';
    echo '<th>Ação</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($poltronas as $poltrona):
        echo '<tr id="tr_' . $poltrona->id_poltrona . '">';
        echo '<td>' . $poltrona->poltrona . '</td>';
        echo '<td>';
        echo '<button type="button" class="btn btn-danger deletar" data-id="' . $poltrona->id_poltrona . '" >Remover</button>';
    endforeach;

    echo '</td>';
    echo '</tbody>';
    echo '</table>';

//Remover reserva
}elseif ($acao == 'removereserva') {

    $id_reserva = isset($_POST['id_reserva']) ? $_POST['id_reserva'] : '';

    $PDO = db_connect();

    $sql = "Delete from tbl_reserva WHERE id_reserva = ? ;";
    $stmt = $PDO->prepare($sql);

    $stmt->bindParam(1, $id_reserva);

    $stmt->execute();

    if ($stmt) {
        echo 1;
    } else {
        echo 0;
    }
}
?>
