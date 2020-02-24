<?php


namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "Users")
 */

class User
{
    /**
     * @ORM\Column(type = "integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type = "string", length = 50)
     */
    private $name;

    /**
     * @ORM\Column(type = "string", length = 20)
     */
    private $login;

    /**
     * @ORM\Column(type = "string", length = 20)
     */
    private $pass;

    /**
     * @ORM\Column(type = "integer")
     */
    private $rcp;

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
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set pass
     *
     * @param string $pass
     *
     * @return User
     */
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get pass
     *
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set rcp
     *
     * @param integer $rcp
     *
     * @return User
     */
    public function setRcp($rcp)
    {
        $this->rcp = $rcp;

        return $this;
    }

    /**
     * Get rcp
     *
     * @return integer
     */
    public function getRcp()
    {
        return $this->rcp;
    }
}
