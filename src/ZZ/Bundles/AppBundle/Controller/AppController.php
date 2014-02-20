<?php

namespace ZZ\Bundles\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    public function indexAction()
    {
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->render('ZZBundlesAppBundle:App:index.html.twig');
        } else {
            return $this->redirect($this->generateUrl('zz_app_usersmoke'));
        }

    }
}
