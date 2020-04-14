<?php

declare(strict_types = 1);

namespace Payum\LaravelPackage\Model;

use Illuminate\Database\Eloquent\Model;
use Payum\Core\Model\GatewayConfigInterface;

class GatewayConfig extends Model implements GatewayConfigInterface
{
    /**
     * @var string
     */
    protected $table = 'payum_gateway_configs';

    public function getGatewayName()
    {
        return $this->getAttribute('gatewayName');
    }

    public function setGatewayName($gatewayName)
    {
        $this->setAttribute('gatewayName', $gatewayName);
    }

    public function getFactoryName()
    {
        return $this->getAttribute('factoryName');
    }

    public function setFactoryName($name)
    {
        $this->setAttribute('factoryName', $name);
    }

    public function setConfig(array $config)
    {
        $this->setAttribute('config', json_encode($config));
    }

    public function getConfig()
    {
        return json_decode($this->getAttribute('config') ?: '{}', true);
    }
}
