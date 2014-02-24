<?php

namespace ZZ\Bundles\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    public function indexAction()
    {
        return $this->render('ZZBundlesAppBundle:App:index.html.twig');
    }
}
