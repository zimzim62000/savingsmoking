<?php

namespace ZZ\Bundles\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->remove('username');
        $builder->remove('plainPassword');
        $builder->add('plainPassword', 'password');
    }

    public function getName()
    {
        return 'zz_user_registration';
    }
}