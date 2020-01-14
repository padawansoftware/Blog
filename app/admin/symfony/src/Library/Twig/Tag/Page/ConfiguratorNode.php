<?php

namespace Admin\Library\Twig\Tag\Page;

use Twig\Node\Node;
use Twig\Compiler;
use Twig\Node\Expression\AbstractExpression;

class ConfiguratorNode extends Node
{
    public function __construct(AbstractExpression $value, $line, $tag = null)
    {
        parent::__construct(['value' => $value], [], $line, $tag);
    }

    public function compile(Compiler $compiler)
    {
        $compiler->raw('$this->env->getExtension(\'Admin\\Library\\Twig\\Extension\\PageConfigurationExtension\')->configure(')
                 ->subcompile($this->getNode('value'))
                 ->raw(');');
    }
}
