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
use App\Model\LocalModel;
use App\Model\LocalPoltronaModel;
use App\Recorder\LocalRecorder;
use App\Repository\LocalRepository;

class Local extends AbstractController
{

    public function index() {
        $collection = LocalRepository::getAll();
        return $this->render('local/index.php', get_defined_vars());
    }

    public function novo() {
        return $this->form('Novo Local', new LocalModel());
    }

    public function editar($id) {
        return $this->form('Editar Local', (new LocalModel())->find($id));
    }

    private function form(string $title, LocalModel $model) {
        $action = $model->getKey() ? '/local/save/' . $model->getKey() : '/local/save';
        return $this->render('local/form.php', get_defined_vars());
    }

    public function save(?int $id = null) {
        if(!count($_POST))
            return $this->e405();

        $model = $id ? (new LocalModel)->find($id) : new LocalModel();
        if($id && !$model->getKey())
            return $this->e404();

        $recorder = new LocalRecorder();
        return $recorder->setModel($model)->checkAndSave($_POST);
    }


    public function excluir(int $id) {
        LocalRecorder::delete($id);
        return ['success'=>true];
    }
}