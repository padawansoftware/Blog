<?php
namespace Api\Service\Entity;

use Core\Library\Service\BaseEntityService;

class PageService extends BaseEntityService
{
    protected function getEntityClass():string
    {
        return 'Core\Entity\Page';
    }
}
