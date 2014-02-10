<?php

namespace ZZ\Bundles\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    public function indexAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        return $this->render(
            'ZZBundlesAppBundle:App:index.html.twig',
            array(
                'user' => $user
            )
        );
    }
}
