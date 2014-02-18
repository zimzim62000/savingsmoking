<?php

namespace ZZ\Bundles\AppBundle\Model;

class SavingSmoking
{

    private $savingTotal;
    private $savingDay;
    private $devise = '€';
    private $textIntro = '1';

    /**
     * @param mixed $savingDay
     */
    public function setSavingDay($savingDay)
    {
        $this->savingDay = $savingDay;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSavingDay()
    {
        return $this->savingDay;
    }

    /**
     * @param mixed $savingTotal
     */
    public function setSavingTotal($savingTotal)
    {
        $this->savingTotal = $savingTotal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSavingTotal()
    {
        return $this->savingTotal;
    }

    /**
     * @param string $devise
     */
    public function setDevise($devise)
    {
        $this->devise = $devise;

        return $this;
    }

    /**
     * @return string
     */
    public function getDevise()
    {
        return $this->devise;
    }

    /**
     * @param string $textIntro
     */
    public function setTextIntro($textIntro)
    {
        $this->textIntro = $textIntro;

        return $this;
    }

    /**
     * @return string
     */
    public function getTextIntro()
    {
        return $this->textIntro;
    }


}