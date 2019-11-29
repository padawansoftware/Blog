<?php
namespace Admin\Service\Entity;

use \DateTime;
use Core\Entity\Collection;
use Core\Entity\Post;
use Core\Library\Service\BaseEntityService;

class PostService extends BaseEntityService
{
    public function getEntityClass():string
    {
        return 'Core\\Entity\\Post';
    }

    public function findAll()
    {
        return $this->repository->findBy([], ['order' => 'ASC']);
    }

    public function findByOrderRange($minOrder, $maxOrder)
    {
        return $this->repository->findByOrderRange($minOrder, $maxOrder);
    }

    public function getByCollection(Collection $collection)
    {
        return $this->findBy(['collection' => $collection]);
    }

    public function persist($post)
    {
        $post->setCreatedAt(new DateTime());
        $post->setOrder($this->repository->getMaxOrder() + 1);

        $image = $post->getImage();
        $post->setImage(null);
        parent::persist($post);

        $post->setImage($image);
        parent::persist($post);
    }

    /**
     * Sort post, giving it a new order to all posts affected by the change
     */
    public function sort(Post $post, $newOrder)
    {
        $previousOrder = $post->getOrder();

        $post->setOrder($newOrder);
        if ($previousOrder > $newOrder) {
            $postsToOrder = $this->findByOrderRange($newOrder, $previousOrder -1);
            foreach ($postsToOrder as $postToOrder) {
                $postToOrder->setOrder($postToOrder->getOrder() + 1);
            }
        } elseif ($previousOrder < $newOrder) {
            $postsToOrder = $this->findByOrderRange($previousOrder + 1, $newOrder);
            foreach ($postsToOrder as $postToOrder) {
                $postToOrder->setOrder($postToOrder->getOrder() - 1);
            }
        }

        $this->update();
    }
}
