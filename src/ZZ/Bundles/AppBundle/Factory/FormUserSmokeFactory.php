<?php

namespace ZZ\Bundles\AppBundle\Factory;

class FormUserSmokeFactory
{

    private $formFactory;
    private $security;
    private $router;
    private $userSmoke;
    private $userSmokeType;

    public function __construct($formFactory, $security, $router, $userSmoke, $userSmokeType)
    {
        $this->formFactory = $formFactory;
        $this->security = $security;
        $this->router = $router;
        $this->userSmoke = $userSmoke;
        $this->userSmokeType = $userSmokeType;
    }

    public function build(\ZZ\Bundles\UserBundle\Entity\User $user)
    {
        if ($user->getUsersmoke() === null) {
            $form = $this->create($user);
        } else {
            $form = $this->update($user);
        }

        return $form;
    }

    private function create($user)
    {
        $this->userSmoke->setUser($user);
        $form = $this->formFactory->create(
            $this->userSmokeType,
            $this->userSmoke,
            array(
                'action' => $this->router->generate('zz_app_usersmoke_create'),
                'method' => 'POST'
            )
        );
        $form->add('submit', 'submit', array('label' => 'form.usersmoketype.submit.label'));

        return $form;
    }

    private function update($user)
    {
        $this->userSmoke = $user->getUserSmoke();
        $form = $this->formFactory->create(
            $this->userSmokeType,
            $this->userSmoke,
            array(
                'action' => $this->router->generate(
                    'zz_app_usersmoke_update',
                    array('id' => $this->userSmoke->getId())
                ),
                'method' => 'POST'
            )
        );
        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    public function getUserSmoke(){
        return $this->userSmoke;
    }

}