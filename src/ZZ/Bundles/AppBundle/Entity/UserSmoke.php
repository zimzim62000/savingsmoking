<?php

namespace ZZ\Bundles\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * UserSmoke
 *
 * @ORM\Table(name="savingsmoke_usersmoke")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity("userlink")
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
     * @ORM\OneToOne(targetEntity="\ZZ\Bundles\UserBundle\Entity\User", inversedBy="usersmoke")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $user;

    /**
     * @var ZZ\Bundles\AppBundle\Entity\Cigarette
     *
     * @Assert\NotBlank(message="validators.usersmoke.cigarette.blank")
     *
     * @ORM\ManyToOne(targetEntity="ZZ\Bundles\AppBundle\Entity\Cigarette")
     * @ORM\JoinColumn(name="id_cigarette", referencedColumnName="id")
     */
    private $cigarette;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank(message="validators.usersmoke.number.blank")
     * @ORM\Column(name="number", type="integer")
     */
    private $number;


    /**
     * @var \DateTime
     *
     * @Assert\NotBlank(message="validators.usersmoke.dateStop.blank")
     * @ORM\Column(name="date_stop", type="date")
     */
    private $dateStop;

    /**
     * @var string
     *
     * @ORM\Column(name="user_link", type="string", length=255, unique=true)
     */
    private $userlink;

    /**
     * @param \DateTime $dateStop
     */
    public function setDateStop($dateStop)
    {
        $this->dateStop = $dateStop;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateStop()
    {
        return $this->dateStop;
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
     * @param string $userlink
     */
    public function setUserlink($userlink)
    {
        $this->userlink = $userlink;
    }

    /**
     * @return string
     */
    public function getUserlink()
    {
        return $this->userlink;
    }

    /**
     * @ORM\PrePersist
     */
    public function createUser()
    {
        $this->userlink = urlencode(str_replace(array('@', '&', '#', '_', '-', '+', '='), '', strtolower($this->user->getUsername())));
    }
}
