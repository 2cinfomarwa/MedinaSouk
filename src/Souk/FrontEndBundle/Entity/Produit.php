<?php

namespace Souk\FrontEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="FK_produit_categorie", columns={"idCategorieProd"}),@ORM\Index(name="FK_utilisateur_produit", columns={"idUtilisateur"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Souk\FrontEndBundle\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idUtilisateur", type="integer", nullable=false)
     */
    private $idutilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=254, nullable=true)
     */
    private $designation;

    /**
     * @var float
     *
     * @ORM\Column(name="prixUnitaire", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixunitaire;

    /**
     * @var integer
     *
     * @ORM\Column(name="qteStock", type="integer", nullable=true)
     */
    private $qtestock;

    /**
     * @var float
     *
     * @ORM\Column(name="tauxTva", type="float", precision=10, scale=0, nullable=true)
     */
    private $tauxtva;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=254, nullable=true)
     */
    private $image;

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
     * @var \Souk\FrontEndBundle\Entity\Categorieproduit
     *
     * @ORM\ManyToOne(targetEntity="Souk\FrontEndBundle\Entity\Categorieproduit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategorieProd", referencedColumnName="id")
     * })
     */
    private $idcategorieprod;

    /**
     * @return int
     */
    public function getIdutilisateur()
    {
        return $this->idutilisateur;
    }

    /**
     * @param int $idutilisateur
     */
    public function setIdutilisateur($idutilisateur)
    {
        $this->idutilisateur = $idutilisateur;
    }

    /**
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * @param string $designation
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;
    }

    /**
     * @return float
     */
    public function getPrixunitaire()
    {
        return $this->prixunitaire;
    }

    /**
     * @param float $prixunitaire
     */
    public function setPrixunitaire($prixunitaire)
    {
        $this->prixunitaire = $prixunitaire;
    }

    /**
     * @return int
     */
    public function getQtestock()
    {
        return $this->qtestock;
    }

    /**
     * @param int $qtestock
     */
    public function setQtestock($qtestock)
    {
        $this->qtestock = $qtestock;
    }

    /**
     * @return float
     */
    public function getTauxtva()
    {
        return $this->tauxtva;
    }

    /**
     * @param float $tauxtva
     */
    public function setTauxtva($tauxtva)
    {
        $this->tauxtva = $tauxtva;
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
     * @return Categorieproduit
     */
    public function getIdcategorieprod()
    {
        return $this->idcategorieprod;
    }

    /**
     * @param Categorieproduit $idcategorieprod
     */
    public function setIdcategorieprod($idcategorieprod)
    {
        $this->idcategorieprod = $idcategorieprod;
    }
    
    


}

