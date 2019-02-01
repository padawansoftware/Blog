<?php
namespace Admin\Service\Entity;

use Core\Library\Service\BaseEntityService;

class AssetService extends BaseEntityService
{
    public function getEntityClass():string
    {
        return 'Core\\Entity\\Asset';
    }
}
