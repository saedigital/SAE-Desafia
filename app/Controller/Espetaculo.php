<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 26/06/19
 * Time: 15:41
 */

namespace App\Controller;

use App\Lib\DB;
use App\Lib\HttpException;
use App\Model\EspetaculoModel;
use App\Model\EspetaculoReservaModel;
use App\Model\LocalModel;
use App\Model\LocalPoltronaModel;
use App\Recorder\EspetaculoRecorder;
use App\Repository\EspetaculoRepository;
use App\Repository\LocalRepository;

class Espetaculo extends AbstractController
{

    public function index() {
        $espetaculos = EspetaculoRepository::getAll();
        return $this->render('espetaculo/index.php', get_defined_vars());
    }

    public function novo() {
        return $this->form('Novo Espetáculo', new EspetaculoModel());
    }

    public function editar($id) {
        return $this->form('Editar Espetáculo', (new EspetaculoModel())->find($id));
    }

    private function form(string $title, EspetaculoModel $model) {
        $action = $model->getKey() ? '/espetaculo/save/' . $model->getKey() : '/espetaculo/save';
        $localCollection = LocalRepository::getOptions();
        return $this->render('espetaculo/form.php', get_defined_vars());
    }

    public function save(?int $id = null) {
        if(!count($_POST))
            return $this->e405();

        $model = $id ? (new EspetaculoModel)->find($id) : new EspetaculoModel();
        if($id && !$model->getKey())
            return $this->e404();

        $recorder = new EspetaculoRecorder();
        return $recorder->setModel($model)->checkAndSave($_POST);
    }

    public function reservas(int $id) {
        $collection = EspetaculoRepository::getPoltronas($id);
        $evento = (new EspetaculoModel())->find($id);
        $status = EspetaculoRepository::getStatus($id);
        return $this->render('espetaculo/reservas.php', get_defined_vars());
    }

    public function reserva(int $fkEspetaculo, int $fkPoltrona) {
        $model = new EspetaculoReservaModel();
        $model->findByPoltrona($fkEspetaculo, $fkPoltrona);
        $id = $model->getKey();
        if(!$id):
            $model->setFkEspetaculo($fkEspetaculo);
            $model->setFkPoltrona($fkPoltrona);
            $model->setDttReserva(new \DateTime());
            $model->save();
        else:
            $model->delete($model->getKey());
        endif;
        return ['success'=>true, 'mark'=> ($id ? false : true)]  + EspetaculoRepository::getStatus($fkEspetaculo);
    }

    public function remover(int $id) {
        EspetaculoRecorder::delete($id);
        return ['success'=>true];
    }
}