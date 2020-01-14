<?php
namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use \DateTime;

/**
 * @ORM\Entity()
 * @Vich\Uploadable
 * @ORM\Table(name="Asset")
 */
class Asset
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(name="asset_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var File
     *
     * @Vich\UploadableField(mapping="asset", fileNameProperty="name")
     */
    protected $file;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     *
     * @ORM\Column(name="asset_name", type="string")
     */
    protected $name;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="asset_updated_at", type="date")
     */
    protected $updatedAt;

    /**
     * @var mixed
     *
     * The entity this asset it attached to
     */
    protected $entity;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param File $file
     *
     * @return self
     */
    public function setFile(File $file)
    {
        $this->file = $file;

        if ($file) {
            $this->updatedAt = new DateTime();
        }

        return $this;
    }

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
