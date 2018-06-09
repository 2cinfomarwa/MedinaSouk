<?php

namespace Souk\FrontEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typeevent
 *
 * @ORM\Table(name="typeevent")
 * @ORM\Entity
 */
class Typeevent
{
    /**
     * @var integer
     *
     * @ORM\Column(name="libelle", type="integer", nullable=true)
     */
    private $libelle;

    /**
     * @var integer
     *
     * @ORM\Column(name="description", type="integer", nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @return int
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param int $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return int
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param int $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    


}

