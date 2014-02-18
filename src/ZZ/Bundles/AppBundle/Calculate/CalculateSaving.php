<?php

namespace ZZ\Bundles\AppBundle\Calculate;


class CalculateSaving
{
    private $user;
    private $calculateNumberDay;
    private $calculateUnitPrice;
    private $calculateSavingSmoking;
    private $dateEnd;

    public function __construct(
        CalculateNumberDay $calculateNumberDay,
        CalculateunitPrice $calculateunitprice,
        CalculateSavingSmoking $calculateSavingSmoking
    ) {
        $this->calculateNumberDay = $calculateNumberDay;
        $this->calculateUnitPrice = $calculateunitprice;
        $this->calculateSavingSmoking = $calculateSavingSmoking;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function setDateEnd(\DateTime $dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function calculateSaving()
    {

        $this->calculateNumberDay->setDateStart($this->user->getUserSmoke()->getDateStop())->setDateEnd(
            $this->dateEnd
        );

        $this->calculateUnitPrice->setCigarette($this->user->getUserSmoke()->getCigarette())->setDateStop(
            $this->user->getUserSmoke()->getDateStop()
        );

        $this->calculateSavingSmoking->setPeriodes($this->calculateUnitPrice->calculate())->setUserSmoke(
            $this->user->getUserSmoke()
        );

        return $this->calculateSavingSmoking->calculate();
    }
}