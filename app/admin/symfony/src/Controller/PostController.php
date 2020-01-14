<?php
namespace Admin\Controller;

use Core\Entity\Collection;
use Core\Entity\Post;
use Admin\Form\PostType;
use Admin\Service\Entity\PostService;
use Admin\Service\Entity\AssetService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Admin\Form\ImageAssetType;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

/**
 * @Route("/posts")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="posts_index")
     */
    public function indexAction(PostService $postService)
    {
        $posts = $postService->findAll();

        return $this->render('Post/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/create", name="posts_create")
     */
    public function createAction(Request $request, PostService $postService)
    {
        $post = $postService->create();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $postService->persist($post);

                $this->addFlash('success', 'Post created successfully');

                if ($form->get('save&exit')->isClicked()) {
                    return $this->redirectToRoute('posts_index');
                } else {
                    return $this->redirectToRoute('posts_edit', ['post' => $post->getId()]);
                }
            } else {
                $this->addFlash('error', 'Error in fields validation');
            }
        }

        return $this->render('Post/form.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
            'form_action' => 'create'
        ]);
    }

    /**
     * @Route("/{post}/edit", name="posts_edit")
     */
    public function editAction(Request $request, Post $post, PostService $postService)
    {
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $postService->update();

                $this->addFlash('success', 'Post edited successfully');

                if ($form->get('save&exit')->isClicked()) {
                    return $this->redirectToRoute('posts_index');
                }
            } else {
                $this->addFlash('error', 'Error in fields validation');
            }
        }

        return $this->render('Post/form.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
            'form_action' => 'edit'
        ]);
    }

    /**
     * @Route("/{post}", name="posts_delete", methods={"DELETE"})
     */
    public function deleteAction(Post $post, PostService $postService)
    {
        $postService->remove($post);

        return new Response();
    }

    /**
     * @Route("/_toggle_status", name="_posts_toggle_status")
     */
    public function toggleStatusAction(Request $request, PostService $postService)
    {
        $post = $postService->find($request->get('post', false));
        if ($post instanceof Post) {
            $post->toggleStatus();
            $postService->update();
        }

        return new Response();
    }

    /**
     * @Route("/{post}/sort", name="_posts_sort", options={"expose"=true})
     */
    public function sortAction(Request $request, Post $post, PostService $postService)
    {
        $postService->sort($post, $request->request->get('order'));

        return new Response();
    }

    /**
     * @Route("/{post}/_upload_chapter_image", name="_posts_upload_chapter_image", options={"expose"=true})
     */
    public function uploadDocumentAction(Request $request, Post $post, AssetService $assetService, UploaderHelper $uploaderHelper)
    {
        $asset = $assetService->create();
        $form = $this->createForm(ImageAssetType::class, $asset, ['csrf_protection' => false, 'entity' => $post]);
        $response = [
            "success" => false
        ];

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $assetService->persist($asset);

            $extension = $asset->getExtension();
            $response = [
                "success" => true,
                "format" => $extension,
                "link" => $request->getSchemeAndHttpHost() . $uploaderHelper->asset($asset, 'file')
            ];
        }

        return new JsonResponse($response);
    }
}
