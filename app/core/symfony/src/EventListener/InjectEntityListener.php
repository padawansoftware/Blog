<?php
namespace Core\EventListener;

use \ReflectionClass;
use Core\Entity\Asset;
use Core\Library\Annotations\Asset as AssetAnnotation;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

/**
 * Inject entity to Assets
 */
class InjectEntityListener implements EventSubscriber
{
    protected $uploaderHelper;

    protected $reader;

    protected $assetsUrl;

    public function __construct(UploaderHelper $uploaderHelper, Reader $reader, $assetsUrl)
    {
        $this->uploaderHelper = $uploaderHelper;
        $this->reader = $reader;
        $this->assetsUrl = $assetsUrl;
    }

    public function postLoad(LifecycleEventArgs $event)
    {
        $object = $event->getObject();
        if ($this->hasAsset($object)) {
            $this->populateAsset($object);
        }
    }

    /**
     * Check whether this entity has an assest field
     */
    protected function hasAsset($object): bool
    {
        $reflectionClass = new ReflectionClass($object);

        return null !== $this->reader->getClassAnnotation($reflectionClass, 'Core\Library\Annotations\Asset');
    }

    /**
     * Inject the entity into the asset and populate fields
     */
    protected function populateAsset($object)
    {
        $reflectionClass = new ReflectionClass($object);

        if ($assetField = $this->getAssetField($reflectionClass)) {
            $methodName = 'get'. ucfirst($assetField);

            if ($reflectionClass->hasMethod($methodName)) {
                $reflectionMethod = $reflectionClass->getMethod($methodName);
                if (($asset = $reflectionMethod->invoke($object)) instanceof Asset) {
                    // Populate asset with entity
                    $asset->setEntity($object);

                    // Populate asset url
                    $url = $this->assetsUrl . $this->uploaderHelper->asset($asset, 'file');
                    $asset->setUrl($url);
                }
            }
        }
    }

    /**
     * Return the field that holds the asset
     */
    protected function getAssetField(ReflectionClass $reflectionClass)
    {
        if ($annotation = $this->reader->getClassAnnotation($reflectionClass, 'Core\Library\Annotations\Asset')) {
            return $annotation->value;
        }

        return null;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::postLoad
        ];
    }
}
