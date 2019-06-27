<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 27/06/19
 * Time: 09:21
 */

namespace App\Recorder;


use App\Lib\DB;
use App\Model\EspetaculoModel;

class EspetaculoRecorder extends AbstractRecorder
{

    /**
     * @var EspetaculoModel
     */
    private $model;

    public function validate(array $params = []): bool
    {
        $e = $this->getErrors();
        $this->getModel()->fill($params);
        $e->test(!!$this->getModel()->getFkLocal(), 'fkLocal', 'O campo Local é obrigatório.');
        $this->checkChrEspetaculo();

        return $e->count() < 1;
    }

    public function checkChrEspetaculo() {
        $model = $this->getModel();
        $id = $model->getKey() ?? 0;
        $entry = $model->getChrEspetaculo();
        $e = $this->getErrors();
        if(!$e->test(!!$entry, 'chrEspetaculo', 'O campo Nome do Evento é obrigatório.'))
            return;

        $query = "SELECT COUNT(0) FROM espetaculo  WHERE chrEspetaculo = :entry AND id <> :id";
        $records = DB::fetchValue($query, [':entry'=>$entry, ':id'=>$id]);
        $e->test(intval($records) < 1, 'chrEspetaculo', 'O já existe um Evento cadastrado com o mesmo Nome.');
    }

    public function save(array $params = [])
    {
        $this->getModel()->fill($params)->save();
    }

    /**
     * @return EspetaculoModel
     */
    public function getModel(): EspetaculoModel
    {
        return $this->model;
    }

    /**
     * @param EspetaculoModel $model
     * @return $this
     */
    public function setModel(EspetaculoModel $model)
    {
        $this->model = $model;
        return $this;
    }


    public static function delete(int $id) {
        DB::execute("DELETE FROM espetaculo_reserva WHERE fkEspetaculo=$id;");
        (new EspetaculoModel())->delete($id);
    }

}