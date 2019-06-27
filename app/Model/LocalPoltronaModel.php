<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 27/06/19
 * Time: 00:10
 */

namespace App\Model;


class LocalPoltronaModel extends AbstractModel
{

    protected $_table = 'local_poltrona';

    /**
     * @var null|int
     */
    public $id;

    /**
     * @var null|int
     */
    public $fkLocal;

    /**
     * @var null|string
     */
    public $chrCodigo;

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
     * @return int|null
     */
    public function getFkLocal(): ?int
    {
        return $this->fkLocal;
    }

    /**
     * @param int|null $fkLocal
     */
    public function setFkLocal(?int $fkLocal): void
    {
        $this->fkLocal = $fkLocal;
    }

    /**
     * @return null|string
     */
    public function getChrCodigo(): ?string
    {
        return $this->chrCodigo;
    }

    /**
     * @param null|string $chrCodigo
     */
    public function setChrCodigo(?string $chrCodigo): void
    {
        $this->chrCodigo = $chrCodigo;
    }


}