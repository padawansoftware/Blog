<?php
namespace Admin\Library\Twig\Tag\Page;

use \Twig_Token;
use \Twig_TokenParser;

class ConfiguratorTokenParser extends Twig_TokenParser
{
    public function parse(Twig_Token $token)
    {
        $parser = $this->parser;
        $stream = $parser->getStream();

        $value = $parser->getExpressionParser()->parseExpression();
        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        return new ConfiguratorNode($value, $token->getLine(), $this->getTag());
    }

    public function getTag()
    {
        return 'config_page';
    }
}
