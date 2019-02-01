<?php

namespace Core\Library\Upload;

use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;
use Core\Entity\Asset;

class DirectoryNamer implements DirectoryNamerInterface
{
    /**
     * Creates a directory name for the file being uploaded.
     *
     * @param object          $object  The object the upload is attached to
     * @param PropertyMapping $mapping The mapping to use to manipulate the given object
     *
     * @return string The directory name
     */
    public function directoryName($object, PropertyMapping $mapping): string
    {
        if ($object instanceof Asset) {
            if ($entity = $object->getEntity()) {
                if ($directoryNamer = $this->getDirectoryNamer($entity)) {
                    return $directoryNamer->directoryName($entity);
                }
            }
        }

        return '';
    }

    /**
     * Get the propertly directory namer for the given entity
     *
     * @param $entity The entity the asset is asociated to
     */
    protected function getDirectoryNamer($entity)
    {
        $entityClassName = $this->getEntityClassName($entity);
        $directoryNamer = sprintf("%s\%sDirectoryNamer", __NAMESPACE__, $entityClassName);

        if (! class_exists($directoryNamer)) {
            return null;
        }

        return new $directoryNamer();
    }

    protected function getEntityClassName($entity): string
    {
        return substr(strrchr(get_class($entity), "\\"), 1);
    }
}
