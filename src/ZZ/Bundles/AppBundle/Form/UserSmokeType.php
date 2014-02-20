<?php

namespace ZZ\Bundles\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserSmokeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        for($i = 1; $i < 51; $i++){
            $number[$i] = $i;
        }

        $builder
            ->add(
                'number',
                'choice',
                array(
                    'empty_value' => 'form.usersmoketype.number.emptyvalue',
                    'label'   => 'form.usersmoketype.number.label',
                    'choices' => $number
                )
            )
            ->add(
                'dateStop',
                'zz_bundle_appbundle_datepicker',
                array(
                    'label' => 'form.usersmoketype.dateStop.label'
                )
            )
            ->add(
                'cigarette',
                null,
                array(
                    'empty_value' => 'form.usersmoketype.cigarette.emptyvalue',
                    'label' => 'form.usersmoketype.cigarette.label'
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
                'data_class' => 'ZZ\Bundles\AppBundle\Entity\UserSmoke',
                'attr'       => array(
                    'class' => 'text-center'
                )
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zz_bundles_appbundle_usersmoke';
    }
}
