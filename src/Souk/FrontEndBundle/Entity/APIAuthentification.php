<?php
/**
 * Created by PhpStorm.
 * User: HEJER
 * Date: 15/06/2018
 * Time: 13:13
 */

namespace Souk\FrontEndBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

class APIAuthentification
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(name="username",type="string", length=30);
     */
    private $username;
    /**
     * @ORM\Column(name="password", type="string", length=30);
     */

    private $password;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }



}