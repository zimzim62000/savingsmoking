<?php
namespace ZZ\Bundles\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

class PriceCollectionType extends AbstractType
{

    public function getParent()
    {
        return 'collection';
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'zz_bundle_appbundle_pricecollection';
    }
}
