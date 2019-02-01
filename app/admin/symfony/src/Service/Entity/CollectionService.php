<?php
namespace Admin\Service\Entity;

use Core\Library\Service\BaseEntityService;
use Core\Entity\Collection;
use Core\Entity\Post;
use Admin\Service\Entity\PostService;
use Doctrine\Common\Persistence\ManagerRegistry as Doctrine;

class CollectionService extends BaseEntityService
{
    protected $postService;

    public function __construct(Doctrine $doctrine, PostService $postService)
    {
        $this->postService = $postService;

        parent::__construct($doctrine);
    }

    public function getEntityClass():string
    {
        return 'Core\\Entity\\Collection';
    }

    public function addPosts(Collection $collection, $posts)
    {
        foreach ($posts as $post) {
            if (! $post instanceof Post) {
                $post = $this->postService->find($post);
            }
            $collection->addPost($post);
        }

        $this->update();
    }

    public function persist($collection)
    {
        $image = $collection->getImage();
        $collection->setImage(null);
        parent::persist($collection);

        $collection->setImage($image);
        parent::persist($collection);
    }
}
