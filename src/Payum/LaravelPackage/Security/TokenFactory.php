<?php

declare(strict_types = 1);

namespace Payum\LaravelPackage\Security;

use Payum\Core\Security\AbstractTokenFactory;

class TokenFactory extends AbstractTokenFactory
{
    protected function generateUrl($path, array $parameters = [])
    {
        return \URL::route($path, $parameters);
    }
}
