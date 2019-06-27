<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 26/06/19
 * Time: 22:40
 */

namespace App\Model;


class LocalModel extends AbstractModel
{
    protected $_table = 'local';

    /**
     * @var null|int
     */
    public $id;

    /**
     * @var null|string
     */
    public $chrLocal;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return null|string
     */
    public function getChrLocal(): ?string
    {
        return $this->chrLocal;
    }

    /**
     * @param null|string $chrLocal
     */
    public function setChrLocal(?string $chrLocal): void
    {
        $this->chrLocal = $chrLocal;
    }


}