<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 27/06/19
 * Time: 09:20
 */

namespace App\Recorder;

use App\Lib\DB;
use App\Model\EspetaculoModel;
use App\Model\LocalModel;

class LocalRecorder extends AbstractRecorder
{

    /**
     * @var LocalModel
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
        $entry = $model->getChrLocal();
        $e = $this->getErrors();
        if(!$e->test(!!$entry, 'chrLocal', 'O campo Local é obrigatório.'))
            return;

        $query = "SELECT COUNT(0) FROM `local` WHERE chrLocal = :entry AND id <> :id";
        $records = DB::fetchValue($query, [':entry'=>$entry, ':id'=>$id]);
        $e->test(intval($records) < 1, 'chrLocal', 'O já existe um Local cadastrado com o mesmo Nome.');
    }

    public function save(array $params = [])
    {
        $this->getModel()->fill($params)->save();
    }

    /**
     * @return LocalModel
     */
    public function getModel(): LocalModel
    {
        return $this->model;
    }

    /**
     * @param LocalModel $model
     * @return $this
     */
    public function setModel(LocalModel $model)
    {
        $this->model = $model;
        return $this;
    }


    public static function delete(int $id) {
        DB::execute("
          DELETE r FROM espetaculo_reserva r 
          JOIN local_poltrona l ON l.id=r.fkPoltrona AND l.fkLocal=$id;
        ");
        DB::execute("DELETE FROM local_poltrona WHERE fkLocal=$id;");
        DB::execute("DELETE FROM espetaculo WHERE fkLocal=$id;");


        (new LocalModel())->delete($id);
    }
}