<?php

namespace Admin\Library\Twig\Tag\Page;

use Twig_Node;
use Twig_Compiler;
use Twig_Node_Expression;

class ConfiguratorNode extends Twig_Node
{
    public function __construct(Twig_Node_Expression $value, $line, $tag = null)
    {
        parent::__construct(['value' => $value], [], $line, $tag);
    }

    public function compile(Twig_Compiler $compiler)
    {
        $compiler->raw('$this->env->getExtension(\'Admin\\Library\\Twig\\Extension\\PageConfigurationExtension\')->configure(')
                 ->subcompile($this->getNode('value'))
                 ->raw(');');
    }
}
