<?php

declare(strict_types = 1);

namespace Payum\LaravelPackage\Action;

use Illuminate\Support\Facades\View;
use Payum\Core\Action\ActionInterface;
use Payum\Core\Exception\RequestNotSupportedException;
use Payum\Core\Request\RenderTemplate;

class RenderTemplateAction implements ActionInterface
{

    /**
     * {@inheritDoc}
     */
    public function execute($request)
    {
        /** @var RenderTemplate $request */
        RequestNotSupportedException::assertSupports($this, $request);

        $request->setResult(View::make($request->getTemplateName(), $request->getParameters())->render());
    }

    /**
     * {@inheritDoc}
     */
    public function supports($request)
    {
        return $request instanceof RenderTemplate;
    }
}
