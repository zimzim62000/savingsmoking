<?php

namespace ZZ\Bundles\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CigarettePrice
 *
 * @ORM\Table(name="savingsmoke_cigarette_price")
 * @ORM\Entity
 */
class CigarettePrice
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
     * @var ZZ\Bundles\AppBundle\Entity\Cigarette
     *
     * @Assert\NotBlank(message="validators.cigaretteprice.cigarette.blank")
     *
     * @ORM\ManyToOne(targetEntity="ZZ\Bundles\AppBundle\Entity\Cigarette", inversedBy="price", cascade={"persist"})
     * @ORM\JoinColumn(name="id_cigarette", referencedColumnName="id")
     */
    private $cigarette;

    /**
     * @var integer
     *
     * @Assert\NotBlank(message="validators.cigaretteprice.number.blank")
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var float
     *
     * @Assert\NotBlank(message="validators.cigaretteprice.price.blank")
     * @ORM\Column(name="price", type="decimal", precision=3, scale=2)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank(message="validators.cigaretteprice.dateStart.blank")
     * @ORM\Column(name="dateStart", type="date")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank(message="validators.cigaretteprice.dateEnd.blank")
     * @ORM\Column(name="dateEnd", type="date", nullable=true)
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
     * Set cigarette
     *
     * @param integer $cigarette
     * @return CigarettePrice
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
     * Set price
     *
     * @param float $price
     * @return CigarettePrice
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return CigarettePrice
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
     * @return CigarettePrice
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

    /**
     * @param int $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }
}
