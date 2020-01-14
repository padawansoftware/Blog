<?php
namespace Admin\Library\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Admin\Library\Twig\Tag\Page\ConfiguratorTokenParser;
use Twig\TwigFunction;

class PageConfigurationExtension extends AbstractExtension
{
    protected $hasHeader;
    protected $title;
    protected $subtitle;
    protected $breadcrumbs;

    public function __construct()
    {
        $this->title = 'Blog Admin';
        $this->breadcrumbs = [];
        $this->hasHeader = false;
    }

    public function getTokenParsers()
    {
        return [
            new ConfiguratorTokenParser(),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('get_title', [$this, 'getTitle']),
            new TwigFunction('get_breadcrumbs', [$this, 'getBreadcrumbs']),
            new TwigFunction('has_header', [$this, 'hasHeader'])
        ];
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }

    public function configure($config)
    {
        if (isset($config['title'])) {
            $this->title = $config['title'];
        }

        if (isset($config['breadcrumbs']) && is_array($config['breadcrumbs'])) {
            $this->breadcrumbs = $config['breadcrumbs'];
        }

        $this->hasHeader = true;
    }

    public function getName()
    {
        return 'blog_page_configuration';
    }

    public function hasHeader()
    {
        return $this->hasHeader;
    }
}
