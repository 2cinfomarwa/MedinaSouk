<?php

namespace Souk\FrontEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="FK_utilisateur_commande", columns={"idUtilisateur"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Souk\FrontEndBundle\Repository\CommandeRepository")
 */
class Commande


{

    /**
     * @var \Souk\FrontEndBundle\Entity\Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Souk\FrontEndBundle\Entity\Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUtilisateur", referencedColumnName="id")
     * })
     */
    private $idutilisateur;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCmd", type="datetime", nullable=true)
     */
    private $datecmd;

    /**
     * @var float
     *
     * @ORM\Column(name="montantHT", type="float", precision=10, scale=0, nullable=true)
     */
    private $montantHT;

    /**
     * @var float
     *
     * @ORM\Column(name="montantTTC", type="float", precision=10, scale=0, nullable=true)
     */
    private $montantTTC;



    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @return float
     */
    public function getMontantHT()
    {
        return $this->montantHT;
    }

    /**
     * @param float $montantHT
     */
    public function setMontantHT($montantHT)
    {
        $this->montantHT = $montantHT;
    }

    /**
     * @return float
     */
    public function getMontantTTC()
    {
        return $this->montantTTC;
    }

    /**
     * @param float $montantTTC
     */
    public function setMontantTTC($montantTTC)
    {
        $this->montantTTC = $montantTTC;
    }


    /**
     * @return \DateTime
     */


    public function getDatecmd()
    {
        return $this->datecmd;
    }

    /**
     * @param \DateTime $datecmd
     */
    public function setDatecmd($datecmd)
    {
        $this->datecmd = $datecmd;
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

    
    


}

