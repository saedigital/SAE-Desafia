<?php

namespace Application\Entity;

use DateTime;
use Zend\Hydrator\ClassMethods;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractEntity
 * @package Application\Entity
 */
abstract class AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var DateTime
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var DateTime
     */
    protected $modified;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=false, options={"default" = true})
     */
    protected $active = true;


    /**
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->created = new DateTime();
        $this->modified = new DateTime();
        $this->active = true;

        if (!empty($data)) {
            $hydrator = new ClassMethods(false);
            $hydrator->hydrate($data, $this);
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param DateTime $created
     * @return $this
     */
    public function setCreated(DateTime $created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @param DateTime $modified
     * @return $this
     */
    public function setModified(DateTime $modified)
    {
        $this->modified = $modified;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @param array $data
     */
    public function updateProperties($data = array())
    {
        if (!empty($data)) {
            $hydrator = new ClassMethods(false);
            $hydrator->hydrate($data, $this);
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $hydrator = new ClassMethods(false);
        return $hydrator->extract($this);
    }
}
