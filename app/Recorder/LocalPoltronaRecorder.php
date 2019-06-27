<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 27/06/19
 * Time: 09:20
 */

namespace App\Recorder;

use App\Lib\DB;
use App\Model\LocalPoltronaModel;

class LocalPoltronaRecorder extends AbstractRecorder
{

    /**
     * @var LocalPoltronaModel
     */
    private $model;

    public function validate(array $params = []): bool
    {
        $e = $this->getErrors();
        $this->getModel()->fill($params);

        $this->checkChrLocal();

        return $e->count() < 1;
    }

    public function checkChrLocal() {
        $model = $this->getModel();
        $id = $model->getKey() ?? 0;
        $entry = $model->getChrCodigo();
        $fkLocal = $model->getFkLocal();
        $e = $this->getErrors();
        if(!$e->test(!!$entry, 'chrCodigo', 'O campo Código é obrigatório.'))
            return;

        $query = "SELECT COUNT(0) FROM `local_poltrona` WHERE chrCodigo = :entry AND id <> :id AND fkLocal = :fkLocal";
        $records = DB::fetchValue($query, [':entry'=>$entry, ':id'=>$id, ':fkLocal'=>$fkLocal]);
        $e->test(intval($records) < 1, 'chrCodigo', 'O já existe um Codigo cadastrado com o mesmo Nome.');
    }

    public function save(array $params = [])
    {
        $this->getModel()->fill($params)->save();
    }

    /**
     * @return LocalPoltronaModel
     */
    public function getModel(): LocalPoltronaModel
    {
        return $this->model;
    }

    /**
     * @param LocalPoltronaModel $model
     * @return $this
     */
    public function setModel(LocalPoltronaModel $model)
    {
        $this->model = $model;
        return $this;
    }

    public static function delete($id) {
        DB::execute("DELETE FROM espetaculo_reserva WHERE fkPoltrona=$id");
        (new LocalPoltronaModel())->delete($id);
    }
}