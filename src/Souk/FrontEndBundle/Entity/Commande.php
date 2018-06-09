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
     * @return float
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param float $description
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

