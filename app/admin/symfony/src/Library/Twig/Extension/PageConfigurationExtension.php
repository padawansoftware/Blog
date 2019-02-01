<?php
namespace Admin\Library\Twig\Extension;

use \Twig_Extension;
use Admin\Library\Twig\Tag\Page\ConfiguratorTokenParser;

class PageConfigurationExtension extends Twig_Extension
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
            new \Twig_SimpleFunction('get_title', [$this, 'getTitle']),
            new \Twig_SimpleFunction('get_breadcrumbs', [$this, 'getBreadcrumbs']),
            new \Twig_SimpleFunction('has_header', [$this, 'hasHeader'])
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
