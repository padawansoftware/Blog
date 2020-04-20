<?php
namespace Api\Controller;

use Api\Service\Entity\PostService;
use Core\Entity\Post;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;

class PostController extends FOSRestController
{
    /**
     * Get posts list
     *
     * @Annotations\Get("/posts")
     */
    public function getPostsAction(Request $request, PostService $postService)
    {
        $posts = $postService->getEnabled();

        // If view is summary, limit chapters to send only 1
        if ($request->get('view', null) == 'summary') {
            array_map(function ($post) {
                $post->setChapters(new ArrayCollection([$post->getChapters()->first()]));
            }, $posts);
        }

        return $posts;
    }

    /**
     * Get a post
     *
     * @Annotations\Get("/posts/{post}")
     * @ParamConverter("post", options={"fields": {"slug", "id"}})
     */
    public function getPostAction(Post $post)
    {
        return $post;
    }
}
