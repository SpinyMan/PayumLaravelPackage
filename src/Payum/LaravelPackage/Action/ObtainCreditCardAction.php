<?php

declare(strict_types = 1);

namespace Payum\LaravelPackage\Action;

use Payum\Core\Action\ActionInterface;
use Payum\Core\Bridge\Symfony\Reply\HttpResponse;
use Payum\Core\Exception\RequestNotSupportedException;
use Payum\Core\Model\CreditCard;
use Payum\Core\Request\ObtainCreditCard;
use Symfony\Component\HttpFoundation\Response;

class ObtainCreditCardAction implements ActionInterface
{

    /**
     * {@inheritDoc}
     */
    public function execute($request)
    {
        /** @var ObtainCreditCard $request */
        if ($this->supports($request) === false) {
            throw RequestNotSupportedException::createActionNotSupported($this, $request);
        }

        if (\Request::isMethod('POST')) {
            $creditCard = new CreditCard();
            $creditCard->setHolder(\Request::input('card_holder'));
            $creditCard->setNumber(\Request::input('card_number'));
            $creditCard->setSecurityCode(\Request::input('card_cvv'));
            $creditCard->setExpireAt(new \DateTime(\Request::input('card_expire_at')));

            $request->set($creditCard);

            return;
        }

        $content = <<<HTML
<!DOCTYPE html>
<html>
<body>

<form method="POST">

<p>
    <label>Holder: </label>
    <input name="card_holder" value="" />
</p>
<p>
    <label>Number: </label>
    <input name="card_number" value="" />
</p>
<p>
    <label>Cvv: </label>
    <input name="card_cvv" value="" />
</p>
<p>
   <label>Expire at: </label>
    <input name="card_expire_at" value="" placeholder="yyyy-mm-dd"/>
</p>

<input type="submit" value="Submit" />
</form>

</body>
</html>
HTML;

        throw new HttpResponse(
            new Response(
                $content, 200, [
                'Cache-Control' => 'no-store, no-cache, max-age=0, post-check=0, pre-check=0',
                'Pragma'        => 'no-cache',
            ]
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function supports($request)
    {
        return $request instanceof ObtainCreditCard;
    }
}
