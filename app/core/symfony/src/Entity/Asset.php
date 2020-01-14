<?php
namespace Core\Entity;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;
use PSUploaderBundle\Entity\Asset as BaseAsset;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use PSUploaderBundle\Library\Interfaces\EntityAssetInterface;

/**
 * @ORM\Entity
 */
class Asset extends BaseAsset implements EntityAssetInterface
{
    /**
     * @var mixed
     *
     * The entity this asset it attached to
     */
    protected $entity;

    /**
     * @var string
     */
    protected $url;


    /**
     * @return mixed
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param mixed $entity
     *
     * @return self
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function getExtension()
    {
        return $this->file->guessExtension();
    }
}
