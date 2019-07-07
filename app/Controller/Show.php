<?php

namespace Vital\Controller;

require_once (__DIR__ .'/../Models/Show.php');

class Show
{
    private $show;
    public function __construct()
    {
        $this->show = new \Show();
    }

    public function cad_show()
    {
        $this->show->openCadShow();
    }

    public function rel_show()
    {
        $this->show->openRelShow();
    }

    public function save_show()
    {
        $Nome = $_POST['Nome'];
        $qtd_poltrona = $_POST['qtd_poltrona'];
        $date = $_POST['date'];
        $this->show->saveShow($Nome, $qtd_poltrona, $date);
        header('Location: rel-show');
    }

    public function update_show()
    {
        $id = $_POST['id'];
        $Nome = $_POST['Nome'];
        $qtd_poltrona = $_POST['qtd_poltrona'];
        $date = $_POST['date'];
        $this->show->updateShow($id, $Nome, $qtd_poltrona, $date);
        header('Location: rel-show');
    }

    public function delete_show()
    {
        $id = $_POST['id'];
        $this->show->deleteShow($id);
        header('Location: rel-show');
    }

    public function atualiza_show()
    {
        $this->show->openAtuShow();
    }
}