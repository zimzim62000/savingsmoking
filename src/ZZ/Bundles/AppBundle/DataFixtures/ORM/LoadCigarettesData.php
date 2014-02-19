<?php
namespace ZZ\Bundles\AppBundle\DataFixtures\ORM;

use Doctrine\Common as Common;
use ZZ\Bundles\AppBundle\Entity\Cigarette;

class LoadCigarettesData extends Common\DataFixtures\AbstractFixture implements Common\DataFixtures\OrderedFixtureInterface
{
	public function load(Common\Persistence\ObjectManager $om)
	{
        $cigarette = new Cigarette();
        $cigarette->setName('MARLBORO 20');
        $cigarette->setGoudron(10);
        $cigarette->setNicotine(0.8);
        $cigarette->setMonoxyde(10);
        $cigarette->setNumber(20);
        $om->persist($cigarette);
        $this->addReference('MARLBORO_20', $cigarette);

        $cigarette = new Cigarette();
        $cigarette->setName('MARLBORO MEDIUM 20');
        $cigarette->setGoudron(10);
        $cigarette->setNicotine(0.8);
        $cigarette->setMonoxyde(10);
        $cigarette->setNumber(20);
        $om->persist($cigarette);
        $this->addReference('MARLBORO_MEDIUM_20', $cigarette);

        $cigarette = new Cigarette();
        $cigarette->setName('MARLBORO LIGHT 20');
        $cigarette->setGoudron(10);
        $cigarette->setNicotine(0.8);
        $cigarette->setMonoxyde(10);
        $cigarette->setNumber(20);
        $om->persist($cigarette);
        $this->addReference('MARLBORO_LIGHT_20', $cigarette);

        $cigarette = new Cigarette();
        $cigarette->setName('MARLBORO MENTHOL 20');
        $cigarette->setGoudron(10);
        $cigarette->setNicotine(0.8);
        $cigarette->setMonoxyde(10);
        $cigarette->setNumber(20);
        $om->persist($cigarette);
        $this->addReference('MARLBORO_MENTHOL_20', $cigarette);

        $cigarette = new Cigarette();
        $cigarette->setName('CAMEL 20');
        $cigarette->setGoudron(10);
        $cigarette->setNicotine(0.8);
        $cigarette->setMonoxyde(10);
        $cigarette->setNumber(20);
        $om->persist($cigarette);
        $this->addReference('CAMEL_20', $cigarette);

        $cigarette = new Cigarette();
        $cigarette->setName('CAMEL LIGHT 20');
        $cigarette->setGoudron(10);
        $cigarette->setNicotine(0.8);
        $cigarette->setMonoxyde(10);
        $cigarette->setNumber(20);
        $om->persist($cigarette);
        $this->addReference('CAMEL_LIGHT_20', $cigarette);

        $cigarette = new Cigarette();
        $cigarette->setName('CAMEL MENTHOL 20');
        $cigarette->setGoudron(10);
        $cigarette->setNicotine(0.8);
        $cigarette->setMonoxyde(10);
        $cigarette->setNumber(20);
        $om->persist($cigarette);
        $this->addReference('CAMEL_MENTHOL_20', $cigarette);

        $om->flush();
	}
	
	public function getOrder()
	{
		return 1;
	}
}