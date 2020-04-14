<?php

declare(strict_types = 1);

namespace Payum\LaravelPackage;

use Illuminate\Container\Container;
use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\CoreGatewayFactory as BaseCoreGatewayFactory;
use Payum\Core\Gateway;

class CoreGatewayFactory extends BaseCoreGatewayFactory
{
    /**
     * @var Container
     */
    private $container;

    public function setContainer(Container $container): self
    {
        $this->container = $container;

        return $this;
    }

    protected function buildActions(Gateway $gateway, ArrayObject $config)
    {
        foreach ($config as $name => $value) {
            if (false === is_object($config[$name]) && 0 === strpos($name, 'payum.action')) {
                $config[$name] = $this->container[$config[$name]];
            }
        }

        parent::buildActions($gateway, $config);
    }

    protected function buildApis(Gateway $gateway, ArrayObject $config)
    {
        foreach ($config as $name => $value) {
            if (false === is_object($config[$name]) && 0 === strpos($name, 'payum.api')) {
                $config[$name] = $this->container[$config[$name]];
            }
        }

        parent::buildApis($gateway, $config);
    }

    protected function buildExtensions(Gateway $gateway, ArrayObject $config)
    {
        foreach ($config as $name => $value) {
            if (false === is_object($config[$name]) && 0 === strpos($name, 'payum.extension')) {
                $config[$name] = $this->container[$config[$name]];
            }
        }

        parent::buildExtensions($gateway, $config);
    }
}
