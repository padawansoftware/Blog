<?php
namespace Api\EventListener;

use Api\Service\Entity\PostService;
use Core\Library\Serialization\EnabledExclusionStrategy;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Core\Library\Interfaces\HashableInterface;
use Core\Library\Interfaces\EnabledInterface;

class ViewListener
{
    protected $requestStack;
    protected $postService;

    public function __construct(RequestStack $requestStack, PostService $postService)
    {
        $this->requestStack = $requestStack;
        $this->postService = $postService;
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        if (! $event->isMasterRequest()) {
            return;
        }

        // Create the view instance
        $view = $event->getControllerResult();
        if (! $view instanceof View) {
            $view = new View($view);
        }

        $request = $this->requestStack->getCurrentRequest();

        $this
            ->addGroups($view, $request)
            ->checkPreview($view, $request)
        ;

        $event->setControllerResult($view);
    }

    /**
     * Set serialization group depending on the request
     */
    protected function addGroups($view, $request)
    {
        $context = $view->getContext();

        $context->addGroup($request->get('view', 'Default'));

        return $this;
    }

    /**
     * Check whether the entity serialized is available or not
     */
    protected function checkPreview($view, $request)
    {
        $entity = $view->getData();
        $context = $view->getContext();

        if ($entity instanceof EnabledInterface && ! $entity->isEnabled()) {
            if (! ($entity instanceof HashableInterface && $request->get('preview', false) == $entity->getHash())) {
                throw new NotFoundHttpException();
            }
        } else {
            // If not an enabled interface, add EnabledExclusionStrategy
            $context->addExclusionStrategy(new EnabledExclusionStrategy());
        }

        return $this;
    }
}
