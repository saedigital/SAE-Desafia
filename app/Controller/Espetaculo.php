<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 26/06/19
 * Time: 15:41
 */

namespace App\Controller;


use App\Lib\DB;
use App\Model\EspetaculoModel;
use App\Model\EspetaculoReservaModel;
use App\Model\LocalModel;
use App\Model\LocalPoltronaModel;

class Espetaculo extends AbstractController
{

    public function index() {

        $model = new LocalModel();
        $model->fill(['chrLocal'=>'Auditório Central'])->save();

        $model = new LocalPoltronaModel();
        $model->setChrCodigo('Bloco 1 - A1');
        $model->setFkLocal(1);
        $model->save();

        $model = new LocalPoltronaModel();
        $model->setChrCodigo('Bloco 1 - A2');
        $model->setFkLocal(1);
        $model->save();

        $model = new LocalPoltronaModel();
        $model->setChrCodigo('Bloco 1 - A3');
        $model->setFkLocal(1);
        $model->save();

        $model = new LocalPoltronaModel();
        $model->setChrCodigo('Bloco 1 - A4');
        $model->setFkLocal(1);
        $model->save();

        $model = new EspetaculoModel();
        $model->setChrEspetaculo('Circo Solei');
        $model->setFkLocal(1);
        $model->save();

        $model = new EspetaculoReservaModel();
        $model->setFkPoltrona(4);
        $model->setFkEspetaculo(1);
        $model->setDttReserva(new \DateTime());

        echo $model->save()->getKey();die;
        echo $this->render('espetaculo/index.php');
    }

    public function novo() {
        return $this->form('Novo Espetáculo');
    }

    public function editar($id) {
        return $this->form('Editar Espetáculo');
    }

    private function form(string $title, array $data = []) {
        echo $this->render('espetaculo/form.php', get_defined_vars());
    }
}