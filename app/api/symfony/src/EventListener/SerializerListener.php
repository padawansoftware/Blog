<?php
namespace Api\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use FOS\RestBundle\View\View;
use Core\Library\Serialization\EnabledExclusionStrategy;

class SerializerListener
{
    protected $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
    * Set the serialization group for the view if it is specified or Default
    */
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        if (! $event->isMasterRequest()) {
            return;
        }

        $view = $event->getControllerResult();
        if (! $view instanceof View) {
            $view = new View($view);
        }

        $request = $this->requestStack->getCurrentRequest();
        $context = $view->getContext();
        $context->addGroup($request->get('view', 'Default'));
        $context->addExclusionStrategy(new EnabledExclusionStrategy());
        $event->setControllerResult($view);
    }
}
