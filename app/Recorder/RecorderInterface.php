<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 27/06/19
 * Time: 09:28
 */

namespace App\Recorder;


interface RecorderInterface
{
    public function save(array $params);
}