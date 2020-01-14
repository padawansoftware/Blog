<?php
namespace Core\EventListener;

use Doctrine\Common\Annotations\Reader;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use PSUploaderBundle\EventListener\InjectEntityListener as BaseInjectEntityListener;

/**
 * Inject entity to Assets
 */
class InjectEntityListener extends BaseInjectEntityListener
{
    protected $uploaderHelper;

    protected $assetsUrl;

    public function __construct(Reader $reader, UploaderHelper $uploaderHelper, $assetsUrl)
    {
        parent::__construct($reader);
        $this->uploaderHelper = $uploaderHelper;
        $this->assetsUrl = $assetsUrl;
    }

    protected function injectEntity($asset, $entity)
    {
        parent::injectEntity($asset, $entity);

        // Populate asset url
        $url = $this->assetsUrl . $this->uploaderHelper->asset($asset, 'file');
        $asset->setUrl($url);
    }
}
