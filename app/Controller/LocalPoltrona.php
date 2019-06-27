<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 26/06/19
 * Time: 15:41
 */

namespace App\Controller;

use App\Lib\DB;
use App\Model\LocalModel;
use App\Model\LocalPoltronaModel;
use App\Recorder\LocalPoltronaRecorder;
use App\Recorder\LocalRecorder;
use App\Repository\LocalRepository;

class LocalPoltrona extends AbstractController
{

    public function index(int $fkLocal) {
        $collection = LocalRepository::getPoltronas($fkLocal);
        return $this->render('local-poltrona/index.php', get_defined_vars());
    }

    public function novo(int $fkLocal) {
        $model = new LocalPoltronaModel();
        $model->setFkLocal($fkLocal);
        return $this->form('Cadastro de Poltrona', $model);
    }

    public function editar(int $fkLocal, $id) {
        $model = (new LocalPoltronaModel())->find($id);
        if($fkLocal == $model->getFkLocal())
            $this->e404();

        return $this->form('Renomear Poltrona', $model);
    }

    private function form(string $title, LocalPoltronaModel $model) {
        $fkLocal = $model->getFkLocal();
        $action = $model->getKey() ? "/local/$fkLocal/poltrona/save/" . $model->getKey() : "/local/$fkLocal/poltrona/save";
        return $this->render('local-poltrona/form.php', get_defined_vars());
    }

    public function save(int $fkLocal, ?int $id = null) {
        if(!count($_POST))
            return $this->e405();

        $model = $id ? (new LocalPoltronaModel)->find($id) : new LocalPoltronaModel();
        if($id && (!$model->getKey() || $fkLocal != $model->getFkLocal()))
            return $this->e404();

        $model->setFkLocal($fkLocal);
        $recorder = new LocalPoltronaRecorder();
        return $recorder->setModel($model)->checkAndSave($_POST);
    }


    public function poltronas(int $fkLocal) {
        $collection = LocalRepository::getPoltronas($fkLocal);
        return $this->render('local/poltronas.php', get_defined_vars());
    }



    public function excluir(int $fkLocal, int $id) {
        if($fkLocal != (new LocalPoltronaModel())->find($id)->getFkLocal())
            return $this->e404();

        LocalPoltronaRecorder::delete($id);
        return ['success'=>true];
    }
}