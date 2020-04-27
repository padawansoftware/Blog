<?php
namespace Admin\Controller;

use Admin\Form\AssetType;
use Admin\Form\PageType;
use Admin\Service\Entity\AssetService;
use Admin\Service\Entity\PageService;
use Core\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

/**
 * @Route("/pages")
 */
class PageController extends AbstractController
{
    /**
     * @Route("/", name="pages")
     */
    public function indexAction(PageService $pageService)
    {
        $pages = $pageService->findAll();

        return $this->render("Page/index.html.twig", [
            'pages' => $pages
        ]);
    }

    /**
     * @Route("/create", name="page_create")
     */
    public function createAction(Request $request, PageService $pageService)
    {
        $page = $pageService->create();
        $form = $this->createForm(PageType::class, $page);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pageService->persist($page);
            if ($form->get('save&exit')->isClicked()) {
                return $this->redirectToRoute('pages');
            } else {
                return $this->redirectToRoute('page_edit', ['page' => $page->getId()]);
            }
        }

        return $this->render("Page/form.html.twig", [
            'page' => $page,
            'form' => $form->createView(),
            'form_action' => 'create'
        ]);
    }

    /**
     * @Route("/{page}/edit", name="page_edit")
     */
    public function editAction(Request $request, Page $page, PageService $pageService)
    {
        $form = $this->createForm(PageType::class, $page);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pageService->update($page);

            $this->addFlash('success', 'Page created successfully');

            if ($form->get('save&exit')->isClicked()) {
                return $this->redirectToRoute('pages');
            }
        }

        return $this->render("Page/form.html.twig", [
            'page' => $page,
            'form' => $form->createView(),
            'form_action' => 'edit'
        ]);
    }

    /**
     * @Route("/{page}", name="page_delete", methods={"DELETE"})
     */
    public function deleteAction(Page $page, PageService $pageService)
    {
        $pageService->remove($page);

        return new Response();
    }



    /**
     * @Route("/{page}/_page_upload_image", name="_page_upload_image", options={"expose"=true})
     */
    public function uploadDocumentAction(Request $request, Page $page, AssetService $assetService, UploaderHelper $uploaderHelper)
    {
        $asset = $assetService->create();
        $form = $this->createForm(AssetType::class, $asset, ['csrf_protection' => false, 'entity' => $page]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $assetService->persist($asset);

            $extension = $asset->getExtension();
            $response = [
                "success" => true,
                "format" => $extension,
                "link" => $request->getSchemeAndHttpHost() . $uploaderHelper->asset($asset, 'file')
            ];
        } else {
            $response = [
                "success" => false
            ];
        }

        return new JsonResponse($response);
    }
}
