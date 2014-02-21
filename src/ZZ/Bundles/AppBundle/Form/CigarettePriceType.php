<?php

namespace ZZ\Bundles\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CigarettePriceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price')
            ->add('number')
            ->add(
                'dateStart',
                'date',
                array(
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'attr'   => array(
                        'class'       => 'datepicker',
                        'placeholder' => 'yyyy-MM-dd'
                    )
                )
            )
            ->add(
                'dateEnd',
                'zz_bundle_appbundle_datepicker',
                array(
                    'label' => 'form.usersmoketype.dateStop.label'
                )
            );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'ZZ\Bundles\AppBundle\Entity\CigarettePrice'
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zz_bundles_appbundle_cigaretteprice';
    }
}
