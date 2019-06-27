<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 27/06/19
 * Time: 09:38
 */

namespace App\Recorder;


abstract class AbstractRecorder implements RecorderInterface
{

    /**
     * @var ValidationErrors
     */
    private $errors;

    /**
     * AbstractRecorder constructor.
     */
    public function __construct()
    {
        $this->errors = new ValidationErrors();
    }

    /**
     * @param array $params
     * @return array
     */
    public function checkAndSave(array $params):array {
        if(!$this->validate($params))
            return $this->fail();

        $this->save($params);
        return $this->success();
    }

    /**
     * @param array $params
     * @return bool
     */
    abstract public function validate(array $params = []):bool;

    /**
     * @param array $params
     * @return mixed
     */
    abstract public function save(array $params);


    /**
     * @return array
     */
    public function fail() {
        http_response_code(400);
        $errors = $this->errors->getArrayCopy();
        $message = 'Invalid input data entry.';
        $success = false;
        return get_defined_vars();
    }

    /**
     * @return array
     */
    public function success() {
        $errors = [];
        $message = 'Congratulations.';
        $success = true;
        return get_defined_vars();
    }

    /**
     * @return ValidationErrors
     */
    public function getErrors(): ValidationErrors
    {
        return $this->errors;
    }


}