<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 26/06/19
 * Time: 22:40
 */

namespace App\Model;


class EspetaculoModel extends AbstractModel
{

    protected $_table = 'espetaculo';

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
    public $chrEspetaculo;

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
    public function getChrEspetaculo(): ?string
    {
        return $this->chrEspetaculo;
    }

    /**
     * @param null|string $chrEspetaculo
     */
    public function setChrEspetaculo(?string $chrEspetaculo): void
    {
        $this->chrEspetaculo = $chrEspetaculo;
    }


}