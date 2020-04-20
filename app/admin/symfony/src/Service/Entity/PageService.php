<?php
namespace Admin\Service\Entity;

use Core\Library\Service\BaseEntityService;

class PageService extends BaseEntityService
{
    public function getEntityClass():string
    {
        return 'Core\\Entity\\Page';
    }
}
