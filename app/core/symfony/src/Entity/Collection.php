<?php
namespace Core\Entity;

use PSUploaderBundle\Library\Validation\ImageAsset as ImageAssetConstraint;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;
use PSUploaderBundle\Library\Annotation\Asset as AssetAnnotation;

/**
 * @AssetAnnotation("image")
 * @ORM\Entity()
 * @ORM\Table(name="Collection")
 * @ORM\HasLifecycleCallbacks
 */
class Collection
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="collection_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups("list")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="collection_name", type="string")
     * @JMS\Groups("list")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="post_slug", type="string")
     * @Assert\Regex(pattern="/^[a-z][a-z\-]*[a-z]$/")
     * @JMS\Groups("list")
     */
    protected $slug;

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
     * @ORM\JoinColumn(name="collection_image", referencedColumnName="asset_id")
     * @JMS\Exclude
     */
    protected $image;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Post", inversedBy="collections")
     * @ORM\JoinTable(name="Collection_Post",
     *   joinColumns = {@ORM\JoinColumn(name="collection_id", referencedColumnName="collection_id")},
     *   inverseJoinColumns = {@ORM\JoinColumn(name="post_id", referencedColumnName="post_id")}
     * )
     * @JMS\Groups("posts")
     */
    protected $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
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
     * @return ArrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param ArrayCollection $posts
     *
     * @return self
     */
    public function setPosts(ArrayCollection $posts)
    {
        $this->posts = $posts;

        return $this;
    }

    public function addPost(Post $post)
    {
        if ($this->posts->contains($post)) {
            return;
        }

        $this->posts->add($post);
        $post->addCollection($this);

        return $this;
    }

    public function removePost(Post $post)
    {
        if (! $this->posts->contains($post)) {
            return;
        }

        $this->posts->removeElement($post);
        $post->removeCollection($this);

        return $this;
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
     * @JMS\VirtualProperty
     * @JMS\Groups("list")
     */
    public function getImageUrl()
    {
        return $this->image->getUrl();
    }

    /**
     * @JMS\VirtualProperty
     * @JMS\Groups("list")
     */
    public function getPostsLength()
    {
        return count($this->posts);
    }
}
