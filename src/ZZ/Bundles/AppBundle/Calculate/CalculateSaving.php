<?php

namespace ZZ\Bundles\AppBundle\Calculate;


class CalculateSaving
{
    private $usersmoke;
    private $calculateNumberDay;
    private $calculateUnitPrice;
    private $calculateSavingSmoking;
    private $calculateInformation;
    private $dateEnd;

    public function __construct(
        CalculateNumberDay $calculateNumberDay,
        CalculateunitPrice $calculateunitprice,
        CalculateSavingSmoking $calculateSavingSmoking,
        CalculateInformation $calculateInformation
    ) {
        $this->calculateNumberDay = $calculateNumberDay;
        $this->calculateUnitPrice = $calculateunitprice;
        $this->calculateSavingSmoking = $calculateSavingSmoking;
        $this->calculateInformation = $calculateInformation;
    }

    public function setUserSmoke($usersmoke)
    {
        $this->usersmoke = $usersmoke;

        return $this;
    }

    public function setDateEnd(\DateTime $dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function calculateSaving()
    {

        $this->calculateNumberDay->setDateStart($this->usersmoke->getDateStop())->setDateEnd(
            $this->dateEnd
        );

        $this->calculateUnitPrice->setCigarette($this->usersmoke->getCigarette())->setDateStop(
            $this->usersmoke->getDateStop()
        );

        $this->calculateSavingSmoking->setPeriodes($this->calculateUnitPrice->calculate())->setUserSmoke(
            $this->usersmoke
        );

        $this->calculateInformation->setSavingsmoking($this->calculateSavingSmoking->calculate())->setUsersmoke(
            $this->usersmoke
        );

        return $this->calculateInformation->calculate();
    }
}