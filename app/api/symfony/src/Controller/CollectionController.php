<?php
namespace Api\Controller;

use Core\Entity\Collection;
use Api\Service\Entity\CollectionService;
use Api\Service\Entity\PostService;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CollectionController extends AbstractFOSRestController
{
    /**
     * Get collection list
     *
     * @Annotations\Get("/collections")
     */
    public function getCollectionsAction(CollectionService $collectionService)
    {
        return $collectionService->findAll();
    }

    /**
     * Get a collection
     *
     * @Annotations\Get("/collections/{collection}")
     * @ParamConverter("collection", options={"fields": {"slug", "id"}})
     */
    public function getCollectionAction(Collection $collection)
    {
        return $collection;
    }

    /**
     * Get collection posts
     *
     * @Annotations\Get("/collections/{collection}/posts")
     * @ParamConverter("collection", options={"fields": {"slug", "id"}})
     */
    public function getCollectionPostsAction(Collection $collection)
    {
        return $collection->getPosts();
    }
}
