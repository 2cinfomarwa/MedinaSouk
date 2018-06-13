<?php

namespace Souk\FrontEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Event
 *
 * @ORM\Table(name="event", indexes={@ORM\Index(name="FK_Event_Type", columns={"idTypeEvent"}) ,@ORM\Index(name="FK_Event_Lieu", columns={"idLieu"})})
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
     * @Assert\File(
     *  mimeTypes={"image/jpeg","image/gif","image/png"})
     * @ORM\Column(name="image", type="string")
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=254, nullable=true)
     */
    private $lieu;


    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateevent", type="datetime", nullable=false)
     */
    private $dateevent;


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
     * @var \Souk\FrontEndBundle\Entity\Lieu
     *
     * @ORM\ManyToOne(targetEntity="Souk\FrontEndBundle\Entity\Lieu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idLieu", referencedColumnName="id")
     * })
     */
    private $idlieu;

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

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param string $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    /**
     * @return \DateTime
     */
    public function getDateevent()
    {
        return $this->dateevent;
    }

    /**
     * @param \DateTime $dateevent
     */
    public function setDateevent($dateevent)
    {
        $this->dateevent = $dateevent;
    }

    /**
     * @return Lieu
     */
    public function getIdlieu()
    {
        return $this->idlieu;
    }

    /**
     * @param Lieu $idlieu
     */
    public function setIdlieu($idlieu)
    {
        $this->idlieu = $idlieu;
    }
    
    


}

