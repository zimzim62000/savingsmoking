<?php
namespace ZZ\Bundles\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DatePickerType extends AbstractType
{

    public function getParent()
    {
        return 'date';
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $year = intVal(date('Y'));
        for ($i = $year; $i > ($year - 5); $i--){
            $tabYears[$i] = $i;
        }

        $resolver->setDefaults(
            array(
                'attr'        => array(
                    'label-inline' => 'label-inline',
                ),
                'widget'      => 'choice',
                'empty_value' => array(
                    'year'  => 'form.datepickertype.date.emptyvalue.year',
                    'month' => 'form.datepickertype.date.emptyvalue.month',
                    'day'   => 'form.datepickertype.date.emptyvalue.day'
                ),
                'years'       => $tabYears,
                'format'      => 'yyyy-MM-dd',
            )
        );
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'zz_bundle_appbundle_datepicker';
    }
}
