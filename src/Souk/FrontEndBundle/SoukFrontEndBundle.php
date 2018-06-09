<?php

namespace Souk\FrontEndBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SoukFrontEndBundle extends Bundle
{

    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
