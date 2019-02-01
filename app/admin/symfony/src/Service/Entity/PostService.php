<?php
namespace Admin\Service\Entity;

use Core\Library\Service\BaseEntityService;
use Core\Entity\Collection;
use DateTime;

class PostService extends BaseEntityService
{
    public function getEntityClass():string
    {
        return 'Core\\Entity\\Post';
    }

    public function getByCollection(Collection $collection)
    {
        return $this->findBy(['collection' => $collection]);
    }

    public function persist($post)
    {
        $post->setCreatedAt(new DateTime());

        $image = $post->getImage();
        $post->setImage(null);
        parent::persist($post);

        $post->setImage($image);
        parent::persist($post);
    }
}
