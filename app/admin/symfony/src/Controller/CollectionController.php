<?php
namespace Admin\Controller;

use Admin\Form\CollectionType;
use Admin\Service\Entity\CollectionService;
use Admin\Service\Entity\PostService;
use Core\Entity\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/collections")
 */
class CollectionController extends Controller
{
    /**
     * @Route("/", name="collections_index")
     */
    public function indexAction(CollectionService $collectionService)
    {
        $collections = $collectionService->findAll();

        return $this->render('Collection/index.html.twig', [
            'collections' => $collections
        ]);
    }

    /**
     * @Route("/create", name="collections_create")
     */
    public function createAction(Request $request, CollectionService $collectionService)
    {
        $collection = $collectionService->create();

        $form = $this->createForm(CollectionType::class, $collection);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $collectionService->persist($collection);

            $this->addFlash('success', 'Collection created successfully');

            if ($form->get('save&exit')->isClicked()) {
                return $this->redirectToRoute('collections_index');
            } else {
                return $this->redirectToRoute('collections_edit', ['collection' => $collection->getId()]);
            }
        }

        return $this->render('Collection/form.html.twig', [
            'form' => $form->createView(),
            'form_action' => 'create'
        ]);
    }

    /**
     * @Route("/{collection}/edit", name="collections_edit")
     */
    public function editAction(Collection $collection, Request $request, CollectionService $collectionService)
    {
        $form = $this->createForm(CollectionType::class, $collection);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $collectionService->update();

            $this->addFlash('success', 'Collection edited successfully');

            if ($form->get('save&exit')->isClicked()) {
                return $this->redirectToRoute('collections_index');
            }
        }

        return $this->render('Collection/form.html.twig', [
            'form' => $form->createView(),
            'form_action' => 'edit'
        ]);
    }

    /**
     * @Route("/{collection}", name="collections_delete", methods={"DELETE"})
     */
    public function deleteAction(Collection $collection, CollectionService $collectionService)
    {
        $collectionService->remove($collection);

        return new Response();
    }

    /**
     * @Route("/{collection}/posts", name="collections_posts")
     */
    public function postsAction(Collection $collection)
    {
        return $this->render('Collection/posts.html.twig', [
            'collection' => $collection
        ]);
    }
}
