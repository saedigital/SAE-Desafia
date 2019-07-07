<?php
/**
 * Created by PhpStorm.
 * User: PauloVital
 * Date: 06/07/2019
 * Time: 17:30
 */

namespace Vital\Controller;

require_once (__DIR__ .'/../Models/Armchair.php');
class Armchair
{
    private $armchair;

    public function __construct()
    {
        $this->armchair = new \Armchair();
    }

    public function armchair_show()
    {
        $this->armchair->openArmchair();
    }

    public function reserva()
    {
        $id_espetaculo = $_POST['id_espetaculo'];
        $numero_poltrona = $_POST['numero_poltrona'];
        $this->armchair->saveReserva($id_espetaculo, $numero_poltrona);
        header('Location: reservar-poltronas');
    }

    public function libera()
    {
        $id = $_POST['id'];
        $this->armchair->saveLibera($id);
        header('Location: reservar-poltronas');
    }





}