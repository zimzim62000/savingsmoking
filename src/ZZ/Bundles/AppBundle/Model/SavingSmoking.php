<?php

namespace ZZ\Bundles\AppBundle\Model;

use ZZ\Bundles\AppBundle\Entity\UserSmoke;

class SavingSmoking
{

    private $savingTotal;
    private $savingDay;
    private $devise = '€';
    private $textIntro = '1';
    private $numberPacket;
    private $numberCigarette;
    private $goudron;
    private $nicotine;
    private $monoxyde;

    /**
     * @param mixed $savingDay
     */
    public function setSavingDay($savingDay)
    {
        $this->savingDay = sprintf("%01.2f", $savingDay);

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

    public function calculateTextIntro(\DateInterval $diff)
    {
        if ($diff->days < 15) {
            $retour = 1;
        } else {
            if ($diff->days < 30) {
                $retour = 2;
            } else {
                if ($diff->days < 60) {
                    $retour = 3;
                } else {
                    $retour = 4;
                }
            }
        }
        $this->setTextIntro($retour);
    }

    /**
     * @param mixed $goudron
     */
    public function setGoudron($goudron)
    {
        $this->goudron = $goudron;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGoudron()
    {
        return $this->goudron;
    }

    /**
     * @param mixed $monoxyde
     */
    public function setMonoxyde($monoxyde)
    {
        $this->monoxyde = $monoxyde;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMonoxyde()
    {
        return $this->monoxyde;
    }

    /**
     * @param mixed $nicotine
     */
    public function setNicotine($nicotine)
    {
        $this->nicotine = $nicotine;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNicotine()
    {
        return $this->nicotine;
    }

    /**
     * @param mixed $numberPacket
     */
    public function setNumberPacket($numberPacket)
    {
        $this->numberPacket = $numberPacket;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumberPacket()
    {
        return $this->numberPacket;
    }

    /**
     * @param mixed $numberCigarette
     */
    public function setNumberCigarette($numberCigarette)
    {
        $this->numberCigarette = $numberCigarette;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumberCigarette()
    {
        return $this->numberCigarette;
    }


}