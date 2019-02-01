<?php
namespace Core\Library\Upload;

class CollectionDirectoryNamer
{
    public function directoryName($entity): string
    {
        return 'collections' . DIRECTORY_SEPARATOR . $entity->getId();
    }
}
