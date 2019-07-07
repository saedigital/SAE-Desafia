<?php

require_once "Conn.php";

class Armchair  extends Conn
{
    private $table = "sae_reserva_poltrona_espetaculo";
    private $campos = [];

    public function openArmchair()
    {
        include_once "../app/Views/Armchair/index.php";
    }

    public function saveReserva($id_espetaculo, $numero_poltrona)
    {
        $this->campos['IDFK_ESPETACULO'] = $id_espetaculo;
        $this->campos['NUMERO_POLTRONA'] = $numero_poltrona;

        parent::insert($this->getTable(), $this->getCampos());
    }

    public function saveLibera($id)
    {
        parent::delete($this->getTable(), $id);
    }

    public function getTable()
    {
        return $this->table;
    }

    public function getCampos()
    {
        return $this->campos;
    }
}