<?php
namespace Api\Controller;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Core\Entity\Page;
use Api\Service\Entity\PageService;

class PageController extends AbstractFOSRestController
{
    /**
     * Get a page
     *
     * @Annotations\Get("/pages/{page}")
     * @ParamConverter("page", options={"fields": {"slug", "id"}})
     */
    public function getPageAction(Page $page, PageService $pageService)
    {
        return $page;
    }
}
