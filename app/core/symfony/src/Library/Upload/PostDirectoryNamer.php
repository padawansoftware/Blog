<?php
namespace Core\Library\Upload;

class PostDirectoryNamer
{
    public function directoryName($entity): string
    {
        return 'posts' . DIRECTORY_SEPARATOR . $entity->getId();
    }
}
