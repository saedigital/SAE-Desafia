<?php

require_once "Conn.php";

class Show extends Conn
{
    private $table = "sae_espetaculo";
    private $campos = [];

    public function openCadShow()
    {
        include_once "../app/Views/Show/index.php";
    }

    public function openRelShow()
    {
        include_once "../app/Views/Show/rel-show.php";
    }

    public function openAtuShow()
    {
        $_GET['tipo'] = 1;
        include_once "../app/Views/Show/index.php";
    }

    public function saveShow($nome, $qtd_poltrona, $data_espetaculo)
    {
        $this->campos['NOME'] = $nome;
        $this->campos['QTD_POLTRONAS'] = $qtd_poltrona;
        $this->campos['DATA_ESPETACULO'] = $data_espetaculo;
        parent::insert($this->getTable(), $this->getCampos());

    }

    public function updateShow($id, $nome, $qtd_poltrona, $data_espetaculo)
    {
        $this->campos['ID'] = $id;
        $this->campos['NOME'] = $nome;
        $this->campos['QTD_POLTRONAS'] = $qtd_poltrona;
        $this->campos['DATA_ESPETACULO'] = $data_espetaculo;

        parent::update($this->getTable(), $this->getCampos());
    }

    public function deleteShow($id)
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