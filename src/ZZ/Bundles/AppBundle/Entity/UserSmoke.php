<?php

namespace ZZ\Bundles\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserSmoke
 *
 * @ORM\Table(name="savingsmoke_usersmoke")
 * @ORM\Entity
 */
class UserSmoke
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var ZZ\Bundles\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="ZZ\Bundles\UserBundle\Entity\User", inversedBy="usersmoke")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $user;

    /**
     * @var ZZ\Bundles\AppBundle\Entity\Cigarette
     *
     * @ORM\ManyToOne(targetEntity="ZZ\Bundles\AppBundle\Entity\Cigarette")
     * @ORM\JoinColumn(name="id_cigarette", referencedColumnName="id")
     */
    private $cigarette;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateStart", type="date")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnd", type="date")
     */
    private $dateEnd;


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
     * Set user
     *
     * @param integer $user
     * @return UserSmoke
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set cigarette
     *
     * @param integer $cigarette
     * @return UserSmoke
     */
    public function setCigarette($cigarette)
    {
        $this->cigarette = $cigarette;

        return $this;
    }

    /**
     * Get cigarette
     *
     * @return integer 
     */
    public function getCigarette()
    {
        return $this->cigarette;
    }

    /**
     * Set number
     *
     * @param integer $number
     * @return UserSmoke
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return UserSmoke
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime 
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     * @return UserSmoke
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime 
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }
}
