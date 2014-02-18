<?php

namespace ZZ\Bundles\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cigarette
 *
 * @ORM\Table(name="savingsmoke_cigarette")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Cigarette
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
     * @var string
     * @Assert\NotBlank(message="validators.cigarette.name.blank")
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ZZ\Bundles\AppBundle\Entity\CigarettePrice", mappedBy="cigarette", cascade={"persist"})
     * @ORM\OrderBy({"dateStart" = "ASC"})
     */
    private $price;

    /**
     * @param ArrayCollection $price
     */
    public function setPrice($price)
    {
        foreach ($price as $prix) {
            $prix->setCigarette($this);
        }
        $this->price = $price;
    }

    /**
     * @return ArrayCollection
     */
    public function getPrice()
    {
        return $this->price;
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
     * Set name
     *
     * @param string $name
     * @return Cigarette
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

    public function __construct()
    {
        $this->price = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function uppercaseName()
    {
        $this->name = strtoupper($this->name);
    }

    public function __toString()
    {
        return $this->getName();
    }
}
