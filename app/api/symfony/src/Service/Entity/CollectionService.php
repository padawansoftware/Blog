<?php
namespace Api\Service\Entity;

use Core\Library\Service\BaseEntityService;
use Core\Entity\Collection;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use Doctrine\Common\Persistence\ManagerRegistry as Doctrine;

class CollectionService extends BaseEntityService
{
    protected function getEntityClass():string
    {
        return 'Core\Entity\Collection';
    }
}
