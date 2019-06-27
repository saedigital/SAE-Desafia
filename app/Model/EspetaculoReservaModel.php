<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 26/06/19
 * Time: 22:40
 */

namespace App\Model;


class EspetaculoReservaModel extends AbstractModel
{

    protected $_table = 'espetaculo_reserva';

    /**
     * @var null|int
     */
    public $id;

    /**
     * @var null|int
     */
    public $fkPoltrona;

    /**
     * @var null|int
     */
    public $fkEspetaculo;

    /**
     * @var mixed
     */
    public $dttReserva;

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
    public function getFkPoltrona(): ?int
    {
        return $this->fkPoltrona;
    }

    /**
     * @param int|null $fkPoltrona
     */
    public function setFkPoltrona(?int $fkPoltrona): void
    {
        $this->fkPoltrona = $fkPoltrona;
    }

    /**
     * @return int|null
     */
    public function getFkEspetaculo(): ?int
    {
        return $this->fkEspetaculo;
    }

    /**
     * @param int|null $fkEspetaculo
     */
    public function setFkEspetaculo(?int $fkEspetaculo): void
    {
        $this->fkEspetaculo = $fkEspetaculo;
    }

    /**
     * @return mixed
     */
    public function getDttReserva()
    {
        return $this->dttReserva;
    }

    /**
     * @param mixed $dttReserva
     */
    public function setDttReserva($dttReserva): void
    {
        $this->dttReserva = $dttReserva instanceof \DateTime ? $dttReserva->format('Y-m-d H:i:s') : $dttReserva;
    }


}