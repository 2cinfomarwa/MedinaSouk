<?php
/**
 * Created by PhpStorm.
 * User: Marwen
 * Date: 29/10/2017
 * Time: 18:29
 */
namespace Souk\FrontEndBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="utilisateur")
 */
class Utilisateur extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    protected $age;


    public function __construct()
    {
        parent::__construct();
// your own logic
    }
}