<?php

namespace ZZ\Bundles\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ZZBundlesUserBundle extends Bundle
{
    public function getParent(){
        return 'FOSUserBundle';
    }
}
