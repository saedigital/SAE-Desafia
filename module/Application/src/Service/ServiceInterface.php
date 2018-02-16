<?php

namespace Application\Service;

/**
 * Interface ServiceInterface
 * @package Application\Service
 */
interface ServiceInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function save(array $data);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
