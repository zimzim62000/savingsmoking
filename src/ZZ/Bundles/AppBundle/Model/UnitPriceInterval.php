<?php

namespace ZZ\Bundles\AppBundle\Model;

class UnitPriceInterval
{

    private $interval;
    private $unitPrice;

    /**
     * @param mixed $interval
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;

        return $this;
    }

    /**
     * @param mixed $unitPrice
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * @return mixed
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }
}