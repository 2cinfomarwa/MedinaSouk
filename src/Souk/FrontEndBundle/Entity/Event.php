<?php

namespace Souk\FrontEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event", indexes={@ORM\Index(name="FK_Event_Type", columns={"idTypeEvent"})})
 * @ORM\Entity
 */
class Event
{
    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=254, nullable=true)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=254, nullable=true)
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
     * @var \Souk\FrontEndBundle\Entity\Typeevent
     *
     * @ORM\ManyToOne(targetEntity="Souk\FrontEndBundle\Entity\Typeevent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idTypeEvent", referencedColumnName="id")
     * })
     */
    private $idtypeevent;

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
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

    /**
     * @return Typeevent
     */
    public function getIdtypeevent()
    {
        return $this->idtypeevent;
    }

    /**
     * @param Typeevent $idtypeevent
     */
    public function setIdtypeevent($idtypeevent)
    {
        $this->idtypeevent = $idtypeevent;
    }
    
    


}

