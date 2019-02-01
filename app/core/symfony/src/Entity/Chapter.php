<?php
namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Core\Library\Interfaces\EnabledInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="Chapter")
 */
class Chapter implements EnabledInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Exclude
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="chapter_content", type="text")
     * @JMS\Groups({"detail", "summary"})
     */
    protected $content;

    /**
     * @var Post
     *
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="chapters")
     * @ORM\JoinColumn(name="chapter_post", referencedColumnName="post_id", onDelete="cascade")
     * @JMS\Exclude
     */
    protected $post;

    /**
     * @var boolean
     *
     * @ORM\Column(name="chapter_enabled", type="boolean")
     * @JMS\Exclude
     */
    protected $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="chapter_title", type="string", length=255)
     * @JMS\Groups({"detail", "summary"})
     */
    protected $title;


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
     * @param mixed $id
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
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param Post $post
     *
     * @return self
     */
    public function setPost(Post $post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isEnabled():bool
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

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}
