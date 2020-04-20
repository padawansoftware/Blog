<?php
namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Core\Library\Interfaces\EnabledInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="Page")
 */
class Page implements EnabledInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="page_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="page_name", type="string", length=64)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="page_slug", type="string", length=64, unique=true)
     * @Assert\Regex(pattern="/^[a-z0-9][a-z0-9\-]*[a-z0-9]$/")
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="page_content", type="text")
     */
    protected $content;

    /**
     * @var boolean
     *
     * @ORM\Column(name="page_enabled", type="boolean")
     */
    protected $enabled;


    public function __construct()
    {
        $this->enabled = false;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     *
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param boolean $enabled
     *
     * @return self
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }
}
