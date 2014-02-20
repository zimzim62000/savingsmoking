<?php
namespace ZZ\Bundles\AppBundle\DataFixtures\ORM;

use Doctrine\Common as Common;
use ZZ\Bundles\AppBundle\Entity\CigarettePrice;

class LoadCigarettePriceData extends Common\DataFixtures\AbstractFixture implements Common\DataFixtures\OrderedFixtureInterface
{
	public function load(Common\Persistence\ObjectManager $om)
	{

        $tabMarque = array(
            'MARLBORO_20',
            'MARLBORO_MEDIUM_20',
            'MARLBORO_LIGHT_20',
            'MARLBORO_MENTHOL_20',
            'CAMEL_20',
            'CAMEL_LIGHT_20',
            'CAMEL_MENTHOL_20'
        );

        $tabDate = array(
            array(
                'start' => '2010-10-01',
                'end' => '2012-09-31',
                'price' => '6.30',
            ),
            array(
                'start' => '2012-10-01',
                'end' => '2013-12-31',
                'price' => '6.70',
            ),
            array(
                'start' => '2014-01-01',
                'end' => null,
                'price' => '7.00',
            ),
        );


        foreach($tabDate as $date){

            foreach($tabMarque as $marque){

                $cigarettePrice = new CigarettePrice();
                $cigarettePrice->setCigarette($this->getReference($marque));
                $cigarettePrice->setPrice($date['price']);
                $cigarettePrice->setDateStart(new \DateTime($date['start']));
                if(isset($date['end'])){
                    $cigarettePrice->setDateEnd(new \DateTime($date['end']));
                }else{
                    $cigarettePrice->setDateEnd(null);
                }
                $om->persist($cigarettePrice);
            }
        }

        $om->flush();
	}
	
	public function getOrder()
	{
		return 2;
	}
}