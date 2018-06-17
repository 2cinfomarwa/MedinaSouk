<?php

namespace Souk\FrontEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lieu
 *
 * @ORM\Table(name="lieu", indexes={@ORM\Index(name="FK_lieu_categorie", columns={"idCategorieLieu"})})
 * @ORM\Entity
 */
class Lieu
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
     * @ORM\Column(name="Description", type="string", length=254, nullable=true)
     */
    private $description;
    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=254, nullable=true)
     */
    private $adresse;

    /**
     * @return string
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * @param string $log
     */
    public function setLog($log)
    {
        $this->log = $log;
    }

    /**
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param string $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="log", type="string", length=254, nullable=true)
     */
    private $log;
    /**
     * @var string
     *
     * @ORM\Column(name="lat", type="string", length=254, nullable=true)
     */
    private $lat;


    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getCoordonnes()
    {
        return $this->coordonnes;
    }

    /**
     * @param string $coordonnes
     */
    public function setCoordonnes($coordonnes)
    {
        $this->coordonnes = $coordonnes;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Souk\FrontEndBundle\Entity\Categorielieu
     *
     * @ORM\ManyToOne(targetEntity="Souk\FrontEndBundle\Entity\Categorielieu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategorieLieu", referencedColumnName="id")
     * })
     */
    private $idcategorielieu;

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
     * @return Categorielieu
     */
    public function getIdcategorielieu()
    {
        return $this->idcategorielieu;
    }

    /**
     * @param Categorielieu $idcategorielieu
     */
    public function setIdcategorielieu($idcategorielieu)
    {
        $this->idcategorielieu = $idcategorielieu;
    }




}

