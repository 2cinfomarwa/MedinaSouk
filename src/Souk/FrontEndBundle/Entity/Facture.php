<?php

namespace Souk\FrontEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture", indexes={@ORM\Index(name="FK_commande_facture", columns={"idCommande"})})
 * @ORM\Entity
 */
class Facture
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFact", type="datetime", nullable=true)
     */
    private $datefact;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateLivr", type="datetime", nullable=true)
     */
    private $datelivr;

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
     * @ORM\OneToOne(targetEntity="Souk\FrontEndBundle\Entity\Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCommande", referencedColumnName="id")
     * })
     */
    private $idcommande;

    /**
     * @return \DateTime
     */
    public function getDatefact()
    {
        return $this->datefact;
    }

    /**
     * @param \DateTime $datefact
     */
    public function setDatefact($datefact)
    {
        $this->datefact = $datefact;
    }

    /**
     * @return \DateTime
     */
    public function getDatelivr()
    {
        return $this->datelivr;
    }

    /**
     * @param \DateTime $datelivr
     */
    public function setDatelivr($datelivr)
    {
        $this->datelivr = $datelivr;
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



    


}

