<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 27/06/19
 * Time: 09:33
 */

namespace App\Recorder;


class ValidationErrors extends \ArrayObject
{

    public function test(bool $isValid, string $key, string $message) {
        if($isValid)
            return true;

        $this->offsetSet($key, $message);
        return false;
    }
}