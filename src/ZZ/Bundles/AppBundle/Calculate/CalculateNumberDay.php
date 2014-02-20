<?php

namespace ZZ\Bundles\AppBundle\Calculate;

class CalculateNumberDay
{

    private $dateStart;
    private $dateEnd;

    /**
     * @param mixed $dateEnd
     */
    public function setDateEnd($dateEnd)
    {
        if ($dateEnd === null) {
            $dateEnd = new \DateTime('now');
        }
        $this->dateEnd = clone $dateEnd;

        return $this;
    }

    /**
     * @param mixed $dateStart
     */
    public function setDateStart(\Datetime $dateStart)
    {
        $this->dateStart = clone $dateStart;

        return $this;
    }

    /**
     * @return \DateInterval
     */
    public function calculate()
    {

        return $this->dateEnd->diff($this->dateStart);
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @return mixed
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

}