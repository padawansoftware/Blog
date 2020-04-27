<?php
namespace Core\Library\Upload;

class PageDirectoryNamer
{
    public function directoryName($entity): string
    {
        return 'pages' . DIRECTORY_SEPARATOR . $entity->getId();
    }
}
