<?php

namespace Souk\FrontEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promotion
 *
 * @ORM\Table(name="promotion", indexes={@ORM\Index(name="FK_promotion_produit", columns={"idProduit"})})
 * @ORM\Entity
 */
class Promotion
{
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=254, nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=254, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="taux", type="string", length=254, nullable=true)
     */
    private $taux;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Souk\FrontEndBundle\Entity\Produit
     *
     * @ORM\ManyToOne(targetEntity="Souk\FrontEndBundle\Entity\Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idProduit", referencedColumnName="id")
     * })
     */
    private $idproduit;

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
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
     * @return string
     */
    public function getTaux()
    {
        return $this->taux;
    }

    /**
     * @param string $taux
     */
    public function setTaux($taux)
    {
        $this->taux = $taux;
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
     * @return Produit
     */
    public function getIdproduit()
    {
        return $this->idproduit;
    }

    /**
     * @param Produit $idproduit
     */
    public function setIdproduit($idproduit)
    {
        $this->idproduit = $idproduit;
    }
    
    


}

