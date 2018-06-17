<?php

namespace Souk\FrontEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Detailscommande
 *
 * @ORM\Table(name="detailscommande", indexes={@ORM\Index(name="FK_details_cmd", columns={"idCommande"}), @ORM\Index(name="FK_details_produit", columns={"idProduit"})})
 * @ORM\Entity
 */
class DetailsCommande
{
    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var float
     *
     * @ORM\Column(name="prixUnitaire", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixunitaire;

    /**
     * @var float
     *
     * @ORM\Column(name="montantHT", type="float", precision=10, scale=0, nullable=true)
     */
    private $montantht;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Souk\FrontEndBundle\Entity\Commande
     *
     * @ORM\ManyToOne(targetEntity="Souk\FrontEndBundle\Entity\Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCommande", referencedColumnName="id")
     * })
     */
    private $idcommande;

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
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
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
     * @return float
     */
    public function getMontantht()
    {
        return $this->montantht;
    }

    /**
     * @param float $montantht
     */
    public function setMontantht($montantht)
    {
        $this->montantht = $montantht;
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
     * @return Commande
     */
    public function getIdcommande()
    {
        return $this->idcommande;
    }

    /**
     * @param Commande $idcommande
     */
    public function setIdcommande($idcommande)
    {
        $this->idcommande = $idcommande;
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

