<?php
namespace Core\Entity;

use \DateTime;
use Core\Library\Annotations\Asset as AssetAnnotation;
use Core\Library\Interfaces\EnabledInterface;
use Core\Library\Validation\ImageAsset as ImageAssetConstraint;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Core\EntityRepository\PostRepository")
 * @ORM\Table(name="Post",
 *            uniqueConstraints={@ORM\UniqueConstraint(name="slug",columns={"post_slug"})}
 * )
 * @ORM\HasLifecycleCallbacks
 * @AssetAnnotation("image")
 */
class Post implements EnabledInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="post_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"list", "summary"})
     */
    protected $id;

    /**
     * @ORM\Column(name="post_title", type="string", length=128)
     * @JMS\Groups({"list", "detail", "summary"})
     */
    protected $title;

    /**
     * @ORM\OneToMany(targetEntity="Chapter", mappedBy="post", cascade={"persist"}, orphanRemoval=true)
     * @JMS\Groups({"detail", "summary"})
     */
    protected $chapters;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     * @JMS\Exclude
     */
    protected $createdAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="post_enabled", type="boolean", options={"default": false})
     * @JMS\Exclude
     */
    protected $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="post_slug", type="string", length=128)
     * @Assert\Regex(pattern="/^[a-z][a-z\-]*[a-z]$/")
     * @JMS\Groups({"list", "summary"})
     */
    protected $slug;

    /**
     * @var int
     *
     * @ORM\Column(name="post_order", type="integer")
     */
    protected $order;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Collection", mappedBy="posts")
     * @JMS\Exclude
     */
    protected $collections;


    /**
     * @var Asset
     *
     * @Assert\NotNull
     * Assert image and 23/9 aspect ratio
     * @ImageAssetConstraint(
     *  minRatio = 2.55,
     *  maxRatio = 2.56
     * )
     *
     * @ORM\OneToOne(targetEntity="Asset", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="post_image", referencedColumnName="asset_id", nullable=true)
     * @JMS\Exclude
     */
    protected $image;


    public function __construct()
    {
        $this->chapters = new ArrayCollection();
        $this->collections = new ArrayCollection();
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

    /**
     * @return Chapter
     */
    public function getChapters()
    {
        return $this->chapters;
    }

    /**
     * @param ArrayCollection $chapters
     *
     * @return self
     */
    public function setChapters(ArrayCollection $chapters)
    {
        $this->chapters = $chapters;

        return $this;
    }

    /**
     * @param Chapter $chapter
     *
     * @return self
     */
    public function addChapter(Chapter $chapter)
    {
        $chapter->setPost($this);
        $this->chapters->add($chapter);

        return $this;
    }

    /**
     * @param Chapter $chapter
     *
     * @return self
     */
    public function removeChapter(Chapter $chapter)
    {
        $this->chapters->removeElement($chapter);

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

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
     * @return ArrayCollection
     */
    public function getCollections()
    {
        return $this->collections;
    }

    /**
     * @param ArrayCollection $collections
     *
     * @return self
     */
    public function setCollections(ArrayCollection $collections)
    {
        $this->collections = $collections;

        return $this;
    }

    public function addCollection(Collection $collection)
    {
        if ($this->collections->contains($collection)) {
            return;
        }

        $this->collections->add($collection);
        $collection->addPost($this);

        return $this;
    }

    public function removeCollection(Collection $collection)
    {
        if (! $this->collections->contains($collection)) {
            return;
        }
        $this->collections->removeElement($collection);
        $collection->removePost($this);

        return $this;
    }

    public function toggleStatus()
    {
        $this->enabled = ! $this->enabled;
    }

    /**
     * @return Asset
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param Asset $image
     *
     * @return self
     */
    public function setImage(?Asset $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @JMS\VirtualProperty
     * @JMS\Groups({"list", "summary"})
     */
    public function getImageUrl()
    {
        return $this->image->getUrl();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     *
     * @return self
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }
}
