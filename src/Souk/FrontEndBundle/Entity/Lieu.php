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

