<?php

namespace ZZ\Bundles\AppBundle\Calculate;

use ZZ\Bundles\AppBundle\Model\SavingSmoking;

class CalculateSavingSmoking
{
    private $periodes;
    private $userSmoke;
    private $savingSmoking;

    public function __construct(SavingSmoking $savingSmoking)
    {
        $this->savingSmoking = $savingSmoking;
    }

    /**
     * @param mixed $periodes
     */
    public function setPeriodes($periodes)
    {
        $this->periodes = $periodes;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPeriodes()
    {
        return $this->periodes;
    }

    /**
     * @param mixed $userSmoke
     */
    public function setUserSmoke($userSmoke)
    {
        $this->userSmoke = $userSmoke;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserSmoke()
    {
        return $this->userSmoke;
    }

    public function calculate()
    {
        $saving = 0;
        $lastPrice = 0;

        foreach ($this->getPeriodes() as $key => $periode) {
            /** if interval last less 1 day */
            if ($key == (count($this->getPeriodes()) - 1)) {
                $saving += intval($periode->getInterval()->days - 1) * ($periode->getUnitPrice(
                        ) * $this->getUserSmoke()->getNumber());
                $lastPrice = $periode->getUnitPrice() * $this->getUserSmoke()->getNumber();
            } else {
                $saving += $periode->getInterval()->days * ($periode->getUnitPrice() * $this->getUserSmoke(
                        )->getNumber());
            }
        }

        $saving = sprintf("%.2f", round($saving, 2));
        $this->savingSmoking->setSavingTotal($saving);
        $this->savingSmoking->setSavingDay($lastPrice);

        return $this->savingSmoking;
    }
}