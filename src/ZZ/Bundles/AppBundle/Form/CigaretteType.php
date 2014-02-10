<?php

namespace ZZ\Bundles\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CigaretteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('price', 'zz_bundle_appbundle_pricecollection', array(
                    'label' => 'no-label',
                    'type' => new CigarettePriceType(),
                    'required'     => false,
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'attr'         => array('class'          => 'small-block-grid-1 large-block-grid-2 container',
                                            'datachildclass' => 'form.cigarettetype.price.datachildclass',
                                            'dataaddname'    => 'form.cigarettetype.price.dataaddname',
                                            'dataname'       => 'form.cigarettetype.price.dataname',
                                            'datadeletename' => 'form.cigarettetype.price.datadeletename'
                    )
            ));
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZZ\Bundles\AppBundle\Entity\Cigarette'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zz_bundles_appbundle_cigarette';
    }
}
