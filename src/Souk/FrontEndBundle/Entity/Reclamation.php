<?php

namespace Souk\FrontEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity
 */
class Reclamation
{


    public function __construct()
    {
        $this->dateReclamation = new \DateTime("now");
    }

    /**
     * @ORM\ManyToOne(targetEntity="Souk\FrontEndBundle\Entity\Utilisateur")
     * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     */
    private $utilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="sujet", type="string", length=254, nullable=false)
     */
    private $sujet;

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
     * @ORM\Column(name="date_reclamation", type="datetime")
     */
    private $dateReclamation;

    /**
     * @ORM\Column(name="date_probleme", type="datetime")
     */
    private $dateProbleme;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $etat= "en_cours";

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }


    /**
     * @var \Souk\FrontEndBundle\Entity\Commande
     *
     * @ORM\ManyToOne(targetEntity="Souk\FrontEndBundle\Entity\Commande")
     * @ORM\JoinColumn(name="commande_id", referencedColumnName="id")
     */
    private $commande;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     */
    private $file;

    /**
     * Set sujet
     *
     * @param string $sujet
     *
     * @return Reclamation
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet
     *
     * @return string
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Reclamation
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateReclamation
     *
     * @param \DateTime $dateReclamation
     *
     * @return Reclamation
     */
    public function setDateReclamation($dateReclamation)
    {
        $this->dateReclamation = $dateReclamation;

        return $this;
    }

    /**
     * Get dateReclamation
     *
     * @return \DateTime
     */
    public function getDateReclamation()
    {
        return $this->dateReclamation;
    }

    /**
     * Set dateProbleme
     *
     * @param \DateTime $dateProbleme
     *
     * @return Reclamation
     */
    public function setDateProbleme($dateProbleme)
    {
        $this->dateProbleme = $dateProbleme;

        return $this;
    }

    /**
     * Get dateProbleme
     *
     * @return \DateTime
     */
    public function getDateProbleme()
    {
        return $this->dateProbleme;
    }

    /**
     * Set file
     *
     * @param string $file
     *
     * @return Reclamation
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set utilisateur
     *
     * @param \Souk\FrontEndBundle\Entity\Utilisateur $utilisateur
     *
     * @return Reclamation
     */
    public function setUtilisateur(\Souk\FrontEndBundle\Entity\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \Souk\FrontEndBundle\Entity\Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set commande
     *
     * @param \Souk\FrontEndBundle\Entity\Commande $commande
     *
     * @return Reclamation
     */
    public function setCommande(\Souk\FrontEndBundle\Entity\Commande $commande = null)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \Souk\FrontEndBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }
}
