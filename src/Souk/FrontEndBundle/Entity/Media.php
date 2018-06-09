<?php

namespace Souk\FrontEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Media
 *
 * @ORM\Table(name="media", indexes={@ORM\Index(name="FK_boutique_media", columns={"idBoutique"})})
 * @ORM\Entity
 */
class Media
{
    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=254, nullable=true)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=254, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=254, nullable=true)
     */
    private $path;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Souk\FrontEndBundle\Entity\Boutique
     *
     * @ORM\ManyToOne(targetEntity="Souk\FrontEndBundle\Entity\Boutique")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idBoutique", referencedColumnName="id")
     * })
     */
    private $idboutique;

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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
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
     * @return Boutique
     */
    public function getIdboutique()
    {
        return $this->idboutique;
    }

    /**
     * @param Boutique $idboutique
     */
    public function setIdboutique($idboutique)
    {
        $this->idboutique = $idboutique;
    }
    
    


}

