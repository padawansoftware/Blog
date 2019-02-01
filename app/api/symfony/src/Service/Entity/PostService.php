<?php
namespace Api\Service\Entity;

use Core\Entity\Post;
use Core\Entity\Asset;
use Core\Library\Service\BaseEntityService;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use Doctrine\Common\Persistence\ManagerRegistry as Doctrine;
use Symfony\Component\HttpFoundation\RequestStack;

class PostService extends BaseEntityService
{
    protected $uploaderHelper;

    protected $request;

    public function __construct(Doctrine $doctrine, UploaderHelper $uploaderHelper, RequestStack $requestStack)
    {
        parent::__construct($doctrine);

        $this->uploaderHelper = $uploaderHelper;
        $this->request = $requestStack->getCurrentRequest();
    }

    protected function getEntityClass():string
    {
        return 'Core\Entity\Post';
    }

    /**
     * @return array Collection with all enabled posts
     */
    public function getEnabled()
    {
        return $this->repository->getEnabled(
            $this->request->get('order', ["createdAt" => "DESC"]),
            $this->request->get('limit', null)
        );
    }
}
