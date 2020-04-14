<?php

declare(strict_types = 1);

namespace Payum\LaravelPackage\Model;

use Illuminate\Database\Eloquent\Model;
use Payum\Core\Security\TokenInterface;
use Payum\Core\Security\Util\Random;

class Token extends Model implements TokenInterface
{
    /**
     * @var string
     */
    protected $table = 'payum_tokens';

    /**
     * @var string
     */
    protected $primaryKey = 'hash';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var bool
     */
    protected static $unguarded = true;

    public function __construct(array $attributes = [])
    {
        if (empty($attributes['hash'])) {
            $attributes['hash'] = Random::generateToken();
        }

        parent::__construct($attributes);
    }

    public function getHash()
    {
        return $this->getAttribute('hash');
    }

    public function setHash($hash)
    {
        $this->setAttribute('hash', $hash);
    }

    public function setDetails($details)
    {
        $this->setAttribute('details', serialize($details));
    }

    public function getDetails()
    {
        return unserialize($this->getAttribute('details'));
    }

    public function getTargetUrl()
    {
        return $this->getAttribute('targetUrl');
    }

    public function setTargetUrl($targetUrl)
    {
        $this->setAttribute('targetUrl', $targetUrl);
    }

    public function getAfterUrl()
    {
        return $this->getAttribute('afterUrl');
    }

    public function setAfterUrl($afterUrl)
    {
        $this->setAttribute('afterUrl', $afterUrl);
    }

    public function getGatewayName()
    {
        return $this->getAttribute('gatewayName');
    }

    public function setGatewayName($gatewayName)
    {
        $this->setAttribute('gatewayName', $gatewayName);
    }
}
