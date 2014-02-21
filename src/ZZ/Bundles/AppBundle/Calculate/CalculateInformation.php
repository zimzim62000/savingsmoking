<?php

namespace ZZ\Bundles\AppBundle\Calculate;

use ZZ\Bundles\AppBundle\Entity\UserSmoke;
use ZZ\Bundles\AppBundle\Model\SavingSmoking;

class CalculateInformation
{
    private $savingsmoking;
    private $usersmoke;
    private $calculateDay;
    private $numberPacket;
    private $numberCigarette;

    public function __construct(CalculateNumberDay $calculateDay)
    {
        $this->calculateDay = $calculateDay;
    }

    public function calculateNumberOfPacket(\DateInterval $diff){
        $nbDay = $diff->days;
        $this->numberCigarette = $this->usersmoke->getNumber() * $nbDay;
        $this->numberPacket = round($this->numberCigarette / $this->usersmoke->getCigarette()->getNumber());
        return $this->numberPacket;
    }

    public function calculate()
    {
        $this->calculateDay->setDateStart($this->getUsersmoke()->getDateStop())->setDateEnd(null);
        $diff = $this->calculateDay->calculate();

        $this->savingsmoking->calculateTextIntro($diff);

        $this->calculateNumberOfPacket($diff);
        $this->savingsmoking->setNumberPacket($this->numberPacket);
        $this->savingsmoking->setNumberCigarette($this->numberCigarette);
        $this->savingsmoking->setGoudron(round($this->numberPacket * $this->usersmoke->getCigarette()->getGoudron(), 2));
        $this->savingsmoking->setMonoxyde(round($this->numberPacket * $this->usersmoke->getCigarette()->getMonoxyde(), 2));
        $this->savingsmoking->setNicotine(round($this->numberPacket * $this->usersmoke->getCigarette()->getNicotine(), 2));

        return $this->savingsmoking;
    }

    /**
     * @param mixed $savingsmoking
     */
    public function setSavingsmoking(SavingSmoking $savingsmoking)
    {
        $this->savingsmoking = $savingsmoking;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSavingsmoking()
    {
        return $this->savingsmoking;
    }

    /**
     * @param mixed $usersmoke
     */
    public function setUsersmoke(UserSmoke $usersmoke)
    {
        $this->usersmoke = $usersmoke;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsersmoke()
    {
        return $this->usersmoke;
    }


}