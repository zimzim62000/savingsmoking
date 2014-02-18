<?php

namespace ZZ\Bundles\AppBundle\Calculate;

use ZZ\Bundles\AppBundle\Entity\Cigarette;
use ZZ\Bundles\AppBundle\Model\UnitPriceInterval;

class CalculateunitPrice
{

    private $calculateNumberDay;
    private $cigarette;
    private $dateStop;
    private $unitPriceInterval;

    public function __construct(CalculateNumberDay $Calculate, UnitPriceInterval $unitPriceInterval)
    {
        $this->calculateNumberDay = $Calculate;
        $this->unitPriceInterval = $unitPriceInterval;
    }

    public function getCloneCalculateNumberDay()
    {
        return clone $this->calculateNumberDay;
    }

    public function getCloneUnitPriceInterval()
    {
        return clone $this->unitPriceInterval;
    }

    /**
     * @param mixed $cigarette
     */
    public function setCigarette(Cigarette $cigarette)
    {
        $this->cigarette = $cigarette;

        return $this;
    }

    public function setDateStop(\DateTime $dateStop)
    {
        $this->dateStop = clone $dateStop;

        return $this;
    }

    public function calculate()
    {
        $periode = array();
        $firstDate = false;
        foreach ($this->cigarette->getPrice() as $key => $CigarettePrice) {

            /** @If date stop before first date price */
            if ($this->dateStop < $CigarettePrice->getDateStart()) {
                if(!$firstDate){
                    $firstDate = true;
                    $periode[] = $this->addPeriode($CigarettePrice, $this->dateStop);
                }
            }else{
                $firstDate = true;
            }

            /** @If date stop between datestart dateend or dateend == null */
            if ($firstDate && ($this->dateStop <= $CigarettePrice->getDateEnd(
                    ) || $CigarettePrice->getDateEnd() == null)
            ) {
                $periode[] = $this->addPeriode($CigarettePrice, $CigarettePrice->getDateStart());
            }
        }

        return $periode;
    }

    private function addPeriode($CigarettePrice, $dateStart)
    {
        $calculateDayInterval = $this->getCloneCalculateNumberDay();
        $calculateDayInterval->setDateStart($dateStart)->setDateEnd($CigarettePrice->getDateEnd());
        $unitPriceInterval = $this->getCloneUnitPriceInterval();
        $unitPriceInterval->setInterval($calculateDayInterval->calculate());
        $unitPriceInterval->setUnitPrice($CigarettePrice->getPrice() / $CigarettePrice->getNumber());

        return $unitPriceInterval;
    }
}