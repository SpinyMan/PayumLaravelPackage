<?php

declare(strict_types = 1);

namespace Payum\LaravelPackage\Registry;

use Illuminate\Container\Container;
use Payum\Core\Registry\AbstractRegistry;

class ContainerAwareRegistry extends AbstractRegistry
{
    /**
     * @var Container
     */
    protected $container;

    public function setContainer(Container $container): self
    {
        $this->container = $container;

        return $this;
    }

    protected function getService($id)
    {
        return is_object($id) ? $id : $this->container[$id];
    }
}
